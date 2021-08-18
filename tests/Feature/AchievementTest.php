<?php

namespace Tests\Feature;


use App\Models\Achievement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AchievementTest extends TestCase
{
    use RefreshDatabase;
    public function test_that_a_user_can_unlock_an_achievements()
    {
        // Given a user
        $user = User::factory()->create();

        // As well as a badge
        $achievement = Achievement::factory()->create();

        // Unlock achievement for a particular user
        $achievement->unlock($user);


        $this->assertCount(1,$user->achievements);
        $this->assertTrue($user->achievements[0]->is($achievement));

    }

}
