<?php


namespace App\Achievements\CommentsWritten;


use App\Achievements\AchievementType;

class FiveCommentsWritten extends AchievementType
{
    public $description = "You've written Five. Great job!";

    public function qualifier($user)
    {
        return $user->comments->count() == 5;
    }

}
