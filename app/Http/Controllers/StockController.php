<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Stock;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stock.index', 
            [
                'types' => Type::all(),
                'stocks' => Stock::orderBy('created_at', 'desc')->paginate(10)
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('stock.create', 
            [
                'product' => $id,
                'types' => Type::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'discount' => 'required|between:0,99.99',
                'ablefrom' => 'required',
                'ableto' => 'required|date'
            ]
        );
        $newStock = new Stock();
        $newStock->name = $request->input('name');
        $newStock->discount = $request->input('discount');
        $newStock->product = $id;
        $newStock->ablefrom = $request->input('ablefrom');
        $newStock->ableto = $request->input('ableto');
        $newStock->save();
        return $this->index();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = Stock::find($id);
        return view('stock.edit', ['stock' => $stock, 'types' => Type::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'discount' => 'required|between:0,99.99',
                'ablefrom' => 'required',
                'ableto' => 'required|date'
            ]
        );
        $stock = Stock::find($id);
        $stock->name = $request->input('name');
        $stock->discount = $request->input('discount');
        $stock->ablefrom = $request->input('ablefrom');
        $stock->ableto = $request->input('ableto');
        $stock->save();
        return redirect('/stocks');
    }
}
