<?php

namespace App\Http\Controllers;

use App\Models\Logistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_request = Logistic::all()->count();
        // dd(Procurement::where('disbursed_date', '!=', null)->sum('total_price'));
        $total_cost_incured = Logistic::where('status', '=', 'disbursed')->sum('amount');

        $pending = Logistic::where('status', '=', 'pending')->count();
        $approved = Logistic::where('status', '=', 'approved')->count();

        return view('logistics.index', ['logistics' => Logistic::all(), 'total_request' => $total_request, 'total_cost_incured' => $total_cost_incured, $total_cost_incured, 'pending' => $pending, 'approved' => $approved]);
    }


    public function myindex()
    {
        $total_request = Logistic::where('requested_by', '=', Auth::user()->profileid)->count();
        // dd(Procurement::where('disbursed_date', '!=', null)->sum('total_price'));
        $total_cost_incured = Logistic::where('status', '=', 'approved')->sum('amount');

        $pending = Logistic::where('requested_by', '=', Auth::user()->profileid)->where('status', '=', 'pending')->count();
        $approved = Logistic::where('requested_by', '=', Auth::user()->profileid)->where('status', '=', 'approved')->count();

        return view('logistics.myindex', ['logistics' => Logistic::all(), 'total_request' => $total_request, 'total_cost_incured' => $total_cost_incured, $total_cost_incured, 'pending' => $pending, 'approved' => $approved]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('logistics.create', ['staffs' => DB::table('profile')->orderBy('firstname')->get()]);
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
            'title' => ['required', 'string', 'max:255'],
            'purpose' => ['required', 'string', 'max:255'],
            'amount' => 'required',
            'requested_by' => 'required',
            'sent_to' => 'required',
            'start_date' => 'date',
            'end_date' => 'date',
            // 'files.*' => 'file|mimes:pdf,jpeg,png|max:2048'
        ]);


        $formFields['status'] = 'pending';

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $attachment = "";
            $count = 0;

            foreach ($files as $file) {
                // Customize the storage path and file name as per your requirements
                $path = $file->store('logistics');

                if ($count == 0) {
                    $attachment = $path;
                } else {
                    $attachment = $attachment . "*" . $path;
                }


                // Process the file as needed (e.g., save file details to database)
                $count++;
            }

            //  dd($attachment);
            $formFields['attachments'] = $attachment;
        }
        DB::table('logistics')->insert($formFields);
        //  dd($formFields);
        return redirect('/logisticrequest')->with('message', 'Logistics Request created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logistic  $logistic
     * @return \Illuminate\Http\Response
     */
    public function show(Logistic $logistic)
    {
        return view('logistics.show', ['logistic' => $logistic]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logistic  $logistic
     * @return \Illuminate\Http\Response
     */
    public function edit(Logistic $logistic)
    {
        return view('logistics.edit', ['logistic' => $logistic, 'staffs' => DB::table('profile')->orderBy('firstname')->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logistic  $logistic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logistic $logistic)
    {
        $formFields = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'purpose' => ['required', 'string', 'max:255'],
            'amount' => 'required',
            'requested_by' => 'required',
            'sent_to' => 'required',
            'start_date' => 'date',
            'end_date' => 'date',
            'files.*' => 'file|mimes:pdf,jpeg,png|max:2048'

        ]);
        $attachment = "";
        if ($request->hasFile('files')) {
            $files = $request->file('files');

            $count = 0;

            foreach ($files as $file) {
                // Customize the storage path and file name as per your requirements
                $path = $file->store('logistics');

                if ($count == 0) {
                    $attachment = $path;
                } else {
                    $attachment = $attachment . "*" . $path;
                }


                // Process the file as needed (e.g., save file details to database)
                $count++;
            }

            //  dd($attachment);

        }

        $formFields['attachments'] = $attachment;




        $formFields['status'] = 'pending';



        //dd($formFields);
        $logistic->update($formFields);
        $logistic->save();
        //  dd($formFields);
        return redirect("/editlogistic{$logistic->id}")->with('message', 'Logistics Request Edited successfully!');
    }

    public function updatetreat(Request $request, Logistic $logistic)
    {





        $formFields = $request->validate([
            'comment' => 'nullable|string',
            'status' => 'required',
            'treated_by' => 'required',

        ]);
        //$name = if($stock->name == )
        $name = '';
        if ($request->validate(['status' => 'required'])["status"] == "approved") {
            $name = "approval_date";
            $this->createnotification($logistic->requested_by, 'Logistic Request Approved', "You have an Approved Logistic Request", 'Unread', 'mystockrequest');
        } else {
            $name = 'decline_date';
            $this->createnotification($logistic->requested_by, 'Logistic Request Rejected', "You have a Rejected Logistic Request", 'Unread', 'mystockrequest');
        }

        $formFields[$name] = now();





        // dd($srequest);
        $logistic->update($formFields);
        $logistic->save();


        return redirect("/logistic{$logistic->id}")->with('message', 'Approval Action Executed  successfully!');
    }

    public function updateretire(Request $request, Logistic $logistic)
    {





        $formFields = $request->validate([

            'treated_by' => 'required',
            'files.*' => 'file|mimes:pdf,jpeg,png|max:2048'

        ]);
        $attachment = "";




        $formFields["retire_date"] = now();
        $formFields["status"] = "retired";
        if ($request->hasFile('files')) {

            $files = $request->file('files');

            $count = 0;
            foreach ($files as $file) {
                // Customize the storage path and file name as per your requirements
                $path = $file->store('retireattachment');

                if ($count == 0) {
                    $attachment = $path;
                } else {
                    $attachment = $attachment . "*" . $path;
                }


                // Process the file as needed (e.g., save file details to database)
                $count++;
            }

            //  dd($attachment);

        }





        $formFields['retire_attachment'] = $attachment;
        // dd($srequest);
        $logistic->update($formFields);



        $logistic->save();

        $this->createnotification($logistic->requested_by, 'Logistic Request Retired', "You have an Retired A Logistic Request", 'Unread', 'mystockrequest');


        return redirect("/logistic{$logistic->id}")->with('message', 'Retire Action Executed  successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logistic  $logistic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logistic $logistic)
    {
        $logistic->delete();

        return redirect("logisticrequest/")->with('message', 'Logistic Request Deleted successfully!');
    }
}
