<?php

namespace App\Http\Controllers;

use App\Site;
use App\Mail\SiteClaimed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\ResponseCache\Facades\ResponseCache;

class SiteController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($theme)
    {
        $content = json_encode([
            'name' => 'Cafe navn',
            'title' => 'Reprehenderit in voluptat',
            'menu' => [
                ['name' => 'Kaffe', 'price' => 10],
                ['name' => 'Kage', 'price' => 15],
                ['name' => 'Tea', 'price' => 5],
            ], 
            'intro' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 
            'intro_image'=> 'cafe/karl-fredrickson-35017-unsplash',
            'menu_image'=> 'cafe/nafinia-putra-59655-unsplash',
            'menu_title'=> 'Vores Menu',
            'contact' => [
                'address' => 'bynavn',
                'phone' => '+45 12345678',
                'email' => 'email@cafe.dk'
            ],
            'social' => [
                'instagram' => '@instagram',
                'facebook' => '/facebook',
                'twitter' => '@twitter',
                'snapchat' => 'snapchat'
            ]
        ]);

        return view('build', [
            'theme' => $theme,
            'content' => $content
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $passedData = $request->validate([
            'name' => 'required|max:250',
            'content' => 'required|array',
            'openhours' => 'array'
        ]);
        
        $newSite = Site::create([
            'slug' => strtolower(str_random(5)),
            'name' => $passedData['name'],
            'content' => $passedData['content'],
            'openhours' => $passedData['openhours'],
            'user_id' => null
        ]);   

        return response()->json($newSite, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $site = Site::where('slug', $slug)->first();

        return response()->json($site);
    }

    public function claim($slug)
    {        
        $site = Site::where('slug', $slug)->first();

        if($site->owner !== null || !Auth::check()) {
            abort(403);
        }

        $site->claim(Auth::id());
        $site->refresh();
        
        Mail::to($site->owner)->send(new SiteClaimed($site));

        return response()->json($site);
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $slug)
    {
        $passedData = $request->validate([
            'name' => 'required|max:250',
            'content' => 'required|array',
            'openhours' => 'array'
        ]);

        $site = Site::where('slug', $slug)->firstOrFail();
        
        if($site->owner !== null) {
            if(!Auth::check() && $site->owner->id == Auth::id()) {
                abort(403);
            }
        }

        $site->update([
            'name' => $passedData['name'],
            'content' => $passedData['content'],
            'openhours' => $passedData['openhours'],
        ]);
        
        ResponseCache::forget('http://'.$site->slug.'.'.env('APP_DOMAIN'));

        return response()->json($site);
    }

    
    public function destroy($slug)
    {
        try {
            $site = Site::where('slug', $slug)->firstOrFail();
            
            if(Auth::check() && Auth::user()->isAdmin()) {
                return response()->json($site->delete(), 200);
            }
            
            if($site->owner !== null && $site->owner->id == Auth::id()) {
                return response()->json($site->delete(), 200);
            }

            abort(403);

        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404);
        }
    }
}
