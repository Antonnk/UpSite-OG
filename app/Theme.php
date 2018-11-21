<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $casts = [
	    'preset_content' => 'array',
	];

	public function getCoverImageAttribute()
    {
        return $this->preset_content['intro_image'];
    }
}
