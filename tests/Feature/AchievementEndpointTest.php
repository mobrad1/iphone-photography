<?php

namespace Tests\Feature;


use App\Models\Achievement;
use App\Models\Badge;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AchievementEndpointTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_the_endpoint_should_contain_unlocked_achievements()
    {
        $user = User::factory()->create();
        $achievements = Achievement::factory(8)->create()->pluck("id");
        $user->achievements()->sync($achievements);


        $response = $this->get("/users/{$user->id}/achievements");


        $response->assertJson(['unlocked_achievements' => $user->achievements->pluck("name")->toArray()]);


    }

    public function test_the_endpoint_should_contain_next_badge()
    {
        $user = User::factory()->create();
        $achievements = Achievement::factory(8)->create()->pluck("id");
        $user->achievements()->sync($achievements);


        $response = $this->get("/users/{$user->id}/achievements");


        $response->assertJson(['next_badge' => $user->next_badge]);

    }
    public function test_the_endpoint_should_contain_current_badge()
    {
        $user = User::factory()->create();
        $achievements = Achievement::factory(8)->create()->pluck("id");
        $user->achievements()->sync($achievements);


        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertJson(['current_badge' => $user->current_badge]);

    }
    public function test_the_endpoint_should_contain_remaining_to_unlock_next_badge()
    {
        $user = User::factory()->create();
        $achievements = Achievement::factory(8)->create()->pluck("id");
        $user->achievements()->sync($achievements);


        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertJson(['remaing_to_unlock_next_badge' => $user->remaining_to_unlock_next_badge]);

    }
    public function test_the_endpoint_should_contain_next_available_achievements()
    {
        $user = User::factory()->create();
        $achievements = Achievement::factory(8)->create()->pluck("id");
        $user->achievements()->sync($achievements);


        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertJson(['next_available_achievements' => $user->next_available_achievements->toArray()]);
    }
}
