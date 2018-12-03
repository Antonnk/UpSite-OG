<?php

use Faker\Generator as Faker;

$factory->define(App\Theme::class, function (Faker $faker) {
	$name = $faker->word();
	$company = $faker->company;
    return [
        'slug' => str_slug($name),
        'name' => $name,
        'description' => $faker->text(),
        'preset_content' => [
        	'name' => "Dit firmanavn",
            'title' => "Dit slogan eller en kort tagline.",
            'menu' => [
                ['name' => $faker->text(20), 'price' => $faker->randomNumber(2)],
                ['name' => $faker->text(50), 'price' => $faker->randomNumber(2)],
                ['name' => $faker->text(15), 'price' => $faker->randomNumber(2)],
            ], 
            'intro_title' => "Hvem er i og hvad tilbyder i?",
            'intro' => "En uddybende tekst om hvem i er og hvad i tilbyder.",
            'intro_image'=> 'cafe/karl-fredrickson-35017-unsplash',
            'menu_image'=> 'cafe/nafinia-putra-59655-unsplash',
            'menu_title'=> "Vi tilbyder",
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
                'instagram' => '@instagramBrugernavn',
                'facebook' => '/facebookLink',
                'twitter' => '@twitterBrugernavn',
                'snapchat' => 'SnapchatBrugernavn'
            ]
        ]
    ];
});
