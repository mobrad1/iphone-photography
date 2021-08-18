<?php

namespace Tests\Unit;

use App\Achievements\AchievementType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class AchievementTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_default_name()
    {
        $type = new FakeAchievementType();

        $this->assertEquals('First Lesson Watched',$type->name);
    }
}

class FakeAchievementType extends AchievementType{

}
