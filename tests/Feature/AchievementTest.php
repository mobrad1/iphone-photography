<?php

namespace Tests\Feature;


use App\Events\AchievementUnlocked;
use App\Events\LessonWatched;
use App\Models\Achievement;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class AchievementTest extends TestCase
{
    use RefreshDatabase;
    public function test_that_a_user_can_unlock_an_achievements()
    {

        $user = User::factory()->create();
        $achievement = Achievement::factory()->create();
        $achievement->unlock($user);


        $this->assertCount(1,$user->achievements);
        $this->assertTrue($user->achievements[0]->is($achievement));

    }
    public function test_an_achievement_badge_is_unlocked_once_a_user_watches_certain_amount_of_lesson()
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();
        $lesson->watch($user);

        LessonWatched::dispatch($lesson,$user);

        $this->assertCount(1,$user->achievements);
    }


}
