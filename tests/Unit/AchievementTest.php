<?php

namespace Tests\Unit;

use App\Models\Achievement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class AchievementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_has_a_name()
    {
        $achievement = Achievement::factory()->create(["name" => "5 Lesson Watched"]);
        $this->assertEquals("5 Lesson Watched",$achievement->name);
    }

    public function test_it_has_a_description()
    {
        $achievement = Achievement::factory()->create(["description" => "5 lessons has been watched"]);
        $this->assertEquals("5 lessons has been watched",$achievement->description);
    }
}
