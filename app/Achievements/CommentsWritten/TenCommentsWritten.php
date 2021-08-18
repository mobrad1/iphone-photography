<?php


namespace App\Achievements\CommentsWritten;


use App\Achievements\AchievementType;

class TenCommentsWritten extends AchievementType
{

    public $description = "You've written ten comments. Great job!";

    public function qualifier($user)
    {
        return $user->comments->count() == 10;
    }

}
