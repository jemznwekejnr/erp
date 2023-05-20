<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use DB;
use Auth;
use DateTime;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function staffname($user){

        $staff = DB::table('profile')->where('id', $user)->get();

        return $staff[0]->firstname." ".$staff[0]->surname." ".$staff[0]->othername;
    }

    public static function getdepartment($department){

        return DB::table('departments')->where('id', $department)->value('departments');
    }


    public static function totalprojects(){

        return DB::table('projects')->count();
    }


    public static function pendingprojects(){

        return DB::table('projects')->where('status', 'Pending')->count();
    }

    public static function ongoingprojects(){

        return DB::table('projects')->where('status', 'Ongoing')->count();
    }

    public static function completedprojects(){

        return DB::table('projects')->where('status', 'Completed')->count();
    }

    public static function staffdepartment($staff){

        return DB::table('profile')->where('id', $staff)->value('department');
    }

    public static function staffemploymentstatus($staff){

        return DB::table('profile')->where('id', $staff)->value('employmentstatus');
        
    }

    public static function getleavedaysleft($profileid, $leavetype){

        return DB::table('leaveapplication')->where([['staff', $profileid], ['leavetype', $leavetype], ['status', 'Approved']])->sum('duration');
    }

    public static function getleavename($leave){

        return DB::table('leavetype')->where('id', $leave)->value('leavename');
    }


    public static function getleavedaysallocated($leave){

        return DB::table('leavetype')->where('id', $leave)->value('totaldaysalloted');
    }


    public static function annualbasic($level){

        return DB::table('basicpay')->where('level', $level)->value('amount') * 12;
    }


    public static function annualpension($level){

        $allowancepen = DB::table('allowances')
                            ->where('allowance', 'Housing')
                            ->orWhere('allowance', 'Transport')
                            ->sum('percentage');

        $allowancepenval = ($allowancepen / 100) * static::annualbasic($level);

        return round((8 / 100) * (static::annualbasic($level) + $allowancepenval));
    }



    public static function annualemployerpension($level){

        $allowancepen = DB::table('allowances')
                            ->where('allowance', 'Housing')
                            ->orWhere('allowance', 'Transport')
                            ->sum('percentage');

        $allowancepenval = ($allowancepen / 100) * static::annualbasic($level);

        return round((10 / 100) * (static::annualbasic($level) + $allowancepenval));
    }


    public static function annualallowances($level){

        $totalallowper = DB::table('allowances')->sum('percentage');

        return round(($totalallowper / 100) * static::annualbasic($level));

    }




    public static function annualgross($level){

        return round(static::annualbasic($level) + static::annualallowances($level));
    }


    public static function annualminimumtax($level){

        return round((1 / 100) * static::annualgross($level));
    }


    public static function consolidatedrelief($level){

        if((1 / 100) * static::annualgross($level) > 200000){ //if 1% of Annual Gross is Higher than 200k

            return round(((1 / 100) * static::annualgross($level)) + ((20 / 100) * (static::annualgross($level) - static::annualpension($level))));

        }else{

            return round(200000 + ((20 / 100) * (static::annualgross($level) - static::annualpension($level))));

        }
    }


    public static function totalreliefallowance($level){

        return round(static::consolidatedrelief($level) + static::annualpension($level));
    }


    public static function chargeableincome($level){

         return round(static::annualgross($level) - static::totalreliefallowance($level));
    }


    public static function annualtaxcaculation($level){

        $paye = 0;

        //level 1 for <= 300000 7%

        if(static::chargeableincome($level) <= 300000){

            if(static::annualminimumtax($level) > static::chargeableincome($level) * (7 / 100)){

                return static::annualminimumtax($level);

            }else{

                return round(static::chargeableincome($level) * (7 / 100));

            }

        }else{

            $incomebalance = static::chargeableincome($level) - 300000;

            $paye += 300000 * (7 / 100);
        }

        //Level 2 for <= 600000 11%

        if($incomebalance <= 300000){

            $levelpaye = $incomebalance * (11 / 100);

            $paye += $levelpaye;

            if(static::annualminimumtax($level) > $paye){

                return static::annualminimumtax($level);

            }else{

                return $paye;

            }

        }else{

            $incomebalance = $incomebalance - 300000;

            $levelpaye = 300000 * (11 / 100);

            $paye += $levelpaye;
            
        }


        //Level 3 for <= 1100000 15%

        if($incomebalance <= 500000){

            $levelpaye = $incomebalance * (15 / 100);

            $paye += $levelpaye;

            if(static::annualminimumtax($level) > $paye){

                return static::annualminimumtax($level);

            }else{

                return $paye;

            }

        }else{

            $incomebalance = $incomebalance - 500000;

            $levelpaye = 500000 * (15 / 100);

            $paye += $levelpaye;
        }


        //Level 4 for <= 1600000 19%

        if($incomebalance <= 500000){

            $levelpaye = $incomebalance * (19 / 100);

            $paye += $levelpaye;

            if(static::annualminimumtax($level) > $paye){

                return static::annualminimumtax($level);

            }else{

                return $paye;

            }

        }else{

            $incomebalance = $incomebalance - 500000;

            $levelpaye = 500000 * (19 / 100);

            $paye += $levelpaye;
        }


        //Level 5 for <= 2300000 21%

        if($incomebalance <= 700000){

            $levelpaye = $incomebalance * (21 / 100);

            $paye += $levelpaye;

            if(static::annualminimumtax($level) > $paye){

                return static::annualminimumtax($level);

            }else{

                return $paye;

            }

        }else{

            $incomebalance = $incomebalance - 700000;

            $levelpaye = 700000 * (21 / 100);

            $paye += $levelpaye;
        }


        //Level 6 for > 2300000 24%

        if($incomebalance > 700000){

            $levelpaye = $incomebalance * (24 / 100);

            $paye += $levelpaye;

            if(static::annualminimumtax($level) > $paye){

                return static::annualminimumtax($level);

            }else{

                return $paye;

            }

        }
    }


    public static function annualdeduction($level){

        return static::annualtaxcaculation($level) + static::annualpension($level);

    }


    public static function staffbonuses($staff, $month, $status){

        return DB::table('bonuses')->where([['staff', $staff], ['month', $month], ['status', $status]])->sum('amount');
    }


    public static function staffdeductions($staff, $month, $status){

        return DB::table('deductions')->where([['staff', $staff], ['month', $month], ['status', $status]])->sum('amount');
    }


    public static function getnetpay($level, $staff, $month, $status){

        //basic + allowances + bonuses - deductions - staff deduction
        return ((static::annualbasic($level) + static::annualallowances($level) - static::annualdeduction($level)) / 12) + static::staffbonuses($staff, $month, $status) - static::staffdeductions($staff, $month, $status);
    }


    public static function getbasicpay($level){

        return DB::table('basicpay')->where('level', $level)->value('amount');
    }

    public static function getlevelname($level){

        return DB::table('designations')->where('id', $level)->value('designations');
    }


    public static function staffemail($user){

        return DB::table('profile')->where('id', $user)->value('email');

    }
    
    public static function getrolename($role){
        
        return DB::table('role')->where('id', $role)->value('role');
    }

    public static function staffpics($user){

        return DB::table('profile')->where('id', $user)->value('image');

    }


    public static function staffsignature($user){

        return DB::table('profile')->where('id', $user)->value('signature');

    }

    public static function staffpdfsignature($user){

        $signature = DB::table('profile')->where('id', $user)->value('signature');

        return base64_encode(file_get_contents(public_path($signature)));

    }


    //generate password token for new user
    public static function getToken($length){
     $token = "";
     $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
     $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
     $codeAlphabet.= "0123456789";
     $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }
    
        return $token;
    }


    public static function checkuser($user){

        return DB::table('users')->where('profileid', $user)->get();
    }

    public static function profileemail($staff){

        $staff = DB::table('profile')->where('id', $staff)->get();

        return $staff[0]->email;
    }


    //send notification on the system
    public static function createnotification($staff, $type, $title, $status, $location){

        $data = array();

        $data['staff'] = $staff;
        $data['type'] = $type;
        $data['title'] = $title;
        $data['status'] = $status;
        $data['location'] = $location;
        $data['created_at'] = date('Y-m-d H:i:s');

        return DB::table('notifications')->insert($data);

    }

    
    //log event
    public static function logevent($action){


        //log the event

        $logs = array();

        $logs['user'] = Auth::user()->id;
        $logs['action'] = $action;
        $logs['created_at'] = date('Y-m-d H:i:s');
        $logs['updated_at'] = date('Y-m-d H:i:s');

        return $createlogs = DB::table('logs')->insert($logs);


    }

    public static function datediffs($date1, $date2){


        $date1 = new DateTime($date1);
        $date2 = new DateTime($date2);
        $interval = $date1->diff($date2);

        return $interval->d." days ";
    }

    public static function staffdesignation($staff){

        return DB::table('profile')->where('id', $staff)->value('designation');
    }



    public static function projectname($project){

        return DB::table('projects')->where('id', $project)->value('title');
    }

    public static function projectdetail($project){

        return DB::table('projects')->where('id', $project)->get();
    }

    public static function staffimage($staff){

        return DB::table('profile')->where('id', $staff)->value('image');
    }


    public static function getaction($action){

        return DB::table('actions')->where('id', $action)->value('action');
    }

    public static function checkprocess($role, $process, $action){

        if(DB::table('privileges')->where([['role', $role], ['privilege', $process], ['action', $action]])->count() == 1){

            return "found";
        }

    }


    public static function clientpayments($project){

        return DB::table('invoice')->where([['project', $project], ['status', 'Paid']])->sum('sumamounts');
    }

    //get project progress from the tasks
    public static function projectprogress($project){

        $total = DB::table('task')->where('projectid', $project)->count();

        $completed = DB::table('task')->where([['projectid', $project],['status', 'completed']])->count();

        if($total == 0){
            return 0;
        }else{
            $progress = $completed / $total * 100;

            if($progress == 100){ //update project status

                $status = DB::table('projects')->where('projectid', $project)->update(['status' => 'Completed', 'updated_at' => date('Y-m-d H:i:s')]);

            }

            return $progress;
        }

        
    }


    public static function officename($office){

        $info = DB::table('companyinfo')->where('id', $office)->get();

        if($info->count() == 0){
            return "Office not found, edit this page to select office";
        }else{
            return $info[0]->address.', '.$info[0]->city.' '.$info[0]->state;
        }
    }


    public static function getfulloffice($office){

        $info = DB::table('companyinfo')->where('id', $office)->get();

        if($info->count() == 0){
            return "Office not found, edit this page to select office";
        }else{
            return $info;
        }
    }

    

    //get project expenses
    public static function projectexpenses($project){

        return DB::table('pv')->where([['project', $project], ['status', 'Paid']])->sum('totalnet');
    }

    //get task percentage
    public static function taskpercent($project, $category){

        $total = DB::table('task')->where('projectid', $project)->count();

        $category = DB::table('task')->where([['projectid', $project], ['status', $category]])->count();

        if($total == 0){
            return 0;
        }else{
            return $category / $total * 100;
        }
        
    }


    public static function checkrole($role, $process, $action){

        if(DB::table('privileges')->where([['role', $role], ['privilege', $process], ['action', $action]])->count() == 1){

            return "allow";
        }
    }

    //check if user account is active
    public static function checkstatus($user){

        return DB::table('users')->where('id', $user)->value('status');

    }

    //check if staff profile is completed
    public static function checkprofile($staff){

        $check = DB::table('profile')->where('id', $staff)->get();

        if(empty($check[0]->staffid) || empty($check[0]->surname) || empty($check[0]->firstname) || empty($check[0]->email) || empty($check[0]->phone) || empty($check[0]->dob) || empty($check[0]->doe) || empty($check[0]->department) || empty($check[0]->designation) || empty($check[0]->office) || empty($check[0]->gender) || empty($check[0]->image) || empty($check[0]->signature)){

            return "Incomplete";

        }else{

            return "Complete";
        }
    }


    public static function getactions($action){

        return DB::table('actions')->where('id', $action)->value('action');
    }


    public static function notifications(){

        return DB::table('notifications')->where([['staff', Auth::user()->profileid],['status', 'Unread']])->orderBy('created_at', 'desc')->get();
    }

    public static function duration($startdate){

        $enddate = date('Y-m-d H:i:s');

        $date1 = new DateTime($enddate);
        $date2 = new DateTime($startdate);
        $interval = $date1->diff($date2);
        //echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days "; 

        $year = $interval->y;
        $month = $interval->m;
        $days = $interval->d;
        $hours = $interval->h;
        $minutes = $interval->i;
        $seconds = $interval->s;

        if($year == 1){
            return $year . " year ";
        }else if($year > 1){
            return $year . " years ";
        }else if($month == 1){
            return $month . " month ";
        }else if($month > 1){
            return $month . " months ";
        }else if($days == 1){
            return $days . " day ";
        }else if($days > 1){
            return $days . " days ";
        }else if($hours == 1){
            return $hours . " hour ";
        }else if($hours > 1){
            return $hours . " hours ";
        }else if($minutes == 1){
            return $minutes . " minute ";
        }else if($minutes > 1){
            return $minutes . " minutes ";
        }else if($seconds == 1){
            return $seconds . " second ";
        }else if($seconds > 1){
            return $seconds . " seconds ";
        }else{
            return $seconds . " seconds "; 
        }
        
    }


    public static function circularrecipients($circular){


        return DB::table('circular_recipeint')->where('circularid', $circular)->get();

    }


    public static function circulartitle($circular){

        return DB::table('circular')->where('id', $circular)->value('title');
    }
    
    public static function expensesthisyear(){
        
        return DB::table('pv')->where([['status', 'Approved'], ['created_at', 'LIKE', date('Y').'%']])->sum('totalnet');
    }
    
    public static function expensesthismonth(){
        
        return DB::table('pv')->where([['status', 'Approved'], ['created_at', 'LIKE', date('Y-m').'%']])->sum('totalnet');
    }

    public static function monthallowances(){

        return DB::table('allowances')->get();
    }


    public static function monthdeductions(){

        return DB::table('alloweddeductions')->get();
    }

    public static function getstaffallowances($staff){

        return DB::table('monthallowances')->where('staff', $staff)->get();
    }


    public static function getstaffdeductions($staff){

        return DB::table('monthdeduction')->where('staff', $staff)->get();
    }

    public static function getemployerdeductions($month){

        return DB::table('employerdeduction')->where('month', $month)->sum('amount');
    }

}
