<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Mail;

class PayrollController extends Controller
{

    //Authenticate user
    public function __construct()
    {
        $this->middleware('auth');
    }

    //load basic pay

    public function basicpay(Request $request){

        $basicpays = DB::table('basicpay')->get();

        $levels = DB::table('designations')->get();

        return view('basicpay', ['basicpays' => $basicpays, 'levels' => $levels]);
    }


    //submit new and update basic to the database
    public function submitbasicpay(Request $request){

        $level = $request->level;
        $amount = $request->amount;

        if(!empty($request->basicid)){

        //update existing allowance

        $data = array();

        $data['level'] = $level;
        $data['amount'] = $amount;
        $data['updated_at'] = date('Y-m-d H:i:s');

        try {

        $update = DB::table('basicpay')->where('id', $request->basicid)->update($data);

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

            $this->logevent("Updated basic pay for ".$this->getlevelname($level)." to the database");

            return response()->json([
                'message' => 'success',
                'info' => 'Basic pay successfully updated to the database'
            ]);

        }else{

            //log the event

            $logs = array();

            $logs['user'] = Auth::user()->id;
            $logs['action'] = "Attempted to update basic pay for level ".$this->getlevelname($level)." to the database, but failed";
            $logs['created_at'] = date('Y-m-d H:i:s');
            $logs['updated_at'] = date('Y-m-d H:i:s');

            $createlogs = DB::table('logs')->insert($logs);


            return response()->json([
                'message' => 'error',
                'info' => 'Error updating basic pay to the database, please try again.'
            ]);

        }

        }else{

        //check if basic pay already added to the database

        $check = DB::table('basicpay')->where('level', $level)->count();

        if($check == 1){

            
            //log the event

            $this->logevent("Attempted to add new basic pay for level ".$this->getlevelname($level)." to the database, but failed because the event already exist.");


            return response()->json([
                'message' => 'error',
                'info' => 'Unable to add basic to the database, the level selected already exist.'
            ]);
        }

        $data = array();

        $data['level'] = $level;
        $data['amount'] = $amount;
        $data['created_by'] = Auth::user()->profileid;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        try {

        $create = DB::table('basicpay')->insert($data);

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

            $this->logevent("Added new basic pay for level ".$this->getlevelname($level)." to the database");

            return response()->json([
                'message' => 'success',
                'info' => 'Basic pay successfully added to the database'
            ]);

        }else{

            //log the event

            $logs = array();

            $logs['user'] = Auth::user()->id;
            $logs['action'] = "Attempted to add new basic pay for level ".$this->getlevelname($level)." to the database, but failed";
            $logs['created_at'] = date('Y-m-d H:i:s');
            $logs['updated_at'] = date('Y-m-d H:i:s');

            $createlogs = DB::table('logs')->insert($logs);


            return response()->json([
                'message' => 'error',
                'info' => 'Error adding basic pay to the database, please try again.'
            ]);

        }

        }
    }



    //delete existing basic pay
    public function deletebasicpay(Request $request){

        $level = DB::table('basicpay')->where('id', $request->id)->value('level');

        try {

            $delete = DB::table('basicpay')->where('id', $request->id)->limit(1)->delete();

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

            $this->logevent("Successfully deleted basic pay for level ".$this->getlevelname($level)." from the database");

            return response()->json([
                "message" => "success",
                "info" => "Basic pay for level ".$this->getlevelname($level)." successfully removed from the database"
            ]);

        }else{

            //log the event

            $this->logevent("Attempted to delete basic pay for level ".$this->getlevelname($level)." from the database but failed");

            return response()->json([
                "message" => "error",
                "info" => "Error deleting basic pay for level ".$this->getlevelname($level)." please try again."
            ]);
        }
    }


    /*********************** Allowances Begins Here *********************************************************/

    public function allowances(Request $request){

        $allowances = DB::table('allowances')->get();

        return view('allowances', ['allowances' => $allowances]);
    }


    //submit and update allowances

    public function submitallowances(Request $request){

        $allowance = $request->allowances;
        $percentage = $request->percentage;

        if(!empty($request->allowanceid)){

        //update allowance to the database

        $data = array();

        $data['allowance'] = $allowance;
        $data['percentage'] = $percentage;
        $data['updated_at'] = date('Y-m-d H:i:s');

        try {

        $update = DB::table('allowances')->where('id', $request->allowanceid)->update($data);

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

            $this->logevent("Updated allowance ".$allowance." to the database");

            return response()->json([
                'message' => 'success',
                'info' => 'Allowance successfully updated to the database'
            ]);

        }else{

            //log the event

            $logs = array();

            $logs['user'] = Auth::user()->id;
            $logs['action'] = "Attempted to update allowance ".$allowance." to the database, but failed";
            $logs['created_at'] = date('Y-m-d H:i:s');
            $logs['updated_at'] = date('Y-m-d H:i:s');

            $createlogs = DB::table('logs')->insert($logs);


            return response()->json([
                'message' => 'error',
                'info' => 'Error updating allowance to the database, please try again.'
            ]);

        }

        }else{

        //check if basic pay already added to the database

        $check = DB::table('allowances')->where('allowance', $allowance)->count();

        if($check == 1){

            
            //log the event

            $this->logevent("Attempted to add new allowance ".$allowance." to the database, but failed because the event already exist.");


            return response()->json([
                'message' => 'error',
                'info' => 'Unable to add allowance to the database, the allowance already exist.'
            ]);
        }

        $data = array();

        $data['allowance'] = $allowance;
        $data['percentage'] = $percentage;
        $data['created_by'] = Auth::user()->profileid;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        try {

        $create = DB::table('allowances')->insert($data);

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

            $this->logevent("Added new allowance ".$allowance." to the database");

            return response()->json([
                'message' => 'success',
                'info' => 'allowance successfully added to the database'
            ]);

        }else{

            //log the event

            $logs = array();

            $logs['user'] = Auth::user()->id;
            $logs['action'] = "Attempted to add new allowance ".$allowance." to the database, but failed";
            $logs['created_at'] = date('Y-m-d H:i:s');
            $logs['updated_at'] = date('Y-m-d H:i:s');

            $createlogs = DB::table('logs')->insert($logs);


            return response()->json([
                'message' => 'error',
                'info' => 'Error adding allowance to the database, please try again.'
            ]);

        }

        }
    }


    //delete existing basic pay
    public function deleteallowance(Request $request){

        $allowance = DB::table('allowances')->where('id', $request->id)->value('allowance');

        try {

            $delete = DB::table('allowances')->where('id', $request->id)->limit(1)->delete();

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

            $this->logevent("Successfully deleted allowance ".$allowance." from the database");

            return response()->json([
                "message" => "success",
                "info" => "Allowance ".$allowance." successfully removed from the database"
            ]);

        }else{

            //log the event

            $this->logevent("Attempted to delete allowance ".$allowance." from the database but failed");

            return response()->json([
                "message" => "error",
                "info" => "Error deleting allowance ".$allowance." please try again."
            ]);
        }
    }


    /*********************************** Allowance Ends Here ******************************************************/


    /*********************************** Bonus Begins Here *******************************************************/


    public function bonuses(Request $request){

        $bonuses = DB::table('bonuses')->orderBy('created_at', 'desc')->get();

        $staffs = DB::table('profile')->orderBy('surname', 'asc')->get();

        return view('bonuses', ['bonuses' => $bonuses, 'staffs' => $staffs]);
    }



    //submit and update bonus

    public function submitbonus(Request $request){

        $staff = $request->staff;
        $description = $request->description;
        $amount = $request->amount;
        $month = $request->month;

        if(!empty($request->bonusid)){

        //check if more than staff is selected
        if(count($staff) != 1){

            return response()->json([
                "message" => "error",
                "info" => "You are allowed to edit only one staff at a time."
            ]);
        }

        //check if bonus already exist for the selected month

            $check = DB::table('bonuses')->where([['staff', $staff[0]],['month', $month]])->count();

            if($check == 1){

                
                //log the event

                $this->logevent("Attempted to add new bonus for ".$staff[0]." for the month of ".$month." to the database, but failed because the event already exist.");


                return response()->json([
                    'message' => 'error',
                    'info' => 'Unable to add bonus to the database, the bonus already exist.'
                ]);
            }


        //update allowance to the database

        $data = array();

        $data['staff'] = $staff[0];
        $data['bonus'] = $description;
        $data['amount'] = $amount;
        $data['month'] = $month;
        $data['updated_at'] = date('Y-m-d H:i:s');

        try {

        $update = DB::table('bonuses')->where('id', $request->bonusid)->update($data);

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

            $this->logevent("Updated bonus record for ".$staff[0]." to the database");

            return response()->json([
                'message' => 'success',
                'info' => 'Bonus successfully updated to the database'
            ]);

        }else{

            //log the event

            $logs = array();

            $logs['user'] = Auth::user()->id;
            $logs['action'] = "Attempted to update bonus for the staff ".$staff[0]." to the database, but failed";
            $logs['created_at'] = date('Y-m-d H:i:s');
            $logs['updated_at'] = date('Y-m-d H:i:s');

            $createlogs = DB::table('logs')->insert($logs);


            return response()->json([
                'message' => 'error',
                'info' => 'Error updating bonus to the database, please try again.'
            ]);

        }

        }else{

        //get the total number of staff selected

        $total = count($staff);

        for($i=0; $i<$total; $i++){

            //check if bonus already added to the database

            $check = DB::table('bonuses')->where([['staff', $staff[$i]],['month', $month]])->count();

            if($check == 1){

                
                //log the event

                $this->logevent("Attempted to add new bonus for ".$staff[$i]." for the month of ".$month." to the database, but failed because the event already exist.");


                return response()->json([
                    'message' => 'error',
                    'info' => 'Unable to add bonus to the database, the bonus already exist.'
                ]);
            }


            $data = array();

            $data['staff'] = $staff[$i];
            $data['bonus'] = $description;
            $data['amount'] = $amount;
            $data['month'] = $month;
            $data['status'] = "Unpaid";
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = Auth::user()->profileid;

            try {

            $create = DB::table('bonuses')->insert($data);

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

                $this->logevent("Added new bonus for ".$staff[$i]." for the month of ".$month." to the database");

            }else{

                //log the event

                $logs = array();

                $logs['user'] = Auth::user()->id;
                $logs['action'] = "Attempted to add new bonus for ".$staff[$i]." for the month of ".$month." to the database, but failed";
                $logs['created_at'] = date('Y-m-d H:i:s');
                $logs['updated_at'] = date('Y-m-d H:i:s');

                $createlogs = DB::table('logs')->insert($logs);

            }

        }


        if($create){

                return response()->json([
                    'message' => 'success',
                    'info' => 'Bonus successfully added to the database'
                ]);

            }else{


                return response()->json([
                    'message' => 'error',
                    'info' => 'Error adding bonus to the database, please try again.'
                ]);

            }


        }
    }


    //delete existing basic pay
    public function deletebonus(Request $request){

        $bonus = DB::table('bonuses')->where('id', $request->id)->get();

        try {

            $delete = DB::table('bonuses')->where('id', $request->id)->limit(1)->delete();

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

            $this->logevent("Successfully deleted bonus for ".$bonus[0]->staff." for the month of ".$bonus[0]->month." from the database");

            return response()->json([
                "message" => "success",
                "info" => "Bonus successfully removed from the database"
            ]);

        }else{

            //log the event

            $this->logevent("Attempted to delete bonus for ".$bonus[0]->staff." for the month of ".$bonus[0]->month." from the database but failed");

            return response()->json([
                "message" => "error",
                "info" => "Error deleting bonus please try again."
            ]);
        }
    }




    /*********************************** Bonuses End Here **************************************************************************************/

    /************************************Deduction Begins Here ********************************************************************************/


    public function deductions(Request $request){

        $deductions = DB::table('deductions')->orderBy('created_at', 'desc')->get();

        $staffs = DB::table('profile')->orderBy('surname', 'asc')->get();

        return view('deductions', ['deductions' => $deductions, 'staffs' => $staffs]);
    }



    public function submitdeduction(Request $request){

        $staff = $request->staff;
        $description = $request->description;
        $amount = $request->amount;
        $month = $request->month;

        if(!empty($request->deductionid)){

        //check if more than staff is selected
        if(count($staff) != 1){

            return response()->json([
                "message" => "error",
                "info" => "You are allowed to edit only one staff at a time."
            ]);
        }

        //check if deduction already exist for the selected month

            $check = DB::table('deductions')->where([['staff', $staff[0]],['month', $month]])->count();

            if($check == 1){

                
                //log the event

                $this->logevent("Attempted to add new deduction for ".$staff[0]." for the month of ".$month." to the database, but failed because the event already exist.");


                return response()->json([
                    'message' => 'error',
                    'info' => 'Unable to add deduction to the database, the deduction already exist.'
                ]);
            }


        //update allowance to the database

        $data = array();

        $data['staff'] = $staff[0];
        $data['deduction'] = $description;
        $data['amount'] = $amount;
        $data['month'] = $month;
        $data['updated_at'] = date('Y-m-d H:i:s');

        try {

        $update = DB::table('deductions')->where('id', $request->deductionid)->update($data);

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

            $this->logevent("Updated deduction record for ".$staff[0]." to the database");

            return response()->json([
                'message' => 'success',
                'info' => 'Deduction successfully updated to the database'
            ]);

        }else{

            //log the event

            $logs = array();

            $logs['user'] = Auth::user()->id;
            $logs['action'] = "Attempted to update deduction for the staff ".$staff[0]." to the database, but failed";
            $logs['created_at'] = date('Y-m-d H:i:s');
            $logs['updated_at'] = date('Y-m-d H:i:s');

            $createlogs = DB::table('logs')->insert($logs);


            return response()->json([
                'message' => 'error',
                'info' => 'Error updating deduction to the database, please try again.'
            ]);

        }

        }else{

        //get the total number of staff selected

        $total = count($staff);

        for($i=0; $i<$total; $i++){

            //check if bonus already added to the database

            $check = DB::table('deductions')->where([['staff', $staff[$i]],['month', $month]])->count();

            if($check == 1){

                
                //log the event

                $this->logevent("Attempted to add new deduction for ".$staff[$i]." for the month of ".$month." to the database, but failed because the event already exist.");


                return response()->json([
                    'message' => 'error',
                    'info' => 'Unable to add deduction to the database, the deduction already exist.'
                ]);
            }


            $data = array();

            $data['staff'] = $staff[$i];
            $data['deduction'] = $description;
            $data['amount'] = $amount;
            $data['month'] = $month;
            $data['status'] = "Unpaid";
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = Auth::user()->profileid;

            try {

            $create = DB::table('deductions')->insert($data);

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

                $this->logevent("Added new deduction for ".$staff[$i]." for the month of ".$month." to the database");

            }else{

                //log the event

                $logs = array();

                $logs['user'] = Auth::user()->id;
                $logs['action'] = "Attempted to add new deduction for ".$staff[$i]." for the month of ".$month." to the database, but failed";
                $logs['created_at'] = date('Y-m-d H:i:s');
                $logs['updated_at'] = date('Y-m-d H:i:s');

                $createlogs = DB::table('logs')->insert($logs);

            }

        }


        if($create){

                return response()->json([
                    'message' => 'success',
                    'info' => 'Deduction successfully added to the database'
                ]);

            }else{


                return response()->json([
                    'message' => 'error',
                    'info' => 'Error adding deduction to the database, please try again.'
                ]);

            }


        }
    }


    //delete existing basic pay
    public function deletededuction(Request $request){

        $deduction = DB::table('deductions')->where('id', $request->id)->get();

        try {

            $delete = DB::table('deductions')->where('id', $request->id)->limit(1)->delete();

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

            $this->logevent("Successfully deleted deduction for ".$deduction[0]->staff." for the month of ".$deduction[0]->month." from the database");

            return response()->json([
                "message" => "success",
                "info" => "Deduction successfully removed from the database"
            ]);

        }else{

            //log the event

            $this->logevent("Attempted to delete deduction for ".$deduction[0]->staff." for the month of ".$deduction[0]->month." from the database but failed");

            return response()->json([
                "message" => "error",
                "info" => "Error deleting deduction please try again."
            ]);
        }
    }



    /*********************************************** Deduction Ends Here *******************************************************************************/

    /*********************************************** PAYE Table Begins Here ****************************************************************************/


    public function submitpaye(Request $request){

        $level = $request->level;
        $amount = $request->amount;
        $percenatage = $request->percenatage;

        if(!empty($request->payeid)){


        //update existing allowance

        $data = array();

        $data['level'] = $level;
        $data['amount'] = $amount;
        $data['percentage'] = $percenatage;
        $data['updated_at'] = date('Y-m-d H:i:s');

        try {

        $update = DB::table('paye')->where('id', $request->payeid)->update($data);

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

            $this->logevent("Updated PAYE for Level".$level." to the database");

            return response()->json([
                'message' => 'success',
                'info' => 'PAYE successfully updated to the database'
            ]);

        }else{

            //log the event

            $logs = array();

            $logs['user'] = Auth::user()->id;
            $logs['action'] = "Attempted to update PAYE for Level ".$level." to the database, but failed.";
            $logs['created_at'] = date('Y-m-d H:i:s');
            $logs['updated_at'] = date('Y-m-d H:i:s');

            $createlogs = DB::table('logs')->insert($logs);


            return response()->json([
                'message' => 'error',
                'info' => 'Error updating PAYE to the database, please try again.'
            ]);

        }

        }else{

        //check if basic pay already added to the database

        $check = DB::table('paye')->where('level', $level)->count();

        if($check == 1){

            
            //log the event

            $this->logevent("Attempted to add new paye for Level ".$level." to the database, but failed because the event already exist.");


            return response()->json([
                'message' => 'error',
                'info' => 'Unable to add PAYE to the database, the PAYE selected already exist.'
            ]);
        }

        $data = array();

        $data['level'] = $level;
        $data['amount'] = $amount;
        $data['percentage'] = $percenatage;
        $data['created_by'] = Auth::user()->profileid;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        try {

        $create = DB::table('paye')->insert($data);

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

            $this->logevent("Added new PAYE for Level ".$level." to the database");

            return response()->json([
                'message' => 'success',
                'info' => 'PAYE successfully added to the database'
            ]);

        }else{

            //log the event

            $logs = array();

            $logs['user'] = Auth::user()->id;
            $logs['action'] = "Attempted to add new PAYE for level ".$level." to the database, but failed";
            $logs['created_at'] = date('Y-m-d H:i:s');
            $logs['updated_at'] = date('Y-m-d H:i:s');

            $createlogs = DB::table('logs')->insert($logs);


            return response()->json([
                'message' => 'error',
                'info' => 'Error adding PAYE to the database, please try again.'
            ]);

        }

        }
    }


    //delete existing basic pay
    public function deletepaye(Request $request){

        $paye = DB::table('paye')->where('id', $request->id)->get();

        try {

            $delete = DB::table('paye')->where('id', $request->id)->limit(1)->delete();

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

            $this->logevent("Successfully deleted PAYE for Level ".$paye[0]->level." from the database");

            return response()->json([
                "message" => "success",
                "info" => "PAYE successfully removed from the database"
            ]);

        }else{

            //log the event

            $this->logevent("Attempted to delete PAYE for Level ".$paye[0]->level." from the database but failed");

            return response()->json([
                "message" => "error",
                "info" => "Error deleting PAYE please try again."
            ]);
        }
    }


    public function paye(Request $request){

        $payes = DB::table('paye')->orderBy('level', 'asc')->get();

        return view('paye', ['payes' => $payes]);
    }


    /****************************** PAYE Ends Here **********************************************************************/

    /****************************** Allowed Deductions Begins Here ******************************************************/


    public function submitadeduction(Request $request){

        $deduction = $request->deduction;
        $description = $request->description;

        if(!empty($request->deductionid)){


        //update existing allowance

        $data = array();

        $data['deduction'] = $deduction;
        $data['description'] = $description;
        $data['updated_at'] = date('Y-m-d H:i:s');

        try {

        $update = DB::table('alloweddeductions')->where('id', $request->deductionid)->update($data);

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

            $this->logevent("Updated Allowed Deduction".$deduction." to the database");

            return response()->json([
                'message' => 'success',
                'info' => 'Allowed deduction successfully updated to the database'
            ]);

        }else{

            //log the event

            $logs = array();

            $logs['user'] = Auth::user()->id;
            $logs['action'] = "Attempted to update Allowed Deduction ".$deduction." to the database, but failed.";
            $logs['created_at'] = date('Y-m-d H:i:s');
            $logs['updated_at'] = date('Y-m-d H:i:s');

            $createlogs = DB::table('logs')->insert($logs);


            return response()->json([
                'message' => 'error',
                'info' => 'Error updating Allowed Deduction to the database, please try again.'
            ]);

        }

        }else{

        //check if basic pay already added to the database

        $check = DB::table('alloweddeductions')->where('deduction', $deduction)->count();

        if($check == 1){

            
            //log the event

            $this->logevent("Attempted to add Allowed Deduction ".$deduction." to the database, but failed because the event already exist.");


            return response()->json([
                'message' => 'error',
                'info' => 'Unable to add Allowed Deduction to the database, the Deduction selected already exist.'
            ]);
        }

        //add allowed deduction to the database
        $data = array();

        $data['deduction'] = $deduction;
        $data['description'] = $description;
        $data['created_by'] = Auth::user()->profileid;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        try {

        $create = DB::table('alloweddeductions')->insert($data);

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

            $this->logevent("Added new Allowed Deduction ".$deduction." to the database");

            return response()->json([
                'message' => 'success',
                'info' => 'Allowed Deduction successfully added to the database'
            ]);

        }else{

            //log the event

            $logs = array();

            $logs['user'] = Auth::user()->id;
            $logs['action'] = "Attempted to add new Allowed Deduction ".$deduction." to the database, but failed";
            $logs['created_at'] = date('Y-m-d H:i:s');
            $logs['updated_at'] = date('Y-m-d H:i:s');

            $createlogs = DB::table('logs')->insert($logs);


            return response()->json([
                'message' => 'error',
                'info' => 'Error adding Allowed Deduction to the database, please try again.'
            ]);

        }

        }
    }


    //delete existing basic pay
    public function deleteadeduction(Request $request){

        $deduction = DB::table('alloweddeductions')->where('id', $request->id)->get();

        try {

            $delete = DB::table('alloweddeductions')->where('id', $request->id)->limit(1)->delete();

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

            $this->logevent("Successfully deleted allowance deduction ".$deduction[0]->deduction." from the database");

            return response()->json([
                "message" => "success",
                "info" => "Allowed deduction successfully removed from the database"
            ]);

        }else{

            //log the event

            $this->logevent("Attempted to delete allowed deduction ".$deduction[0]->deduction." from the database but failed");

            return response()->json([
                "message" => "error",
                "info" => "Error deleting allowed deduction please try again."
            ]);
        }
    }



    public function alloweddeductions(Request $request){

        $deductions = DB::table('alloweddeductions')->orderBy('created_at', 'desc')->get();

        return view('alloweddeductions', ['deductions' => $deductions]);
    }


    /*************************************** Allowed Deductions End Here ************************************************************/

    /*************************************** Generate Payslip ***********************************************************************/

    public function generatepayslip(Request $request){

        $staffs = DB::table('profile')->orderBy('surname', 'asc')->get();

        $allowances = DB::table('allowances')->sum('percentage');

        $staffs = DB::table('profile')->orderBy('surname', 'asc')->get();

        return view('process.payslip', ['staffs' => $staffs, 'allowances' => $allowances, 'month' => $request->month, 'staffs' => $staffs]);
    }


    public function payroll(){

        return view('payroll');   

    }


    public function allowanceslip(Request $request){

        $staffs = DB::table('profile')->orderBy('surname', 'asc')->get();

        $allowances = DB::table('allowances')->get();

        $staffallowances = array(array());


        foreach($staffs as $staff){

            foreach($allowances as $allowance){

                $staffallowances[$staff->id][$allowance->allowance] = round($allowance->percentage / 100 * ($this->annualbasic($staff->designation) / 12));
            }
        }

        return view('process.allowanceslip', ['staffs' => $staffs, 'allowances' => $allowances, 'staffallowances' => $staffallowances, 'month' => $request->month]);
    }


    public function deductionslip(Request $request){

        $staffs = DB::table('profile')->orderBy('surname', 'asc')->get();

        $deductions = DB::table('alloweddeductions')->get();

        $staffdeductions = array(array());


        foreach($staffs as $staff){

            foreach($deductions as $deduction){
                if($deduction->deduction == "Pension"){

                    $staffdeductions[$staff->id][$deduction->deduction] = $this->annualpension($staff->designation) / 12;

                }else if($deduction->deduction == "PAYE"){

                    $staffdeductions[$staff->id][$deduction->deduction] = $this->annualtaxcaculation($staff->designation) / 12;
                    
                }else if($deduction->deduction == "NHS"){
                    
                    $staffdeductions[$staff->id][$deduction->deduction] = 0;
                }
                
            }
        }



        return view('process.deductionslip', ['staffs' => $staffs, 'deductions' => $deductions, 'staffdeductions' => $staffdeductions, 'month' => $request->month]);
    }


    public function submitpayroll(Request $request){

        $month = $request->month;
        $staff = $request->staff;
        $designation = $request->designation;
        $basicpay = $request->basicpay;
        $allowances = $request->allowances;
        $grosspay = $request->grosspay;
        $alloweddeductions = $request->alloweddeductions;
        $staffbonuses = $request->staffbonuses;
        $staffdeductions = $request->staffdeductions;
        $netpay = $request->netpay;
        

        $totalstaff = $request->totalstaff;
        $totalbasic = $request->totalbasic;
        $totalallowance = $request->totalallowance;
        $totalgross = $request->totalgross;
        $totaladeduction = $request->totaladeduction;
        $totalbonus = $request->totalbonus;
        $totalsdeduction = $request->totalsdeduction;
        $totalnet = $request->totalnet;
        $sendto = $request->sendto;
        $copy = $request->copy;

        //check if payroll already exist in the database for the month provided

        $check = DB::table('generalpayslip')->where('month', $month)->count();

        if($check == 1){

            //log the event
            $this->logevent("Attempted to create payroll for the month of ".$month." but failed because the event already exist in the database.");

            return response()->json([
                'message' => 'error',
                'info' => 'Payroll for the month of '.$month.' already submitted'
            ]);

        }

        $data = array();

        
        $data['month'] = $month;
        $data['staff'] = $totalstaff;
        $data['basicpay'] = $totalbasic;
        $data['allowances'] = $totalallowance;
        $data['grosspay'] = $totalgross;
        $data['alloweddeduction'] = $totaladeduction;
        $data['staffbonus'] = $totalbonus;
        $data['staffdeduction'] = $totalsdeduction;
        $data['netpay'] = $totalnet;
        $data['status'] = 'Pending';
        $data['recipient'] = $sendto;
        $data['copy'] = $copy;
        $data['created_by'] = Auth::user()->profileid;
        $data['created_at'] = date('Y-m-d H:i:s');

        $newpayroll = DB::table('generalpayslip')->insertGetId($data);

        if($newpayroll){

            $employerpension = 0;
            $employerpaye = 0;

            for($i=0; $i<$totalstaff; $i++){

                $datas = array();

                $datas['payid'] = $newpayroll;
                $datas['month'] = $month;
                $datas['staff'] = $staff[$i];
                $datas['designation'] = $designation[$i];
                $datas['basicpay'] = $basicpay[$i];
                $datas['allowances'] = $allowances[$i];
                $datas['grosspay'] = $grosspay[$i];
                $datas['alloweddeduction'] = $alloweddeductions[$i];
                $datas['staffbonus'] = $staffbonuses[$i];
                $datas['staffdeduction'] = $staffdeductions[$i];
                $datas['netpay'] = $netpay[$i];
                $datas['status'] = 'Pending';
                $datas['created_by'] = Auth::user()->profileid;
                $datas['created_at'] = date('Y-m-d H:i:s');

                $create = DB::table('individualpayslip')->insert($datas);


                if($create){

                    //store staff allowances for the month
                    $monthallowances = $this->monthallowances();

                    foreach($monthallowances as $monthallowance){

                        $adata = array();

                        $adata['staff'] = $staff[$i];
                        $adata['month'] = $month;
                        $adata['allowance'] = $monthallowance->allowance;
                        $adata['amount'] = round($monthallowance->percentage / 100 * $basicpay[$i]);
                        $adata['created_at'] = date('Y-m-d H:i:s');

                        $newallowance = DB::table('monthallowances')->insert($adata);
                        
                    }


                    //store staff deductions for the month
                    $monthdeductions = $this->monthdeductions();

                    foreach($monthdeductions as $monthdeduction){

                        if($monthdeduction->deduction == 'Pension'){
                            $sdeduction = $this->annualpension($designation[$i]) / 12;
                            $employerpension += $sdeduction;
                        }else if($monthdeduction->deduction == 'PAYE'){
                            $sdeduction = $this->annualtaxcaculation($designation[$i]) / 12;
                            $employerpaye += $sdeduction;
                        }

                        $ddata = array();

                        $ddata['staff'] = $staff[$i];
                        $ddata['month'] = $month;
                        $ddata['deduction'] = $monthdeduction->deduction;
                        $ddata['amount'] = round($sdeduction);
                        $ddata['created_at'] = date('Y-m-d H:i:s');

                        $newdeduction = DB::table('monthdeduction')->insert($ddata);


                        //store employer pension
                        if($monthdeduction->deduction == 'Pension'){
                            $edata = array();

                            $edata['staff'] = $staff[$i];
                            $edata['month'] = $month;
                            $edata['deduction'] = $monthdeduction->deduction;
                            $edata['amount'] = round($this->annualemployerpension($designation[$i]) / 12);
                            $edata['created_at'] = date('Y-m-d H:i:s');

                            $newededuction = DB::table('employerdeduction')->insert($edata);
                        }
                        
                    }

                    //send email to actors
                    $username = $this->staffname($staff[$i]);
                    $useremail = $this->profileemail($staff[$i]);
                    
                    try{
                        //send email to the person concerned
                        Mail::send('emails.staffpayrollgenerateemail', ['username' => $username, 'useremail' => $useremail, 'month' => $month], function ($message) use ($username, $useremail, $month) {
                        $message->to($useremail, $username)->subject('Your payslip for the month of '.$month.' has been generated.');
                        $message->from('erp@reliaenergy.com', 'ERP');
                        });
                    }catch(\Exception $e){
                        
                    }

                    //create recipient notification

                    $this->createnotification($staff[$i], 'Payslip', 'New payslip for '.$month, 'Unread', 'individualpayroll');
                }
            }


            //send email to the parties involved
            
                //send email to actors
                $username = $this->staffname($sendto);
                $useremail = $this->profileemail($sendto);
                
                try{
                    //send email to the person concerned
                    Mail::send('emails.payrollgenerateemail', ['username' => $username, 'useremail' => $useremail, 'month' => $month], function ($message) use ($username, $useremail, $month) {
                    $message->to($useremail, $username)->subject('New payroll has been generated and requires your attention.');
                    $message->from('erp@reliaenergy.com', 'ERP');
                    });
                }catch(\Exception $e){
                    
                }

                //create recipient notification

                $this->createnotification($sendto, 'Payroll', 'New payroll for '.$month, 'Unread', 'allpayroll');


                if(!empty($copy)){

                    //send email to actors
                $username = $this->staffname($copy);
                $useremail = $this->profileemail($copy);
                
                try{
                    //send email to the person concerned
                    Mail::send('emails.payrollgenerateemail', ['username' => $username, 'useremail' => $useremail, 'month' => $month], function ($message) use ($username, $useremail, $month) {
                    $message->to($useremail, $username)->subject('New payroll has been generated and requires your attention as copy.');
                    $message->from('erp@reliaenergy.com', 'ERP');
                    });
                }catch(\Exception $e){
                    
                }

                //create recipient notification

                $this->createnotification($copy, 'Payroll', 'New payroll for '.$month, 'Unread', 'allpayroll');


                }


                //log the event
                $this->logevent("Created new payroll for the month of ".$month);

                return response()->json([
                    'message' => 'success',
                    'info' => 'Payroll successfully created',
                    'id' => $newpayroll
                ]);
        }

        
    }


    public function allpayroll(Request $request){

        $payrolls = DB::table('generalpayslip')->orderBy('month', 'desc')->get();

        return view('allpayroll', ['payrolls' => $payrolls]);
    }


    public function individualpayroll(Request $request){

        $payrolls = DB::table('individualpayslip')->where('staff', Auth::user()->profileid)->orderBy('month', 'desc')->get();

        return view('individualpayroll', ['payrolls' => $payrolls]);
    }


    public function payrolldetails(Request $request){

        $payrolls = DB::table('generalpayslip')->where('id', $request->id)->get();

        $payslips = DB::table('individualpayslip')->where('payid', $request->id)->get();

        return view('payrolldetails', ['payrolls' => $payrolls, 'payslips' => $payslips]);

    }


    public function querypayroll(Request $request){

        $month = $request->month;
        $year = $request->year;
        $status = $request->status;

        if(!empty($month)){
            $payrolls = DB::table('generalpayslip')->where('month', $month)->get();
        }else if(!empty($year)){
            $payrolls = DB::table('generalpayslip')->where('month', 'LIKE', $year.'%')->get();
        }else if(!empty($status)){
            $payrolls = DB::table('generalpayslip')->where('status', $status)->get();
        }
        


        return view('process.allpayslip', ['payrolls' => $payrolls]);
    }


    public function updatepayroll(Request $request){

        $status = $request->status;
        $month = $request->month;

        $update = DB::table('generalpayslip')->where('id', $request->id)
                    ->update(['status' => $status, 'updated_at' => date('Y-m-d H:i:s'), 'updated_by' => Auth::user()->profileid]);

        $info = DB::table('generalpayslip')->where('id', $request->id)->get();

        if($update){

            $iupdate = DB::table('individualpayslip')->where('payid', $request->id)
                    ->update(['status' => $status, 'updated_at' => date('Y-m-d H:i:s'), 'updated_by' => Auth::user()->profileid]);

            $staffs = DB::table('individualpayslip')->where('payid', $request->id)->get();

            foreach($staffs as $staff){

                //send email to the staff
                    $username = $this->staffname($staff->staff);
                    $useremail = $this->profileemail($staff->staff);
                    
                    try{
                        //send email to the person concerned
                        Mail::send('emails.staffpayrollupdateemail', ['username' => $username, 'useremail' => $useremail, 'month' => $month], function ($message) use ($username, $useremail, $month) {
                        $message->to($useremail, $username)->subject('Your payslip for the month of '.$month.' has a new update.');
                        $message->from('erp@reliaenergy.com', 'ERP');
                        });
                    }catch(\Exception $e){
                        
                    }

                    //create recipient notification

                    $this->createnotification($staff->staff, 'Payslip', 'New update on the payslip for '.$month, 'Unread', 'individualpayroll');
            }


                //send email to actors
                $username = $this->staffname($info[0]->created_by);
                $useremail = $this->profileemail($info[0]->created_by);
                
                try{
                    //send email to the person concerned
                    Mail::send('emails.payrollgenerateemail', ['username' => $username, 'useremail' => $useremail, 'month' => $month], function ($message) use ($username, $useremail, $month) {
                    $message->to($useremail, $username)->subject('New update on the payroll for the month of '.$month);
                    $message->from('erp@reliaenergy.com', 'ERP');
                    });
                }catch(\Exception $e){
                    
                }

                //create recipient notification

                $this->createnotification($info[0]->created_by, 'Payroll', 'New update on the payroll for the month of '.$month, 'Unread', 'allpayroll');


                if(Auth::user()->profileid == $info[0]->recipient && !empty($info[0]->copy)){

                    //send email to actors
                $username = $this->staffname($info[0]->copy);
                $useremail = $this->profileemail($info[0]->copy);
                
                try{
                    //send email to the person concerned
                    Mail::send('emails.payrollgenerateemail', ['username' => $username, 'useremail' => $useremail, 'month' => $month], function ($message) use ($username, $useremail, $month) {
                    $message->to($useremail, $username)->subject('New update on the payroll for the month of '.$month);
                    $message->from('erp@reliaenergy.com', 'ERP');
                    });
                }catch(\Exception $e){
                    
                }

                //create recipient notification

                $this->createnotification($info[0]->copy, 'Payroll', 'New payroll update for '.$month, 'Unread', 'allpayroll');


                }else if(Auth::user()->profileid == $info[0]->copy){

                    //send email to actors
                $username = $this->staffname($info[0]->recipient);
                $useremail = $this->profileemail($info[0]->recipient);
                
                try{
                    //send email to the person concerned
                    Mail::send('emails.payrollgenerateemail', ['username' => $username, 'useremail' => $useremail, 'month' => $month], function ($message) use ($username, $useremail, $month) {
                    $message->to($useremail, $username)->subject('New update on the payroll for the month of '.$month);
                    $message->from('erp@reliaenergy.com', 'ERP');
                    });
                }catch(\Exception $e){
                    
                }

                //create recipient notification

                $this->createnotification($info[0]->recipient, 'Payroll', 'New payroll update for '.$month, 'Unread', 'allpayroll');


                }


                //log the event
                $this->logevent("Updated payroll for the month of ".$month);

                return response()->json([
                    'message' => 'success',
                    'info' => 'Payroll successfully updated'
                ]);
        }
    }


    public function staffpayslip(Request $request){

        $recipient = DB::table('generalpayslip')->where('month', $request->month)->value('recipient');

        $payslips = DB::table('individualpayslip')->where([['staff', $request->staff], ['month', $request->month]])->get();

        $allowances = DB::table('monthallowances')->where([['staff', $request->staff], ['month', $request->month]])->get();

        $deductions = DB::table('monthdeduction')->where([['staff', $request->staff], ['month', $request->month]])->get();

        $bonuses = DB::table('bonuses')->where([['staff', $request->staff], ['month', $request->month]])->get();

        $staffdeductions = DB::table('deductions')->where([['staff', $request->staff], ['month', $request->month]])->get();

        $employerdeductions = DB::table('employerdeduction')->where([['staff', $request->staff], ['month', $request->month]])->value('amount');

        return view('staffpayslip', ['payslips' => $payslips, 'allowances' => $allowances, 'deductions' => $deductions, 'employerdeductions' => $employerdeductions, 'bonuses' => $bonuses, 'staffdeductions' => $staffdeductions, 'recipient' => $recipient]);
    }


    public function comparepayroll(){

        return view('comparepayroll');
    }


}
