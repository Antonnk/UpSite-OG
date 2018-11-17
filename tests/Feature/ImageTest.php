<?php

namespace Tests\Feature;

use App\ImageService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageTest extends TestCase
{
    
    use RefreshDatabase;

    /**
     * Test images can be fetch from the cache
     *
     * @return void
     */
    public function test_images_can_be_fetched_from_cache_by_path()
    {
    	$folder = 'demo';
    	$cacheKey = "cl.resources.$folder.";

    	Cache::shouldReceive('has')
    		->once()
    		->with($cacheKey)
    		->andReturn(true);

		Cache::shouldReceive('get')
			->once()
			->with($cacheKey)
			->andReturn(["images" => [
				0 => [
					"public_id" => "demo/yjlai0mo8svtjmtrklcn",
					"format" => "png",
					"type" => "upload"
				]
			]]);

    	// fetch images from demo folder 
        $response = $this->get("/images/$folder");
		
        $response
        	->assertStatus(200)
        	->assertJsonFragment(["type" => "upload"])
        	->assertJson(['cached' => true]);
    }

	/**
     * Test images can be fetch from live service if not i cache
     *
     * @return void
     */
    public function test_images_can_be_fetched_from_live_service_by_path()
    {
    	$folder = 'demo';
    	$cacheKey = "cl.resources.$folder.";
		$imageResponse = [
			"images" => [
				0 => [
					"public_id" => "demo/yjlai0mo8svtjmtrklcn",
					"format" => "png",
					"type" => "upload"
				]
			]
		];

    	Cache::shouldReceive('has')->once()
    		->with($cacheKey)
    		->andReturn(false);

    	Cache::shouldReceive('put')
    		->once()
    		->with($cacheKey, \Mockery::any(), \Mockery::any())
    		->andReturn(true);

    	Cache::shouldReceive('get')->once()
			->with($cacheKey)
			->andReturn($imageResponse);

        $imageService = \Mockery::mock(ImageService::class);
        $this->app->instance(ImageService::class, $imageService);
        $imageService->shouldReceive('resources')
            ->once()
            ->andReturn($imageResponse);


    	// fetch images from demo folder 
        $response = $this->get("/images/$folder");
		
        $response
        	->assertStatus(200)
        	->assertJsonFragment(["type" => "upload"])
        	->assertJson(['cached' => false]);
    }

    /**
     * Test a user can upload images
     *
     * @return void
     */
    public function test_images_can_be_uploaded_by_a_user() 
    {
        // setup a user
        $user = factory(\App\User::class)->create();
        
        // mock storage 
        Storage::fake('avatars');

        // mock imageservice
        $imageService = \Mockery::mock(ImageService::class);
        $this->app->instance(ImageService::class, $imageService);
        $imageService->shouldReceive('upload')
            ->once()
            ->with(\Mockery::any(), \Mockery::any())
            ->andReturn([
                    "public_id" => "demo/yjlai0mo8svtjmtrklcn",
                    "format" => "png",
                    "type" => "upload"
            ]);

        // fake a file
        $file = UploadedFile::fake()->image('avatar.jpg');
    
        // post file to endpoint as $user
        $response = $this->actingAs($user)->json('POST', '/images', [
            'file' => $file,
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['public_id']);
    }

    /**
     * Test a guest cant upload images
     *
     * @return void
     */
    public function test_images_cant_be_uploaded_if_not_logged_in() 
    {   
        // mock storage 
        Storage::fake('avatars');

        // mock imageservice
        $imageService = \Mockery::mock(ImageService::class);
        $this->app->instance(ImageService::class, $imageService);
        $imageService->shouldReceive('upload')->never();

        // fake a file
        $file = UploadedFile::fake()->image('avatar.jpg');
    
        // post file to endpoint as $user
        $response = $this->json('POST', '/images', [
            'file' => $file,
        ]);

        $response
            ->assertStatus(401);
    }

    /**
     * Test a user can delete images
     *
     * @return void
     */
    public function test_user_can_delete_images() 
    {
        // setup a user
        $user = factory(\App\User::class)->create();

        // mock imageservice
        $imageService = \Mockery::mock(ImageService::class);
        $this->app->instance(ImageService::class, $imageService);
        $imageService->shouldReceive('delete')
            ->once()
            ->with(['sample_public_id'])
            ->andReturn([
                "result" => "ok",
            ]);

    
        // post file to endpoint as $user
        $response = $this->actingAs($user)->json('DELETE', '/images', [
            'file' => 'sample_public_id',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['result']);
    }

    /**
     * Test a guest cant delete images
     *
     * @return void
     */
    public function test_images_cant_be_deleted_if_not_logged_in() 
    {
        // mock imageservice
        $imageService = \Mockery::mock(ImageService::class);
        $this->app->instance(ImageService::class, $imageService);
        $imageService->shouldReceive('delete')->never();

    
        // post file to endpoint as $user
        $response = $this->json('DELETE', '/images', [
            'file' => 'sample_public_id',
        ]);

        $response->assertStatus(401);
    }

}
