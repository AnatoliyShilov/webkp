<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', ['types' => Type::all()]);
    }
}
