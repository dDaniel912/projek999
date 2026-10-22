<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function dashboard()
    {
        $test = Test::all();

        return view('test.dashboard', compact('test'));
    }
    public function showLogin()
    {
        return view('test.login');
    }

    public function index()
    {
        return view('test.login');
    }
    
}
