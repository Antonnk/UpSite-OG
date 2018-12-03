<?php

namespace App;

use App\Mail\SiteClaimed;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Spatie\OpeningHours\OpeningHours;

class Site extends Model
{
	protected $guarded = [];

	protected $casts = [
	    'content' => 'array',
	    'openhours' => 'array'
	];

	public function claim($user_id)
	{
		$this->user_id = $user_id;
		$this->save();
		$this->refresh();

        Mail::to($this->owner)->send(new SiteClaimed($this));

		return $this;
	}

	public function url()
	{
		return route('site.show', ['slug' => $this->slug]);
	}

	public function getOpenhours()
	{	
		return OpeningHours::create($this->openhours);
	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function theme()
	{
		return $this->belongsTo(Theme::class, 'theme_id');
	}

    public function getDescriptionAttribute()
    {
        return strip_tags($this->content['intro']);
    }

	public function getCoverImageAttribute()
    {
        return $this->content['intro_image'];
    }

    public function getCoverImageUrlAttribute()
    {
        return cloudinary_url($this->coverImage, ['cloud_name' => config('upsite.cloudinary.name')]);
    }
}
