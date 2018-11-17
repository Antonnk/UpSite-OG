<?php

use Faker\Generator as Faker;

$factory->define(App\Site::class, function (Faker $faker) {
    $name = $faker->company;
    return [
		'name' => $name,
		'slug' => str_slug($name),
		'content' => [
			'heading' => $faker->realText(50),
			'description' => $faker->realText(200)
		],
		'openhours' => [
			'monday' => ['09:00-12:00', '13:00-18:00'],
		    'tuesday' => ['09:00-12:00', '13:00-18:00'],
		    'wednesday' => ['09:00-12:00'],
		    'thursday' => ['09:00-12:00', '13:00-18:00'],
		    'friday' => ['09:00-12:00', '13:00-20:00'],
		    'saturday' => ['09:00-12:00', '13:00-16:00'],
		],
		'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
