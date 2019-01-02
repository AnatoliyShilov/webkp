<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeliveryType;
use App\Type;

class DeliveryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('deliverytype.index', 
            [
                'deliveryTypes' => DeliveryType::paginate(10),
                'types' => Type::all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deliverytype.create', ['types' => Type::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            ['name' => 'required']
        );
        $newDeliveryType = new DeliveryType();
        $newDeliveryType->name = $request->input('name');
        $newDeliveryType->save();
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deliveryType = DeliveryType::find($id);
        return view('deliverytype.show', ['deliveryType' => $deliveryType]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $deliveryType = DeliveryType::find($id);
        return view('deliverytype.edit', ['deliveryType' => $deliveryType]);
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
            ['name' => 'required']
        );
        $deliveryType = DeliveryType::find($id);
        $deliveryType->name = $request->input('name');
        $deliveryType->save();
        return redirect('/deliverytypes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deliveryType = DeliveryType::find($id);
        $deliveryType->delete();
        return redirect('/deliverytypes');
    }
}
