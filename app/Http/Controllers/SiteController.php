<?php

namespace App\Http\Controllers;

use App\Site;
use App\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if(Auth::check()) {
            return redirect()->route('account.index');
        }


        try {
            $theme = \App\Theme::where('slug', $theme)->firstOrFail();
        } catch (Exception $e) {
            abort(404);
        }
        
        $default_openhours = [
            'weekdays' => [
                [ 'name' => 'monday', 'open' => null, 'close' => null],
                [ 'name' => 'tuesday', 'open' => null, 'close' => null],
                [ 'name' => 'wednesday', 'open' => null, 'close' => null],
                [ 'name' => 'thursday', 'open' => null, 'close' => null],
                [ 'name' => 'friday', 'open' => null, 'close' => null],
                [ 'name' => 'saturday', 'open' => null, 'close' => null],
                [ 'name' => 'sunday', 'open' => null, 'close' => null],
            ],
            'exceptions' => [ 
                // juleaften
                [ 'name' => '12-24', 'open' => null, 'close' => null]
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
        try {
            $site = Site::where('slug', $slug)->first();
            
            return view('render', [
                'theme' => $site->theme->slug,
                'site' => $site,
                'structuredData' => $this->buildStructuredData($site)
            ]);
        } catch (\Exception $e) {
            abort(404);
        }
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
        $openingHoursSpecification = array_filter($site->openhours['weekdays'], function($day) {
            if($day['open'] == null) return false;
            return true;
        });
        
        $openingHoursSpecification = array_map(function($day) {
            return [
                "@type" => "OpeningHoursSpecification",
                "dayOfWeek" => $day['name'],
                "opens" => $day['open'],
                "closes" => $day['close']
            ];
        }, $openingHoursSpecification);

        return [
            "@context" => "http://schema.org",
            "@type" => "LocalBusiness",
            "@id" => $site->url(),
            "name" => $site->name,
            "image" => [$site->coverImageUrl],
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => $site->content['contact']['address']['street'],
                "addressLocality" => $site->content['contact']['address']['city'],
                "postalCode" => $site->content['contact']['address']['postcode'],
                "addressCountry" => "DK"
            ],
            "url" => $site->url(),
            "telephone" => $site->content['contact']['phone'],
            "openingHoursSpecification" => $openingHoursSpecification
            
            ];
    }
}
