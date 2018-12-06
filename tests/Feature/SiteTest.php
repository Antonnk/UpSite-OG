<?php

namespace Tests\Feature;

use App\Mail\SiteClaimed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SiteTest extends TestCase
{
	use RefreshDatabase;

    /**
     * Test a guest can save a site to the database
     *
     * @return void
     */
    public function test_a_guest_can_create_a_site()
    {
    	$theme = factory(\App\Theme::class)->create(['slug' => 'barber']);

		$response = $this->json('POST', '/sites', [
			'name' => 'The Cake Shop',
			'theme' => $theme->slug,
			'content' => [
				'intro_text' => 'Hello and welcome'
			],
			'openhours' => []
		]);


		$this->assertDatabaseHas('sites', [
	        'name' => 'The Cake Shop'
	    ]);

		$response->assertStatus(201)
				->assertJsonStructure(['slug']);
    }

    /**
     * Test site can be viewed at {slug}.domain.tld  
     *
     * @return void
     */
    public function test_a_site_can_be_viewed()
    {
    	$theme = factory(\App\Theme::class)->create(['slug' => 'barber']);
		$site = factory(\App\Site::class)->create(['theme_id' => $theme->id]);

		$response = $this->get($site->url());

		
		$response->assertStatus(200)->assertSee($site->name);
    }

    /**
     * Test a ownerless site can be asigned a logged in user
     *
     * @return void
     */
    public function test_a_site_ownerless_site_can_be_claimed_a_user()
    {
		Mail::fake();

		$site = factory(\App\Site::class)->create(['user_id' => null]);
		$user = factory(\App\User::class)->create();

		$response = $this->actingAs($user)->json('PUT','/sites/'.$site->slug.'/claim');

		Mail::assertSent(SiteClaimed::class, function ($mail) use ($site) {
            return $mail->site->id === $site->id;
        });

		$site = \App\Site::where('slug', $site->slug)->first();

		$this->assertTrue($site->owner->id == $user->id);
		$response->assertSuccessful();
    }

    /**
     * Test a owned site cant be asigned a logged in user
     *
     * @return void
     */
    public function test_a_site_owned_site_cant_be_claimed_a_user()
    {
		$site = factory(\App\Site::class)->create();
		$user = factory(\App\User::class)->create();

		$response = $this->actingAs($user)->json('PUT','/sites/'.$site->slug.'/claim');

		$site = \App\Site::where('slug', $site->slug)->first();
		$this->assertFalse($site->owner->id == $user->id);
		$response->assertStatus(403);
    }

    /**
     * Test a site can be assigned open-hours
     *
     * @return void
     */
    public function test_a_site_can_have_open_hours()
    {
    	$theme = factory(\App\Theme::class)->create(['slug' => 'barber']);
		$site = factory(\App\Site::class)->make(['user_id' => null]);
		$openhours = [
			'weekdays' => [
				['name' => 'monday', 'open' => '09:00', 'close' => '18:00']
			],
		];
	
		$response = $this->json('POST','/sites', [
			'name' => $site->name,
			'theme' => $theme->slug,
			'content' => $site->content,
			'openhours' => $openhours
		]);

		$site = \App\Site::where('name', $site->name)->first();

		$this->assertTrue($site->openhours == $openhours);

		$response->assertSuccessful();
    }

    /**
     * Test a site can be assigned open-hours
     *
     * @return void
     */
    public function test_a_site_is_served_from_cache()
    {
    	$theme = factory(\App\Theme::class)->create(['slug' => 'barber']);
		$site = factory(\App\Site::class)->create(['theme_id' => $theme->id]);

		// visit once to trigger cache
		$this->get('http://'.$site->slug.'.'.env('APP_DOMAIN'));

		$response = $this->get('http://'.$site->slug.'.'.env('APP_DOMAIN'));

		$response->assertHeader('laravel-responsecache');
    }

    /**
     * Test site a owned site can be updated by owner
     *
     * @return void
     */
    public function test_a_owned_site_can_updated_by_owner()
    {
    	$theme = factory(\App\Theme::class)->create(['slug' => 'barber']);
		$site = factory(\App\Site::class)->create(['theme_id' => $theme->id]);

		// visit once to trigger cache
		$beforeUpdate = $this->get('http://'.$site->slug.'.'.env('APP_DOMAIN'));

		$response = $this->actingAs($site->owner)->json('PUT', '/sites/'.$site->slug, [
			'name' => 'New Name',
			'content' => $site->content,
			'openhours' => $site->openhours
		]);

		// assert site was updated
		$this->assertDatabaseHas('sites', [
			'slug' => $site->slug,
			'name' => 'New Name'
		]);
		$response->assertStatus(200);

		//assert cache is refreshed
		$afterUpDate = $this->get('http://'.$site->slug.'.'.env('APP_DOMAIN'));
		$afterUpDate->assertSee('New Name');
    }

    /**
     * Test site with no owner cant be deleted be non admins
     *
     * @return void
     */
    public function test_a_site_with_no_owner_cant_be_deleted_by_non_admins()
    {
		$site = factory(\App\Site::class)->create(['user_id' => null]);

		$response = $this->json('DELETE', '/sites/'.$site->slug);

		$this->assertDatabaseHas('sites', [
			'slug' => $site->slug
		]);

		$response->assertStatus(403);
    }

    public function test_a_site_with_a_owner_can_only_be_deleted_by_the_owner()
    {
		$site = factory(\App\Site::class)->create();
		
		$response = $this->actingAs($site->owner)->json('DELETE', '/sites/'.$site->slug);

		$this->assertDatabaseMissing('sites', [
			'slug' => $site->slug
		]);

		$response->assertStatus(200);
    }

    public function test_a_site_cant_be_deleted_by_a_user_who_doesnt_own_the_site()
    {
		$site = factory(\App\Site::class)->create();
		$user = factory(\App\User::class)->create();
		
		$response = $this->actingAs($user)->json('DELETE', '/sites/'.$site->slug);

		$this->assertDatabaseHas('sites', [
			'slug' => $site->slug
		]);

		$response->assertStatus(403);
    }


}
