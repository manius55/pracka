<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserFriendsTest extends TestCase
{

    public function test_get_friends()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/friends/' . $user->id);
        $response->assertStatus(200);
    }

    public function test_create_friend()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $response = $this->actingAs($user)->post('/friends/' . $user2->id);
        $response->assertStatus(201);
    }

    public function test_delete_friend()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $response = $this->actingAs($user)->delete('/friends/' . $user2->id . '/delete');
        $response->assertStatus(204);
    }
}
