<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Mail;

class LeaveController extends Controller
{
    //Authenticate user
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function leavetypes(){

        $leavetypes = DB::table('leavetype')->orderBy('leavename', 'asc')->get();

        return view('leavetypes', ['leavetypes' => $leavetypes]);
    }


    public function submitleave(Request $request){

        $leavetype = $request->leavetype;
        $daysallowed = $request->daysallowed;
        $maxdays = $request->maxdays;

        if(!empty($request->leaveid)){

        //update existing allowance

        $data = array();

        $data['leavename'] = $leavetype;
        $data['totaldaysalloted'] = $daysallowed;
        $data['totaldaysallowed'] = $maxdays;
        $data['updated_at'] = date('Y-m-d H:i:s');

        try {

        $update = DB::table('leavetype')->where('id', $request->leaveid)->update($data);

        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return response()->json([
                'message' => 'error',
                'info' => 'Error performing this action, make sure all the required fields are provided then try again.'
            ]);
        }

        if($update){

            
            //log the event

            $this->logevent("Updated leave type ".$leavetype." to the database");

            return response()->json([
                'message' => 'success',
                'info' => 'Leave type successfully updated to the database'
            ]);

        }else{

            //log the event

            $logs = array();

            $logs['user'] = Auth::user()->id;
            $logs['action'] = "Attempted to update leave type ".$leavetype." to the database, but failed";
            $logs['created_at'] = date('Y-m-d H:i:s');
            $logs['updated_at'] = date('Y-m-d H:i:s');

            $createlogs = DB::table('logs')->insert($logs);


            return response()->json([
                'message' => 'error',
                'info' => 'Error updating leave type to the database, please try again.'
            ]);

        }

        }else{

        //check if basic pay already added to the database

        $check = DB::table('leavetype')->where('leavename', $leavetype)->count();

        if($check == 1){

            
            //log the event

            $this->logevent("Attempted to add new leave type ".$leavetype." to the database, but failed because the event already exist.");


            return response()->json([
                'message' => 'error',
                'info' => 'Unable to add leave type to the database, the data entered already exist.'
            ]);
        }

        $data = array();

        $data['leavename'] = $leavetype;
        $data['totaldaysalloted'] = $daysallowed;
        $data['totaldaysallowed'] = $maxdays;
        $data['created_by'] = Auth::user()->profileid;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        try {

        $create = DB::table('leavetype')->insert($data);

        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return response()->json([
                'message' => 'error',
                'info' => 'Error performing this action, make sure all the required fields are provided then try again.'
            ]);
        }

        if($create){

            
            //log the event

            $this->logevent("Added new leave type ".$leavetype." to the database");

            return response()->json([
                'message' => 'success',
                'info' => 'Leave type successfully added to the database'
            ]);

        }else{

            //log the event

            $logs = array();

            $logs['user'] = Auth::user()->id;
            $logs['action'] = "Attempted to add new leave type ".$leavetype." to the database, but failed";
            $logs['created_at'] = date('Y-m-d H:i:s');
            $logs['updated_at'] = date('Y-m-d H:i:s');

            $createlogs = DB::table('logs')->insert($logs);


            return response()->json([
                'message' => 'error',
                'info' => 'Error adding leave type to the database, please try again.'
            ]);

        }

        }
    }


    public function deleteleave(Request $request){

        $leave = DB::table('leavetype')->where('id', $request->id)->value('leavename');

        try {

            $delete = DB::table('leavetype')->where('id', $request->id)->limit(1)->delete();

        } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                return response()->json([
                    'message' => 'error',
                    'info' => 'Error performing this action, please try again'
                ]);
            }

        if($delete){

            //log the event

            $this->logevent("Successfully deleted leave type with the name ".$leave." from the database");

            return response()->json([
                "message" => "success",
                "info" => "Leave type with the name ".$leave." successfully removed from the database"
            ]);

        }else{

            //log the event

            $this->logevent("Attempted to delete leave type with the name ".$leave." from the database but failed");

            return response()->json([
                "message" => "error",
                "info" => "Error deleting leave type ".$leave." please try again."
            ]);
        }
    }


    public function leaverequest(){

        $staffs = DB::table('profile')->orderBy('firstname')->get();

        $leavetypes = DB::table('leavetype')->get();

        return view('leaverequest', ['staffs' => $staffs, 'leavetypes' => $leavetypes]);
    }


    public function leaveduration(Request $request){

        $duration = DB::table('leavetype')->where('id', $request->id)->value('totaldaysallowed'); //total allowed leave

        //check total leave left for the staff
        if($this->getleavedaysleft(Auth::user()->profileid, $request->id) > $duration){

            return view('process.leaveduration', ['duration' => $this->getleavedaysleft(Auth::user()->profileid, $request->id)]);

        }else{

            return view('process.leaveduration', ['duration' => $duration]);

        }


    }


    public function submitleaveapplication(Request $request){

        $title = $request->title;
        $leavetype = $request->leavetype;
        $duration = $request->duration;
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $sendto = $request->sendto;
        $copy = $request->copy;
        $leavebody = $request->leavebody;
        $attachment = $request->file('attachment');
        $status = 'Pending';
        
        

        //check if this application was submitted earlier incase of network failure

        $checkleave = DB::table('leaveapplication')
                    ->where([
                            ['staff', Auth::user()->id],
                            ['title', $title],
                            ['body', $leavebody],
                            ['status', $status],
                            ['sendto', $sendto],
                            ['copy', $copy],
                            ['daystaken', $duration],
                            ['startdate', $startdate],
                            ['enddate', $enddate],
                    ])->count();

        if($checkleave == 1){

            $this->logevent("Attempted to submit new leave application but failed because the application has been submitted earlier");


            return response()->json([
                'message' => 'error',
                'info' => 'Leave application failed because the application already exist in the database'
            ]);

        }else{

            //insert memo in to the database
            $data = array();

            $data['leavedate'] = date('Y-m-d');
            $data['staff'] = Auth::user()->profileid;
            $data['department'] = $this->staffdepartment(Auth::user()->profileid);
            $data['designation'] = $this->staffdesignation(Auth::user()->profileid);
            $data['employeestatus'] = $this->staffemploymentstatus(Auth::user()->profileid);
            $data['leavetype'] = $leavetype;
            $data['startdate'] = $startdate;
            $data['enddate'] = $enddate;
            $data['duration'] = $duration;
            $data['daystaken'] = $this->getleavedaysleft(Auth::user()->profileid, $leavetype);
            $data['daysleft'] = $this->getleavedaysallocated($leavetype) - $this->getleavedaysleft(Auth::user()->profileid, $leavetype);
            $data['status'] = 'Pending';
            $data['sendto'] = $sendto;
            $data['copy'] = $copy;
            $data['title'] = $title;
            $data['body'] = $leavebody;

            if($duration > $this->getleavedaysallocated($leavetype) - $this->getleavedaysleft(Auth::user()->profileid, $leavetype)){

                return response()->json([
                        'message' => 'error',
                        'info' => 'The number of days requested '.$duration.' is more than the number of days left for your '.$this->getleavename($leavetype)
                    ]);
            }

            if(!empty($attachment)){
                try{
                    $attachmenturl = $attachment->store('assets/attachments');
                    $data['attachment'] = $attachmenturl;
                } catch (\Exception $e) {
                    return response()->json([
                        'message' => 'error',
                        'info' => 'Error uploading attachment, reduce the file size of try a different file.'
                    ]);
                }
            }
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            try {

            $create = DB::table('leaveapplication')->insert($data);

            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                return response()->json([
                    'message' => 'error',
                    'info' => 'Error performing this action, make sure all the required fields are provided then try again.'
                ]);
            }

            if($create){

                //send email to actors
                $username = $this->staffname($sendto);
                $useremail = $this->profileemail($sendto);
                
                try{
                    //send email to the person concerned
                    Mail::send('emails.newleaveemail', ['username' => $username, 'useremail' => $useremail], function ($message) use ($username, $useremail) {
                    $message->to($useremail, $username)->subject('New leave application has been submitted and requires your attention.');
                    $message->from('erp@reliaenergy.com', 'ERP');
                    });
                }catch(\Exception $e){
                    
                }

                //create recipient notification

                $this->createnotification($sendto, 'Leave', $title, 'Unread', 'allleaveapplications');

                //send email to copies
                if(!empty($copy)){

                //send email to actors
                $username = $this->staffname($copy);
                $useremail = $this->profileemail($copy);
                
                    try{
                        //send email to the person concerned
                        Mail::send('emails.newleaveemail', ['username' => $username, 'useremail' => $useremail], function ($message) use ($username, $useremail) {
                        $message->to($useremail, $username)->subject('New leave application has been submitted and requires your attention.');
                        $message->from('erp@reliaenergy.com', 'ERP');
                        });
                    }catch(\Exception $e){
                        
                    }


                    $this->createnotification($copy, 'Leave', $title, 'Unread', 'allleaveapplications');

                }


                //log the event
                $this->logevent("Created new leave application ".$title);

                return response()->json([
                    'message' => 'success',
                    'info' => 'Leave successfully created'
                ]);


                
            }
            
        }

    }


    public function allleaveapplications(Request $request){

        $leaves = DB::table('leaveapplication')->orderBy('updated_at', 'desc')->get();

        return view('allleaveapplications', ['leaves' => $leaves]);
    }


    public function myleaveapplications(Request $request){

        $leaves = DB::table('leaveapplication')->where('staff', Auth::user()->profileid)->orderBy('updated_at', 'desc')->get();

        return view('allleaveapplications', ['leaves' => $leaves]);
    }


    public function leavedetails(Request $request){

        $leaves = DB::table('leaveapplication')->where('id', $request->id)->get();

        $staffs = DB::table('profile')->orderBy('firstname')->get();

        return view('leavedetails', ['leaves' => $leaves, 'staffs' => $staffs]);
    }


    public function leavereaction(Request $request){

        $status = $request->status;
        $remarks = $request->remarks;
        $handover = $request->handover;
        $standin = $request->standin;
        $sentfrom = $request->sentfrom;
        $title = $request->title;

        $data = array();

        $data['status'] = $status;
        $data['remark'] = $remarks;
        $data['handover'] = $handover;
        $data['standin'] = $standin;
        $data['updated_at'] = date('Y-m-d H:i:s');

        try {

            $update = DB::table('leaveapplication')->where('id', $request->id)->update($data);

            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                return response()->json([
                    'message' => 'error',
                    'info' => 'Error performing this action, make sure all the required fields are provided then try again.'
                ]);
            }


        if($update){

        //send email to owner of the leave application
        $username = $this->staffname($sentfrom);
        $useremail = $this->profileemail($sentfrom);
        
        try{
            //send email to the person concerned
            Mail::send('emails.leavereplyemail', ['username' => $username, 'useremail' => $useremail], function ($message) use ($username, $useremail) {
            $message->to($useremail, $username)->subject('Update on your leave application.');
            $message->from('erp@reliaenergy.com', 'ERP');
            });
        }catch(\Exception $e){
            
        }


        //create recipient notification

        $this->createnotification($sentfrom, 'Leave', $title, 'Unread', 'myleaveapplications');

        //log the event

        $this->logevent("Successfully updated a leave application with the title ".$title);


        return response()->json([
            'message' => 'success',
            'info' => 'Leave application successfully updated'
        ]);
         

        }
    }


    public function editleaverequest(Request $request){

        $leaves = DB::table('leaveapplication')->where('id', $request->id)->get();

        $staffs = DB::table('profile')->orderBy('firstname')->get();

        $leavetypes = DB::table('leavetype')->get();

        return view('editleaverequest', ['leaves' => $leaves, 'staffs' => $staffs, 'leavetypes' => $leavetypes]);
    }


    public function submitleaveedit(Request $request){

        $leaves = DB::table('leaveapplication')->where('id', $request->id)->get();


        $title = $request->title;
        $leavetype = $request->leavetype;
        $duration = $request->duration;
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $sendto = $request->sendto;
        $copy = $request->copy;
        $leavebody = $request->leavebody;
        $attachment = $request->file('attachment');
        $status = 'Pending';
        
        $data = array();

        $data['leavedate'] = date('Y-m-d');
        $data['staff'] = Auth::user()->profileid;
        $data['department'] = $this->staffdepartment(Auth::user()->profileid);
        $data['designation'] = $this->staffdesignation(Auth::user()->profileid);
        $data['employeestatus'] = $this->staffemploymentstatus(Auth::user()->profileid);
        $data['leavetype'] = $leavetype;
        $data['startdate'] = $startdate;
        $data['enddate'] = $enddate;
        $data['duration'] = $duration;
        $data['daystaken'] = $this->getleavedaysleft(Auth::user()->profileid, $leavetype);
        $data['daysleft'] = $this->getleavedaysallocated($leavetype) - $this->getleavedaysleft(Auth::user()->profileid, $leavetype);
        $data['status'] = 'Pending';
        $data['sendto'] = $sendto;
        $data['copy'] = $copy;
        $data['title'] = $title;
        $data['body'] = $leavebody;

        if(!empty($request->attachment)){
            try{
                $attachment = $request->file('attachment');
                $attachmenturl = $attachment->store('assets/attachments');
                $data['attachment'] = $attachmenturl;
            } catch (\Exception $e) {
                    return response()->json([
                        'message' => 'error',
                        'info' => 'Error uploading attachment, reduce the file size of try a different file.'
                    ]);
                }
        }

        $data['updated_at'] = date('Y-m-d H:i:s');

        
        try {

            $update = DB::table('leaveapplication')->where('id', $request->id)->update($data);

            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                return response()->json([
                    'message' => 'error',
                    'info' => 'Error performing this action, make sure all the required fields are provided then try again.'
                ]);
            }


        if($update){

        //send email to actors
        $username = $this->staffname($leaves[0]->sendto);
        $useremail = $this->profileemail($leaves[0]->sendto);
        
        try{
            //send email to the person concerned
            Mail::send('emails.editleaveemail', ['username' => $username, 'useremail' => $useremail], function ($message) use ($username, $useremail) {
            $message->to($useremail, $username)->subject('A leave application sent to you was updated.');
            $message->from('erp@reliaenergy.com', 'ERP');
            });
        }catch(\Exception $e){
            
        }

        //create recipient notification

        $this->createnotification($leaves[0]->sendto, 'Leave', $request->title, 'Unread', 'allleaveapplications');

        //send email to copies
        $copies = $leaves[0]->copy;

        if(!empty($copy)){

            //send email to actors
        $username = $this->staffname($leaves[0]->copy);
        $useremail = $this->profileemail($leaves[0]->copy);
        
            try{
                //send email to the person concerned
                Mail::send('emails.editleaveemail', ['username' => $username, 'useremail' => $useremail], function ($message) use ($username, $useremail) {
                $message->to($useremail, $username)->subject('A leave application sent to you was updated.');
                $message->from('erp@reliaenergy.com', 'ERP');
                });
            }catch(\Exception $e){
                
            }

            //create copies notifications

            $this->createnotification($leaves[0]->copy, 'Leave', $request->title, 'Unread', 'allleaveapplications');

        }

        

        //log the event

        $this->logevent("Successfully updated a leave application with the title ".$request->title);


        return response()->json([
            'message' => 'success',
            'info' => 'Leave successfully updated.'
        ]); 



    }
    }
}
