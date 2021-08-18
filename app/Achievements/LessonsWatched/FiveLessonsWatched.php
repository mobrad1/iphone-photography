<?php


namespace App\Achievements\LessonsWatched;


use App\Achievements\AchievementType;

class FiveLessonsWatched extends AchievementType
{
    public $name = "First Lesson Watched";
    public $description = "You've watched your first lesson. Great job!";

    public function qualifier($user)
    {
        return $user->watched->count() == 1;
    }

}
