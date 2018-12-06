<?php

use Faker\Generator as Faker;

$factory->define(App\Site::class, function (Faker $faker) {
    $name = $faker->company;
    return [
		'name' => $name,
		'slug' => str_slug($name),
		'content' => [
			'name' => $faker->realText(50),
			'intro' => $faker->realText(200),
			'intro_image'=> 'cafe/karl-fredrickson-35017-unsplash',
			'contact' => [
                'address' => [
                    'street' => $faker->streetName.' '.$faker->buildingNumber,
                    'city' => $faker->city,
                    'postcode' => $faker->randomNumber(4)
                ],
                'phone' => $faker->randomNumber(8),
                'email' => 'mail@dinemail.dk'
            ],
            'social' => [
                'instagram' => 'instagramBrugernavn',
                'facebook' => 'facebookLink',
                'twitter' => 'twitterBrugernavn',
                'snapchat' => 'SnapchatBrugernavn'
            ]
		],
		'openhours' => [
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
		],
		'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'theme_id' => function () {
        	return factory(App\Theme::class)->create()->id;	
        }
    ];
});
