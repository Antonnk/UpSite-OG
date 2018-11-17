<?php

namespace App\Http\Controllers;

use App\ImageService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ImageController extends Controller
{

    public function __construct(ImageService $imageService)
    {
        $this->middleware('auth')->only(['store', 'destroy']);

        $this->imageService = $imageService;
    }
    
    public function index($folder = '', $subfolder = '')
    {
        $cacheKey = "cl.resources.$folder.$subfolder";

        if(Cache::has($cacheKey)) {
            return response()->json([
                'cached' => true,
                'images' => Cache::get($cacheKey)
            ]);
        }
        
        $images = $this->imageService->resources(['prefix' => "$folder/$subfolder"]);
        Cache::put($cacheKey, $images, Carbon::now()->addDays(10));

        return response()->json([
            'cached' => false,
            'images' => Cache::get($cacheKey)
        ]);
    }

    /**
     * Stores a new image on the image service
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $passedData = $request->validate([
            'file' => 'image',
        ]);

        $folder = 'user_uploads/user-'.Auth::id();

        $result = $this->imageService->upload($passedData['file'], [
            'use_filename' => true,
            'folder' => $folder
        ]);

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $files = is_array($request->file) ? $request->file : [$request->file];
        
        $deletes = $this->imageService->delete($files);

        return response()->json($deletes);
    }
}
