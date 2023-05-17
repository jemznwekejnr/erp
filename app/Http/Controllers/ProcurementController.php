<?php

namespace App\Http\Controllers;

use App\Models\Procurement;
use App\Models\Stockrequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProcurementController extends Controller
{

    //Authenticate user
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $total_request = Procurement::all()->count();
        // dd(Procurement::where('disbursed_date', '!=', null)->sum('total_price'));
        $total_cost_incured = Procurement::where('disbursed_date', '=', null)->sum('total_price');

        $pending = Procurement::where('status', '=', 'pending')->count();
        $approved = Procurement::where('status', '=', 'approved')->count();
        return view('procurements.index', ['procurements' => Procurement::all(), 'total_request' => $total_request, 'total_cost_incured' => $total_cost_incured, $total_cost_incured, 'pending' => $pending, 'approved' => $approved]);
    }
    public function myindex()
    {
        $total_request = Procurement::where('requested_by', '=', Auth::user()->profileid)->count();
        // dd(Procurement::where('disbursed_date', '!=', null)->sum('total_price'));
        $total_cost_incured = Procurement::where('disbursed_date', '=', null)->sum('total_price');

        $pending = Procurement::where('requested_by', '=', Auth::user()->profileid)->where('status', '=', 'pending')->count();
        $approved = Procurement::where('requested_by', '=', Auth::user()->profileid)->where('status', '=', 'approved')->count();
        return view('procurements.myindex', ['procurements' => Procurement::all(), 'total_request' => $total_request, 'total_cost_incured' => $total_cost_incured, $total_cost_incured, 'pending' => $pending, 'approved' => $approved]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('procurements.create', ['staffs' => DB::table('profile')->orderBy('firstname')->get()]);
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
            'item' => ['required', 'string', 'max:255'],
            'quantity' => 'required',
            'unit_price' => 'required',
            'total_price' => 'required',
            'requested_by' => 'required',
            'sent_to' => 'required',
            'date' => ['required'],
            //  'files.*' => 'file|mimes:pdf,jpeg,png|max:2048'
        ]);






        $formFields['status'] = 'pending';

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $attachment = "";
            $count = 0;

            foreach ($files as $file) {
                // Customize the storage path and file name as per your requirements
                $path = $file->store('procurements');

                if ($count == 0) {
                    $attachment = $path;
                } else {
                    $attachment = $attachment . "*" . $path;
                }


                // Process the file as needed (e.g., save file details to database)
                $count++;
            }

            //dd($attachment);
            $formFields['attachment'] = $attachment;
        }


        //    dd($formFields);

        DB::table('procurements')->insert($formFields);

        return redirect('/myprocurements')->with('message', 'Procurement Request created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Procurement  $procurement
     * @return \Illuminate\Http\Response
     */
    public function show(Procurement $procurement)
    {
        return view('procurements.show', ['procurement' => $procurement]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Procurement  $procurement
     * @return \Illuminate\Http\Response
     */
    public function edit(Procurement $procurement)
    {
        return view('procurements.edit', ['procurement' => $procurement, 'staffs' => DB::table('profile')->orderBy('firstname')->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Procurement  $procurement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Procurement $procurement)
    {
        $formFields = $request->validate([
            'item' => ['required', 'string', 'max:255'],
            'quantity' => 'required',
            'unit_price' => 'required',
            'total_price' => 'required',
            'requested_by' => 'required',
            'sent_to' => 'required',
            'date' => ['required'],
            'files.*' => 'file|mimes:pdf,jpeg,png|max:2048'
        ]);

        $formFields['status'] = 'pending';
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $attachment = "";
            $count = 0;

            foreach ($files as $file) {
                // Customize the storage path and file name as per your requirements
                $path = $file->store('procurements');

                if ($count == 0) {
                    $attachment = $path;
                } else {
                    $attachment = $attachment . "*" . $path;
                }


                // Process the file as needed (e.g., save file details to database)
                $count++;
            }


            $formFields['attachment'] = $attachment;
        }


        //  dd($formFields);
        $procurement->update($formFields);
        $procurement->save();


        return redirect("/procurementedit{$procurement->id}")->with('message', 'Procurement Request updated successfully!');
    }


    public function treat(Request $request, Procurement $procurement)
    {
        $formFields = $request->validate([
            'status' => 'required',
            'treat_comment' => 'nullable|string'

        ]);

        if ($formFields["status"] == "approve") {
            $procurement->approval_date = now();
            $procurement->status = "approved";
        } else {
            $procurement->decline_date = now();
            $procurement->status = "rejected";
        }

        if (!is_null($formFields["treat_comment"])) {
            $procurement->treat_comment = $formFields["treat_comment"];
        }
        $procurement->treated_by = Auth::user()->profileid;
        //dd($formFields);
        //    $procurement->update($formFields);
        $procurement->save();


        return redirect("/procurement{$procurement->id}")->with('message', 'Procurement Request Treated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Procurement  $procurement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Procurement $procurement)
    {
        $procurement->delete();

        return redirect("procurements/")->with('message', 'Procurement Deleted successfully!');
    }
}
