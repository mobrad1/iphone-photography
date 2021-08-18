<?php


namespace App\Achievements\CommentsWritten;


use App\Achievements\AchievementType;

class ThreeCommentsWritten extends AchievementType
{

    public $description = "You've written three comments. Great job!";

    public function qualifier($user)
    {
        return $user->comments->count() == 3;
    }

}
