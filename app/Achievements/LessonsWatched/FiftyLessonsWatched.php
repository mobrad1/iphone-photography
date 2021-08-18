<?php


namespace App\Achievements\LessonsWatched;


use App\Achievements\AchievementType;

class FiftyLessonsWatched extends AchievementType
{
    public $description = "You've watched your fifty lessons. Great job!";

    public function qualifier($user)
    {
        return $user->watched->count() == 50;
    }

}
