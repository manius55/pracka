<?php

namespace Tests\Feature;

use App\Models\Invitations;
use App\Models\User;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_send_invitation()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $response = $this->actingAs($user)->post('/invitations/' . $user2->name);
        $response->assertStatus(201);
    }

    public function test_get_invitations()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/invitations');
        $response->assertStatus(200);
    }

    public function test_get_my_invitations()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/invitations');
        $response->assertStatus(200);
    }

    public function test_delete()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $invitation = Invitations::create([
            'from_user' =>$user2->id,
            'to_user' => $user->id,
            'accepted' => false,
        ]);

        $response = $this->actingAs($user)->delete('/invitations/' . $user2->id);
        $response->assertStatus(204);
    }

    public function test_delete_my_invitations()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $invitation = Invitations::create([
            'from_user' =>$user->id,
            'to_user' => $user2->id,
            'accepted' => false,
        ]);

        $response = $this->actingAs($user)->delete('/myInvitations/' . $user2->id);
        $response->assertStatus(204);
    }

    public function test_update()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $invitation = Invitations::create([
            'from_user' =>$user2->id,
            'to_user' => $user->id,
            'accepted' => false,
        ]);

        $response = $this->actingAs($user)->put('/invitations/' . $user2->id);
        $response->assertStatus(200);
    }
}
