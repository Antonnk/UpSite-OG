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
        	'name' => $company,
            'title' => $faker->sentence,
            'menu' => [
                ['name' => $faker->text(20), 'price' => $faker->randomNumber(2)],
                ['name' => $faker->text(50), 'price' => $faker->randomNumber(2)],
                ['name' => $faker->text(15), 'price' => $faker->randomNumber(2)],
            ], 
            'intro' => $faker->text(), 
            'intro_image'=> 'cafe/karl-fredrickson-35017-unsplash',
            'menu_image'=> 'cafe/nafinia-putra-59655-unsplash',
            'menu_title'=> $faker->word,
            'contact' => [
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->safeEmail
            ],
            'social' => [
                'instagram' => '@'.str_slug($company),
                'facebook' => '/'.str_slug($company),
                'twitter' => '@'.str_slug($company),
                'snapchat' => str_slug($company)
            ]
        ]
    ];
});
