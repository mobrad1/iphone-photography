<?php


namespace App\Achievements\LessonsWatched;


use App\Achievements\AchievementType;

class TwentyFiveLessonsWatched extends AchievementType
{

    public $description = "You've watched twenty five lessons. Great job!";

    public function qualifier($user)
    {
        return $user->watched->count() == 25;
    }

}
