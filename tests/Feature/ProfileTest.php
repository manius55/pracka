<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_profile()
    {
        $user = User::factory()->create();
        $profile = UserProfile::create([
            'user_id' => $user->id,
            'image' => 'default.png'
        ]);
        $response = $this->actingAs($user)->get('/profile/' . $user->id);
        $response->assertStatus(200);
    }

    public function test_edit_form()
    {
        $user = User::factory()->create();
        $profile = UserProfile::create([
            'user_id' => $user->id,
            'image' => 'default.png'
        ]);

        $response = $this->actingAs($user)->get('/profile/' . $user->id . '/edit/form');
        $response->assertStatus(200);
    }

    public function test_edit_profile()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $profile = UserProfile::create([
            'user_id' => $user->id,
            'image' => 'default.png'
        ]);

        $response = $this->actingAs($user)->put('/profile/' . $user->id . '/edit', [
            'description' => 'test',
            'date_of_birth' => '2000-12-02'
        ]);
        $response->assertStatus(302);
    }
}
