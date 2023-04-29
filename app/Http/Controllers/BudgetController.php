<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BudgetController extends Controller
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

        return view('budget.index', ['budgets' => Budget::all()]);
    }

    public function myindex()
    {

        return view('budget.myindex', ['budgets' => Budget::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('budget.create', ['staffs' => DB::table('profile')->orderBy('firstname')->get()]);
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
            'number' => ['required', 'string',],
            'description' => ['required', 'string'],
            'amount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'actual_amount' => 'required',
            'requested_by' => 'required',
            'sent_to' => ['required', 'integer', 'max:11'],
        ]);



        $formFields['status'] = 'pending';
        $formFields['variance'] = $formFields['actual_amount'] - $formFields['amount'];
        //dd($formFields);
        DB::table('budgets')->insert($formFields);
        //  dd($formFields);
        return redirect('/mybudgets')->with('message', 'Budget Request created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget)
    {
        return view('budget.show', ['budget' => $budget]);
    }

    public function show2(Budget $budget)
    {
        return view('budget.show2', ['budget' => $budget]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget $budget)
    {
        return view('budget.edit', ['staffs' => DB::table('profile')->orderBy('firstname')->get(), 'budget' => $budget]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Budget $budget)
    {
        $formFields = $request->validate([
            'number' => ['required', 'string',],
            'description' => ['required', 'string'],
            'amount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'actual_amount' => 'required',
            'requested_by' => 'required',
            'sent_to' => ['required', 'integer', 'max:11'],
        ]);



        //dd($formFields);
        $budget->update($formFields);
        $budget->save();


        return redirect("/editbudget{$budget->id}")->with('message', 'Budget Request updated successfully!');
    }

    public function updatetreat(Request $request, Budget $budget)
    {



        $formFields = $request->validate([
            'comment' => 'nullable|string',
            'status' => 'required',
            'treated_by' => 'required',

        ]);
        //$name = if($stock->name == )
        $name = '';
        if ($request->validate(['status' => 'required'])["status"] == "approve") {
            $name = "approval_date";
            $this->createnotification($budget->requested_by, 'Budget Request Approved', "You have an Approved Budget Request", 'Unread', 'mystockrequest');
        } else {
            $name = 'decline_date';
            $this->createnotification($budget->requested_by, 'Budget Request Rejected', "You have a Rejected Budget Request", 'Unread', 'mystockrequest');
        }

        $formFields[$name] = now();





        // dd($srequest);
        $budget->update($formFields);
        $budget->save();


        return redirect("/showbudget{$budget->id}")->with('message', ' Action Executed  successfully!');
    }


    public function updatedisburse(Request $request, Budget $budget)
    {



        //  dd($formFields);
        $budget->disburse_date = now();
        $budget->status = "disbursed";

        $budget->save();

        return redirect("/showbudget{$budget->id}")->with('message', 'Disbursed Action Executed  successfully!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget)
    {

        $budget->delete();

        return redirect("budgets/")->with('message', 'Budget Deleted successfully!');
    }
}
