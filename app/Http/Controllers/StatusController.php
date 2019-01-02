<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Status;

class StatusController extends Controller
{
    /**
     * Display a list of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('status.index', 
            [
                'types' => Type::all(), 
                'statuses' => Status::paginate(10)
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
        return view('status.create', ['types' => Type::all()]);
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
        $newStatus = new Status();
        $newStatus->name = $request->input('name');
        $newStatus->save();
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
        $status = Status::find($id);
        return view('status.show', ['status' => $status, 'types' => Type::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = Status::find($id);
        return view('status.edit', ['status' => $status, 'types' => Type::all()]);
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
        $status = Status::find($id);
        $status->name = $request->input('name');
        $status->save();
        return redirect('/statuses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Status::find($id);
        $status->delete();
        return redirect('/statuses');
    }
}
