<?php

namespace App;

class ImageService 
{
	protected $api;
	protected $rate_limit_reset_at;
  	protected $rate_limit_allowed;
  	protected $rate_limit_remaining;

	public function __construct()
	{
		\Cloudinary::config(array(
		  "cloud_name" => env('CLOUDINARY_NAME'), 
		  "api_key" => env('CLOUDINARY_API_KEY'), 
		  "api_secret" => env('CLOUDINARY_API_SECRET') 
		));

		$this->api = new \Cloudinary\Api();
	}

	public function resources($options = [])
	{	
		$defaultOptions = ['type' => 'upload', 'context' => true];

		$result = $this->api->resources(
			array_merge($defaultOptions, $options)
		);
		
		return $result['resources'];
	}

	public function upload($file, $options)
	{
		try {
			return \Cloudinary\Uploader::upload($file, $options);
		} catch (Exception $e) {
			report($e);

        	return false;
		}
	}

	public function delete($files)
	{

		$deletes = collect($files)->map(function($file) {
            return \Cloudinary\Uploader::destroy($file);
        });

        return $deletes;
	}
}
