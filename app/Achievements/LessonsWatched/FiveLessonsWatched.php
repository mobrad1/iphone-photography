<?php


namespace App\Achievements\LessonsWatched;


use App\Achievements\AchievementType;

class FiveLessonsWatched extends AchievementType
{

    public $description = "You've watched five lessons. Great job!";

    public function qualifier($user)
    {

        return $user->watched->count() == 5;
    }

}
