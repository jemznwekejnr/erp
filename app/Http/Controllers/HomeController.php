<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;

class HomeController extends Controller
{
    //

    //Authenticate user
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){

        

        if($this->checkstatus(Auth::user()->id) != "Active"){

            Auth::logout();

            return redirect('login');

        }else if($this->checkprofile(Auth::user()->profileid) == "Incomplete"){

            $staff = DB::table('profile')->where('id', Auth::user()->profileid)->get();

            $offices = DB::table('offices')->orderBy('offices', 'asc')->get();

            $banks = DB::table('banks')->orderBy('banks', 'asc')->get();

            $departments = DB::table('departments')->orderBy('departments', 'asc')->get();

            $designations = DB::table('designations')->orderBy('designations', 'asc')->get();

            return view('update-profile', ["staff" => $staff, 'offices' => $offices, 'banks' => $banks, 'departments' => $departments, 'designations' => $designations, "profileinfo" => "Complete Profile Update to Proceed"]);

        }else{

            $projectstatus = DB::table('projects')
                 ->select('status', DB::raw('count(*) as total'))
                 ->groupBy('status')
                 ->get();

            //get all the projects
            $projects = DB::table('projects')->get();

            $projectname = array();
            $pending = array();
            $ongoing = array();
            $completed = array();

            $i = 0;

            foreach($projects as $project){
                $total = DB::table('task')->where('projectid', $project->id)->count();
                $projectname[$i] = $project->title;
                if($total == 0){
                    $pending[$i] = 0;
                    $ongoing[$i] = 0;
                    $completed[$i] = 0;
                }else{
                    $pending[$i] = DB::table('task')->where([['projectid', $project->id],['status', 'Pending']])->count() / $total;
                    $ongoing[$i] = DB::table('task')->where([['projectid', $project->id],['status', 'Ongoing']])->count() / $total;
                    $completed[$i] = DB::table('task')->where([['projectid', $project->id],['status', 'Completed']])->count() / $total;
                }

                $i++;
            }


            $pvs = DB::table('pv')->orderBy('created_at', 'desc')->limit(6)->get();

            return view('dashboard', ['pvs' => $pvs, 'projectstatus' => $projectstatus, 'projectname' => $projectname, 'pending' => $pending, 'ongoing' => $ongoing, 'completed' => $completed, 'count' => $i]);

        }

    }
}
