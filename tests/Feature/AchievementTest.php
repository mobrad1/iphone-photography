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
        $this->assertCount(1,$user->watched);
        Event::assertDispatched(AchievementUnlocked::class,function ($event) use ($user){
            return $user->is($event->user);
        });
    }
    public function test_an_achievement_is_unlocked_once_a_user_watches_twenty_five_lessons_and_announcement_is_made()
    {


        $user = User::factory()->create();
        $lessons = Lesson::factory(25)->create();

        $lessons->each(function ($lesson) use ($user){
            Event::fake(AchievementUnlocked::class);
            $lesson->watch($user);
            LessonWatched::dispatch($lesson,$user);

        });
        $this->assertCount(25,$user->fresh()->watched);

        Event::assertDispatched(AchievementUnlocked::class,function ($event) use ($user){
            return $user->is($event->user) && $event->achievement_name == "Twenty Five Lessons Watched";
        });
    }
    public function test_an_achievement_is_unlocked_once_a_user_watches_five_lessons_and_announcement_is_made()
    {


        $user = User::factory()->create();
        $lessons = Lesson::factory(5)->create();

        $lessons->each(function ($lesson) use ($user){
            Event::fake(AchievementUnlocked::class);
            $lesson->watch($user);
            LessonWatched::dispatch($lesson,$user);

        });
        $this->assertCount(5,$user->fresh()->watched);

        Event::assertDispatched(AchievementUnlocked::class,function ($event) use ($user){
            return $user->is($event->user) && $event->achievement_name == "Five Lessons Watched";
        });
    }
    public function test_an_achievement_is_unlocked_once_a_user_watches_ten_lessons_and_announcement_is_made()
    {


        $user = User::factory()->create();
        $lessons = Lesson::factory(10)->create();

        $lessons->each(function ($lesson) use ($user){
            Event::fake(AchievementUnlocked::class);
            $lesson->watch($user);
            LessonWatched::dispatch($lesson,$user);

        });
        $this->assertCount(10,$user->fresh()->watched);

        Event::assertDispatched(AchievementUnlocked::class,function ($event) use ($user){
            return $user->is($event->user) && $event->achievement_name == "Ten Lessons Watched";
        });
    }
    public function test_an_achievement_is_unlocked_once_a_user_watches_fifty_lessons_and_announcement_is_made()
    {


        $user = User::factory()->create();
        $lessons = Lesson::factory(50)->create();

        $lessons->each(function ($lesson) use ($user){
            Event::fake(AchievementUnlocked::class);
            $lesson->watch($user);
            LessonWatched::dispatch($lesson,$user);

        });
        $this->assertCount(50,$user->fresh()->watched);

        Event::assertDispatched(AchievementUnlocked::class,function ($event) use ($user){
            return $user->is($event->user) && $event->achievement_name == "Fifty Lessons Watched";
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
    public function test_an_achievement_is_unlocked_once_a_user_writes_three_comments_and_announcement_is_made()
    {

        $user = User::factory()->create();
        $comments = Comment::factory(3)->create(['user_id' => $user]);
        foreach ($comments as $comment){
          Event::fake(AchievementUnlocked::class);
          CommentWritten::dispatch($comment);
        }
        $this->assertCount(3,$user->comments);

        Event::assertDispatched(AchievementUnlocked::class,function ($event) use ($user){
            return $user->is($event->user) && $event->achievement_name == "Three Comments Written";
        });
    }
    public function test_an_achievement_is_unlocked_once_a_user_writes_five_comments_and_announcement_is_made()
    {

        $user = User::factory()->create();
        $comments = Comment::factory(5)->create(['user_id' => $user]);
        foreach ($comments as $comment){
          Event::fake(AchievementUnlocked::class);
          CommentWritten::dispatch($comment);
        }
        $this->assertCount(5,$user->comments);

        Event::assertDispatched(AchievementUnlocked::class,function ($event) use ($user){
            return $user->is($event->user) && $event->achievement_name == "Five Comments Written";
        });
    }
    public function test_an_achievement_is_unlocked_once_a_user_writes_ten_comments_and_announcement_is_made()
    {

        $user = User::factory()->create();
        $comments = Comment::factory(10)->create(['user_id' => $user]);
        foreach ($comments as $comment){
          Event::fake(AchievementUnlocked::class);
          CommentWritten::dispatch($comment);
        }
        $this->assertCount(10,$user->comments);

        Event::assertDispatched(AchievementUnlocked::class,function ($event) use ($user){
            return $user->is($event->user) && $event->achievement_name == "Ten Comments Written";
        });
    }
    public function test_an_achievement_is_unlocked_once_a_user_writes_twenty_comments_and_announcement_is_made()
    {

        $user = User::factory()->create();
        $comments = Comment::factory(20)->create(['user_id' => $user]);
        foreach ($comments as $comment){
          Event::fake(AchievementUnlocked::class);
          CommentWritten::dispatch($comment);
        }
        $this->assertCount(20,$user->comments);

        Event::assertDispatched(AchievementUnlocked::class,function ($event) use ($user){
            return $user->is($event->user) && $event->achievement_name == "Twenty Comments Written";
        });
    }
}
