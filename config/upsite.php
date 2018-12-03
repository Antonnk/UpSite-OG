<?php

return [
    'cloudinary' => [
        'name' => env('CLOUDINARY_NAME', ''),
        'api_key' => env('CLOUDINARY_API_KEY', ''),
        'api_secret' => env('CLOUDINARY_API_SECRET', ''),
    ],

    'weekdays' => [
    	'monday' => 'Mandag',
    	'tuesday' => 'Tirsdag',
    	'wednesday' => 'Onsdag',
		'thursday' => 'Torsdag',
		'friday' => 'Fredag',
		'saturday' => 'Lørdag',
		'sunday' => 'Søndag'
    ]
];
