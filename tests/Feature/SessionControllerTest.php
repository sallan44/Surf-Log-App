<?php

namespace Tests\Feature;

use App\Models\Board;
use App\Models\Spot;
use App\Models\SurfSession;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_a_surf_session(): void
    {
        $user = User::factory()->create();
        $spot = Spot::factory()->for($user)->create(['is_private' => false]);
        $board = Board::factory()->for($user)->create();

        $response = $this->actingAs($user)->post(route('sessions.store'), [
            'spot_id'      => $spot->id,
            'board_id'     => $board->id,
            'session_date' => now()->format('Y-m-d'),
            'rating'       => 4,
            'wave_count'   => 12,
            'notes'        => 'Clean lines, offshore wind all morning.',
        ]);

        $session = SurfSession::first();

        $response->assertRedirect(route('sessions.show', $session));
        $this->assertDatabaseHas('surf_sessions', [
            'user_id'  => $user->id,
            'spot_id'  => $spot->id,
            'board_id' => $board->id,
            'rating'   => 4,
        ]);
    }

    public function test_session_creation_fails_validation_with_invalid_rating(): void
    {
        $user = User::factory()->create();
        $spot = Spot::factory()->for($user)->create(['is_private' => false]);
        $board = Board::factory()->for($user)->create();

        $response = $this->actingAs($user)->post(route('sessions.store'), [
            'spot_id'      => $spot->id,
            'board_id'     => $board->id,
            'session_date' => now()->format('Y-m-d'),
            'rating'       => 0, // invalid - must be between 1 and 5
            'wave_count'   => 12,
            'notes'        => 'This should not save.',
        ]);

        $response->assertSessionHasErrors('rating');
        $this->assertDatabaseCount('surf_sessions', 0);
    }

    public function test_guest_is_redirected_to_login_when_accessing_the_create_form(): void
    {
        $response = $this->get(route('sessions.create'));

        $response->assertRedirect(route('login'));
    }

    public function test_guest_only_sees_sessions_logged_at_public_spots(): void
    {
        $owner = User::factory()->create();

        $publicSpot  = Spot::factory()->for($owner)->create(['is_private' => false]);
        $privateSpot = Spot::factory()->for($owner)->create(['is_private' => true]);
        $board       = Board::factory()->for($owner)->create();

        $publicSession = SurfSession::factory()->for($owner)->create([
            'spot_id'  => $publicSpot->id,
            'board_id' => $board->id,
        ]);

        $privateSession = SurfSession::factory()->for($owner)->create([
            'spot_id'  => $privateSpot->id,
            'board_id' => $board->id,
        ]);

        $response = $this->get(route('feed'));

        $response->assertOk();
        $response->assertViewHas('sessions', function ($sessions) use ($publicSession, $privateSession) {
            return $sessions->contains($publicSession) && ! $sessions->contains($privateSession);
        });
    }
}