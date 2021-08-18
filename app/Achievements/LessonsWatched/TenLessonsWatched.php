<?php


namespace App\Achievements\LessonsWatched;


use App\Achievements\AchievementType;

class TenLessonsWatched extends AchievementType
{

    public $description = "You've watched ten lessons. Great job!";

    public function qualifier($user)
    {
        return $user->watched->count() == 10;
    }

}
