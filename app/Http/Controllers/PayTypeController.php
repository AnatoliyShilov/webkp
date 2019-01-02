<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PayType;
use App\Type;

class PayTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('paytype.index', 
            [
                'payTypes' => PayType::paginate(10),
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
        return view('payType.create', ['types' => Type::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required'
            ]
        );
        $newPayType = new PayType;
        $newPayType->name = $request->input('name');
        $newPayType->save();
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
        $payType = PayType::find($id);
        return view('paytype.show', ['payType' => $payType, 'types' => Type::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payType = PayType::find($id);
        return view('paytype.edit', ['payType' => $payType, 'types' => Type::all()]);
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
        $this->validate(
            $request,
            [
                'name' => 'reuired'
            ]
        );
        $payType = PayType::find($id);
        $payType->name = $requred->input('name');
        $payType->save();
        return redirect('/paytypes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payType = PayType::find($id);
        $payType->delete($id);
        return redirect('/paytypes');
    }
}
