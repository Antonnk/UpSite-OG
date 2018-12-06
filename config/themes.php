<?php 

return [
	'presets' => [
		'cafe' => [
			'name' => 'Café',
			'slug' => 'cafe',
			'description' => 'Perfekt til den lokale hyggelige cafe.',
			'preset_content' => [
	        	'name' => "Dit firmanavn",
	            'title' => "Dit slogan eller en kort tagline.",
	            'menu' => [
	                ['name' => 'Dagens kage', 'price' => '20'],
	                ['name' => 'Kaffe og Kage', 'price' => '35'],
	                ['name' => 'Espresso', 'price' => '15'],
	            ], 
	            'intro_title' => "Hvem er i og hvad tilbyder i?",
	            'intro' => "En uddybende tekst om hvem i er og hvad i tilbyder.",
	            'intro_image'=> 'cafe/karl-fredrickson-35017-unsplash',
            	'menu_image'=> 'cafe/nafinia-putra-59655-unsplash',
	            'menu_title'=> "Vi serverer",
	            'contact' => [
	                'address' => [
	                    'street' => 'Vej navn 1',
	                    'city' => 'Roskilde',
	                    'postcode' => '4000'
	                ],
	                'phone' => '+45 12345678',
	                'email' => 'mail@dinemail.dk'
	            ],
	            'social' => [
	                'instagram' => 'instagramBrugernavn',
	                'facebook' => 'facebookLink',
	                'twitter' => 'twitterBrugernavn',
	                'snapchat' => 'SnapchatBrugernavn'
	            ]
	        ]
		],
		'barber' => [
			'name' => 'Barber',
			'slug' => 'barber',
			'description' => 'Stilrent design til den klassiske herre frisør',
			'preset_content' => [
	        	'name' => "Dit firmanavn",
	            'title' => "Dit slogan eller en kort tagline.",
	            'menu' => [
	                ['name' => 'Herreklip', 'price' => '200'],
	                ['name' => 'Skægkilp', 'price' => '150'],
	                ['name' => 'Klip og Vask', 'price' => '250'],
	            ], 
	            'intro_title' => "Hvem er i og hvad tilbyder i?",
	            'intro' => "En uddybende tekst om hvem i er og hvad i tilbyder.",
	            'intro_image'=> 'barber/alwin-kroon-787528-unsplash',
	            'menu_image'=> 'barber/fabio-alves-764007-unsplash_1',
	            'menu_title'=> "Vi tilbyder",
	            'contact' => [
	                'address' => [
	                    'street' => 'Vej navn 1',
	                    'city' => 'Roskilde',
	                    'postcode' => '4000'
	                ],
	                'phone' => '+45 12345678',
	                'email' => 'mail@dinemail.dk'
	            ],
	            'social' => [
	                'instagram' => 'instagramBrugernavn',
	                'facebook' => 'facebookLink',
	                'twitter' => 'twitterBrugernavn',
	                'snapchat' => 'SnapchatBrugernavn'
	            ]
	        ]
		],
	]
];