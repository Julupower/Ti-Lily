<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //direct the logged in user to the correct page if they are a Author or Admin
        if(Auth::user()->admin == true)
        {
            return redirect(route('adminDashboard'));
        }
        else
            if(Auth::user()->author == true)
            {
                return redirect(route('authorDashboard'));
            }
            else
                {
                    return redirect(route('userDashboard'));
                }
    }
}
