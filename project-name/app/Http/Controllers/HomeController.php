<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {

            $usertype = Auth()->user()->usertype;

            if ($usertype == 'user') {
                return view('user');

            } elseif ($usertype == 'admin') {
                return view('admin');

            } elseif ($usertype == 'manager') {
                return view('manager');
            }
            else{
                return view('welcome');
            }
        }
        
    }
}   
