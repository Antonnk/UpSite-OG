<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    
    public function index()
    {
        return view('landing.home');
    }


    
    public function pricing()
    {
        return view('landing.pricing');
    }
}