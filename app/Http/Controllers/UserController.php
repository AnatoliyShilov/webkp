<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Type;
use App\UserOrder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index', 
            [
                'users' => User::paginate(10), 
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
        return view('user.create');
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
                'name' => 'required',
                'role' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]
        );
        $newUser = new User;
        $newUser->name = $request->input('name');
        $newUser->role = $request->input('role');
        $newUser->email = $request->input('email');
        $newUser->password = Hash::make($request->input('password'));
        $newUser->save();
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
        $user = User::find($id);
        $userOrders = UserOrder::where('user', $id)->paginate(10);
        return view('user.show', 
            [
                'user' => $user,
                'userOrders' => $userOrders,
                'types' => Type::all()
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', ['user' => $user, 'types' => Type::all()]);
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
                'name' => 'required',
                'role' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]
        );
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->role = $request->input('role');
        $user->email = $request->input('email');
        if ($user->password != $request->input('password'))
            $user->password = Hash::make($request->input('password'));
        $user->save();
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/users');
    }
}
