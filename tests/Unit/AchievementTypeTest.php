<?php

namespace Tests\Unit;

use App\Achievements\AchievementType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AchievementTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_default_name()
    {
        $type = new FakeAchievementType();


        $this->assertEquals('Fake Achievement Type',$type->name());
    }
}

class FakeAchievementType extends AchievementType
{
    public $description = "First Lesson Watched";

    public function qualifier($user)
    {
        return true;
    }
}
