<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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
		return $this;
	}

	public function getOpenhours()
	{
		return OpeningHours::create($this->openhours);
	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
