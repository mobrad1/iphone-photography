<?php

namespace Tests\Feature;


use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Events\LessonWatched;
use App\Models\Achievement;
use App\Models\Badge;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class BadgeUnlockTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_user_can_unlock_a_badge_and_make_announcement()
    {
        //When a user reaches a certain amount of experience
        $badge = Badge::factory()->create();
        $user = User::factory()->create();

        $badge->unlock($user);

        $this->assertEquals($badge->id, $user->badge->id);
        //unlock a badge
    }

    public function test_a_beginner_badge_is_unlocked_when_achievement_is_zero_and_annoucement_is_made()
    {
        Event::fake(BadgeUnlocked::class);

        $user = User::factory()->create();

        //Dispatching badge unlocked because beginners have no achievements
        BadgeUnlocked::dispatch("Beginner",$user);

        $this->assertCount(0,$user->achievements);

        Event::assertDispatched(BadgeUnlocked::class,function ($event) use ($user){

            return $event->badge_name == "Beginner";
        });

    }
    public function test_an_intermediate_badge_is_unlocked_when_achievement_is_four_and_annoucement_is_made()
    {


        $user = User::factory()->create();
        $achievements = Achievement::factory(4)->create()->pluck("id");
        $user->achievements()->sync($achievements);

        $this->assertCount(4,$user->achievements);
        $user->achievements->each(function ($achievement) use ($user){
            Event::fake(BadgeUnlocked::class);
            AchievementUnlocked::dispatch($achievement->name,$user);
        });
        $this->assertCount(4,$user->achievements);
        Event::assertDispatched(BadgeUnlocked::class,function ($event) use ($user){
            return $event->badge_name == "Intermediate";
        });

    }
    public function test_an_advanced_badge_is_unlocked_when_achievement_is_eight_and_annoucement_is_made()
    {

        $user = User::factory()->create();
        $achievements = Achievement::factory(8)->create()->pluck("id");
        $user->achievements()->sync($achievements);

        $this->assertCount(8,$user->achievements);
        $user->achievements->each(function ($achievement) use ($user){
            Event::fake(BadgeUnlocked::class);
            AchievementUnlocked::dispatch($achievement->name,$user);
        });
        Event::assertDispatched(BadgeUnlocked::class,function ($event) use ($user){
            return $event->badge_name == "Advanced";
        });

    }
    public function test_a_master_badge_is_unlocked_when_achievement_is_ten_and_annoucement_is_made()
    {

        $user = User::factory()->create();
        $achievements = Achievement::factory(10)->create()->pluck("id");
        $user->achievements()->sync($achievements);

        $this->assertCount(10,$user->achievements);
        $user->achievements->each(function ($achievement) use ($user){
            Event::fake(BadgeUnlocked::class);
            AchievementUnlocked::dispatch($achievement->name,$user);
        });
        Event::assertDispatched(BadgeUnlocked::class,function ($event) use ($user){
            return $event->badge_name == "Master";
        });

    }
}
