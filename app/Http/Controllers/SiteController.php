<?php

namespace App\Http\Controllers;

use App\Site;
use App\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\OpeningHours\OpeningHours;
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
        try {
            $theme = \App\Theme::where('slug', $theme)->firstOrFail();
        } catch (Exception $e) {
            abort(404);
        }
        
        $default_openhours = [
            'monday' => [ 'open' => null, 'close' => null],
            'tuesday' => [ 'open' => null, 'close' => null],
            'wednesday' => [ 'open' => null, 'close' => null],
            'thursday' => [ 'open' => null, 'close' => null],
            'friday' => [ 'open' => null, 'close' => null],
            'saturday' => [ 'open' => null, 'close' => null],
            'sunday' => [ 'open' => null, 'close' => null],
            'exceptions' => [ 
                // juleaften
                '12-24' => ['open' => null, 'close' => null]
            ]
        ];


        $styleSheetPath = mix("css/$theme->slug.css");

        return view('build', [
            'styleSheetPath' => $styleSheetPath,
            'theme' => $theme->slug,
            'content' => $theme->preset_content,
            'openhours' => $default_openhours,
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
            'openhours' => 'array',
            'theme' => 'required|string'
        ]);

        $openhours = $passedData['openhours'];

        // foreach ($passedData['openhours'] as $key => $value) {
        //     if($key != 'exceptions') {
        //         $openhours[$key] = ($value['open'] && $value['close']) ? [$value['open']."-".$value['close']] : [];
        //     }else {
        //         foreach ($value as $key => $value) {
        //             $openhours['exceptions'][$key] = ($value['open'] && $value['close']) ? [$value['open']."-".$value['close']] : [];
        //         }
        //     }
        // }
            
        $theme = Theme::where('slug', strtolower($passedData['theme']))->first();

        $newSite = Site::create([
            'slug' => strtolower(str_random(5)),
            'name' => $passedData['name'],
            'content' => $passedData['content'],
            'openhours' => $openhours,
            'user_id' =>  (Auth::check() ? Auth::id() : null),
            'theme_id' => $theme->id
        ]);

        session(['site.slug' => $newSite->slug]);

        $response = array_merge(
            ['redirect' => route('register')],
            $newSite->toArray()
        );

        return response()->json($response, 201);
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
        return view('render', [
            'theme' => $site->theme->slug,
            'site' => $site,
            'structuredData' => $this->buildStructuredData($site)
        ]);
    }

    public function claim($slug)
    {        
        $site = Site::where('slug', $slug)->first();

        if($site->owner !== null || !Auth::check()) {
            abort(403);
        }

        $site->claim(Auth::id());
        $site->refresh();

        return response()->json($site);
    }

    
    public function edit($slug)
    {
        $site = Site::where('slug', $slug)->first();
        if($site->owner->id != Auth::id()) {
            return back();
        }

        $styleSheetPath = mix("css/{$site->theme->slug}.css");

        return view('build', [
            'slug' => $site->slug,
            'styleSheetPath' => $styleSheetPath,
            'theme' => $site->theme->slug,
            'content' => $site->content,
            'openhours' => $site->openhours
        ]);
    
    }

    
    public function update(Request $request, $slug)
    {
        $passedData = $request->validate([
            'name' => 'required|max:250',
            'content' => 'required|array',
            'openhours' => 'array',
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
        
        ResponseCache::forget($site->url());

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

    public function manifest($slug)
    {
        $site = Site::where('slug', $slug)->first();

        return response()->json([
            'name' => $site->name,
            'short_name' => $site->name,
            'start_url' => $site->url(),
            'display' => 'browser',
            'background_color' => '#fff',
            'description' => $site->description,
        ]);
    }

    public function buildStructuredData($site)
    {
        return [
            "@context" => "http://schema.org",
            "@id" => $site->url(),
            "name" => $site->name,
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => "148 W 51st St",
                "addressLocality" => "New York",
                "addressRegion" => "NY",
                "postalCode" => "10019",
                "addressCountry" => "US"
            ],
            "url" => $site->url(),
            "telephone" => $site->content['contact']['phone'],
            "openingHoursSpecification" => array_map(function($key, $day) {
                return [
                    "@type" => "OpeningHoursSpecification",
                    "dayOfWeek" => $key,
                    "opens" => $day['open'],
                    "closes" => $day['close']
                ];
            }, array_keys($site->openhours), $site->openhours)
            
            ];
    }
}
