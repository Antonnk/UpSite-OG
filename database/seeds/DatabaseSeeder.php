<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ThemeTableSeeder::class);

        factory(App\User::class)->create([
	        'name' => 'Test Bruger',
	        'email' => 'test@upsite.dk',
	        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
	    ]);
    }
}
