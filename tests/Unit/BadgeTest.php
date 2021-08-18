<?php

namespace Tests\Unit;

use App\Models\Badge;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class BadgeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_has_a_title()
    {

        $badge = Badge::factory()->create(["title" => "Beginner"]);
        $this->assertEquals("Beginner",$badge->title);
    }

    public function test_it_has_achievement_points()
    {
        $badge = Badge::factory()->create(["achievement_points" => 20 ]);
        $this->assertEquals(20,$badge->achievement_points);
    }
}
