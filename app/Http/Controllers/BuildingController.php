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



        return view('training.myindex', ['trainings' => Building::all()]);
    }
    public function myindex()
    {
        return view('training.myindex', ['trainings' => Building::all()]);
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
    public function update(Request $request, Building $building)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        //
    }
}
