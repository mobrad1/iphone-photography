<?php

namespace Tests\Feature;

use App\Models\Lesson;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_that_a_user_can_watch_a_lesson()
    {
        $user = User::factory()->create();

        $lesson = Lesson::factory()->create();

        $lesson->watch($user);

        $this->assertCount(1,$user->watched);
        $this->assertTrue($user->watched[0]->is($lesson));
    }
}
