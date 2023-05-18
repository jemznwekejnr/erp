<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;





class BuildingController extends Controller
{
    //Authenticate user
    public function __construct(Building $building)
    {
        $this->middleware('auth');
        //  $this->building = $building;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_request = Building::all()->count();
        // dd(Procurement::where('disbursed_date', '!=', null)->sum('total_price'));
        $staff_trained = Building::where('status', '=', 'approved');
        $total_staff_trained = 0;

        foreach (Building::all() as $staff) {
            // $total_staff_trained += count(explode(',', $staff->trainees));
            if ($staff->status == "approved") {
                $total_staff_trained += count(explode(',', $staff->trainees));
            }
        }




        $total_training_done = Building::where('status', '=', 'approved')->count();
        $staff_training_rate = Building::where('status', '=', 'to-do')->count();



        return view('training.index', ['trainings' => Building::all(), 'total_request' => $total_request, 'total_staff_trained' => $total_staff_trained, 'total_training_done' => $total_training_done, 'staff_training_rate' => $staff_training_rate]);
    }
    public function myindex()
    {
        $total_request = Building::where('requested_by', '=', Auth::user()->profileid)->count();
        // dd(Procurement::where('disbursed_date', '!=', null)->sum('total_price'));
        $staff_trained = Building::where('requested_by', '=', Auth::user()->profileid)->where('status', '=', 'approved');
        $total_staff_trained = 0;

        foreach (Building::all() as $staff) {
            // $total_staff_trained += count(explode(',', $staff->trainees));
            if ($staff->status == "approved") {
                $total_staff_trained += count(explode(',', $staff->trainees));
            }
        }




        $total_training_done = Building::where('requested_by', '=', Auth::user()->profileid)->where('status', '=', 'approved')->count();



        return view('training.myindex', ['trainings' => Building::all(), 'total_request' => $total_request, 'total_staff_trained' => $total_staff_trained, 'total_training_done' => $total_training_done]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('training.create', ['staffs' => DB::table('profile')->orderBy('firstname')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $formFields = $request->validate([
            'description' => ['required', 'string',],
            'training_type' => 'required',
            'duration' => 'integer',
            'training_mode' => 'required',
            'training_date' => 'required',
            'trainees' => 'required',
        ]);

        $formFields["requested_by"] = Auth::user()->profileid;

        $formFields['trainees'] = implode(", ", $formFields['trainees']);


        //dd($formFields);
        DB::table('buildings')->insert($formFields);
        //  dd($formFields);
        return redirect('/mytrainings')->with('message', 'Training Request created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show($building)
    {

        return view('training.show', ['training' => Building::find($building)]);
    }

    public function show2($building)
    {

        return view('training.show2', ['training' => Building::find($building)]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit($building)
    {
        return view('training.edit', ['staffs' => DB::table('profile')->orderBy('firstname')->get(), 'training' => Building::find($building)]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $building)
    {
        $formFields = $request->validate([
            'description' => ['required', 'string',],
            'training_type' => 'required',
            'duration' => 'integer',
            'training_mode' => 'required',
            'training_date' => 'required',
            'trainees' => 'required',
        ]);
        $formFields['trainees'] = implode(", ", $formFields['trainees']);

        $srequest = Building::find($building);
        //dd($formFields);
        $srequest->update($formFields);
        $srequest->save();


        return redirect("/edittraining{$srequest->id}")->with('message', 'Training Request updated successfully!');
    }

    public function treat(Request $request, $building)
    {





        $formFields = $request->validate([
            'treat_comment' => 'nullable|string',
            'status' => 'required',
            'treated_by' => 'required',

        ]);

        $brequest = Building::find($building);
        //$name = if($stock->name == )
        $name = '';
        if ($request->validate(['status' => 'required'])["status"] == "approved") {
            $name = "approval_date";
            $this->createnotification($brequest->requested_by, 'Training Request Approved', "You have an Approved Training Request", 'Unread', 'mystockrequest');
        } else {
            $name = 'decline_date';
            $this->createnotification($brequest->requested_by, 'Training Request Rejected', "You have a Rejected Training Request", 'Unread', 'mystockrequest');
        }

        $formFields[$name] = now();






        $brequest->update($formFields);
        $brequest->save();


        return redirect("/showtraining{$brequest->id}")->with('message', 'Approval Action Executed  successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy($building)
    {
        $srequest = Building::find($building)->delete();


        return redirect('/mytrainings')->with('message', 'Training Request Deleted successfully!');
    }
}
