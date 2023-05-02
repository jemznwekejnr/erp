<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
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
        $categories =  Category::all()->count();
        $amount = Stock::all()->sum('total_amount');
        $low = Stock::where('qty_purchased', '<', 10)->count();

        return view('stocks.index', ['stocks' => Stock::all(), 'categories' => $categories, 'amount' => $amount, 'low' => $low]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stocks.create');
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
            'name' => 'required|string|max:255|unique:stocks',
            'stock_id' => 'required|unique:stocks',
            'cat_id' => 'required',
            'qty_purchased' => 'required',
            'unit_price' => 'required',
            'total_amount' => 'required',
            'supplier' => 'required'
        ]);


        $formFields['qty_in_stock'] = $formFields['qty_purchased'];
        $formFields['status'] = 'In stock';

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('image', 'local');
        }



        DB::table('stocks')->insert($formFields);
        return redirect('/stocks')->with('message', 'Stock created successfully!');
    }


    public function storerequest(Request $request)
    {
        $formFields = $request->validate([
            'qty_requested' => 'required',
            'stock_id' => 'required',

        ]);
        $data = $request->all();
        $qty_requested = $data['qty_requested'];
        $stock_id = $data['stock_id'];

        $stock = Stock::find($stock_id);

        if ($stock->qty_in_stock < $qty_requested) {
            $errorMessage = 'You Request is more than the number of that particular Item in Stock';
            return view('stocks.request', compact('errorMessage'));
        }



        // DB::table('stocks')->insert($formFields);
        return redirect('/stocks')->with('message', 'Stock created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        return view('stocks.show', ['stock' => $stock]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        return view('stocks.edit', ['stock' => $stock]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        $name = '';
        if ($request->validate(['name' => 'required'])["name"] == $stock->name) {
            $name = "required";
        } else {
            $name = 'required|string|max:255|unique:stocks';
        }

        $stock_id = '';
        if ($request->validate(['stock_id' => 'required'])["stock_id"] == $stock->stock_id) {
            $stock_id = "required";
        } else {
            $stock_id = 'required|unique:stocks';
        }

        //$name = if($stock->name == )


        $formFields = $request->validate([
            'name' => $name,
            'stock_id' => $stock_id,
            'cat_id' => 'required',
            'qty_purchased' => 'required',
            'unit_price' => 'required',
            'total_amount' => 'required',
            'supplier' => 'required'
        ]);


        $formFields['qty_in_stock'] = $formFields['qty_purchased'];

        $formFields['status'] = 'In stock';

        if ($request->hasFile('image')) {
            //    dd($formFields['image'] = $request->file('image')->store('image', 'local'));
            $stock->image = $request->file('image')->store('image', 'local');
        }



        //dd($formFields);
        $stock->update($formFields);
        $stock->save();


        return redirect("stocks/")->with('message', 'Stock Edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect("stocks/")->with('message', 'Stock Deleted successfully!');
    }
}
