<?php

namespace Tests\Feature;


use App\Events\AchievementUnlocked;
use App\Events\CommentWritten;
use App\Events\LessonWatched;
use App\Models\Achievement;
use App\Models\Comment;
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
    public function test_an_achievement_is_unlocked_once_a_user_watches_first_lesson_and_announcement_is_made()
    {
        Event::fake(AchievementUnlocked::class);
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();
        $lesson->watch($user);

        LessonWatched::dispatch($lesson,$user);

        $this->assertCount(1,$user->achievements);
        Event::assertDispatched(AchievementUnlocked::class,function ($event) use ($user){
            return $user->is($event->user);
        });
    }

    public function test_an_achievement_is_unlocked_once_a_user_writes_first_comment_and_announcement_is_made()
    {
        Event::fake(AchievementUnlocked::class);
        $user = User::factory()->create();
        $comment = Comment::factory()->create(['user_id' => $user]);

        CommentWritten::dispatch($comment);

        $this->assertCount(1,$user->comments);
        Event::assertDispatched(AchievementUnlocked::class,function ($event) use ($user){
            return $user->is($event->user);
        });
    }

}
