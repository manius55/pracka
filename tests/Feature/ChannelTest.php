<?php

namespace Tests\Feature;

use App\Models\ChannelAdmin;
use App\Models\Channels;
use App\Models\User;
use App\Models\UserProfile;
use Faker\Core\File;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ChannelTest extends TestCase
{
    public function test_index()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/channel');

        $response->assertStatus(200);
    }

    public function test_create_channel_form()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/channel/createForm');
        $response->assertStatus(200);
    }

    public function test_get_channel()
    {
        $user = User::factory()->create();
        $channel = Channels::create(['channel_name' => 'test']);

        $response = $this->actingAs($user)->get('/channel/' . $channel->id);
        $response->assertViewHasAll(['admin', 'channels', 'user', 'id']);
        $response->assertStatus(200);
    }

    public function test_get_channel_users()
    {
        $user = User::factory()->create();
        $channel = Channels::create(['channel_name' => 'test']);

        $response = $this->actingAs($user)->get('channelUsers/' . $channel->id);
        $response->assertViewHasAll(['users', 'channels_users', 'id', 'friends', 'owner', 'channel_users_with_image']);
        $response->assertStatus(200);
    }

    public function test_new_mesasge()
    {
        $user = User::factory()->create();
        $channel = DB::table('channels')->get()->first();

        $response = $this->actingAs($user)->post('/messages', [
            'from_user_id' => $user->id,
            'channel_id' => $channel->id,
            'message' => 'testowa wiadomość'
        ]);

        $response->assertJson(fn(AssertableJson $json) => $json
            ->hasAll(['message', 'id', 'channel_id', 'updated_at', 'created_at', 'from_user_id'])
            ->whereType('id', 'integer')
            ->whereType('message', 'string')
            ->whereType('channel_id', 'integer')
            ->whereType('from_user_id', 'integer')
        );

        $response->assertStatus(201);
    }

    public function test_messages_with_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/messages');
        $response->assertStatus(200);
    }

    public function test_create_channel()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/channel/create', [
            'channel_name' => 'testowy kanał'
        ]);
        $response->assertStatus(201);
    }

    public function test_add_user()
    {
        $user = User::factory()->create();
        $channel = Channels::create(['channel_name' => 'test']);

        $response = $this->actingAs($user)->post('/channel/addUser/' . $channel->id . '/' . $user->id);
        $response->assertStatus(201);
    }

    public function test_delete_channel()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $channel = Channels::create(['channel_name' => 'test']);

        $response = $this->actingAs($user)->delete('/channel/' . $channel->id);
        $response->assertStatus(204);
    }
}
