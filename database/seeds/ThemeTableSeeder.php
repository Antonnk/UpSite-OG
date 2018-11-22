<?php

use Illuminate\Database\Seeder;

class ThemeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$presets = config('themes.presets');

		foreach ($presets as $preset) {
			factory(App\Theme::class)->create($preset);
		}
    }
}
