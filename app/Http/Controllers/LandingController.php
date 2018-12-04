<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    
    public function index()
    {
        return view('landing.home');
    }

	public function contact()
    {
        return view('landing.contact');
    }

    public function contactSend(Request $request)
    {
    	$passedData = $request->validate([
            'email' => 'required|max:250|email',
            'message' => 'required|string|max:500'
        ]);

        return response()->json($passedData, 201);
    }
    
    public function pricing()
    {
        return view('landing.pricing');
    }
}
