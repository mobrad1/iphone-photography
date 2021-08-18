<?php


namespace App\Achievements\CommentsWritten;


use App\Achievements\AchievementType;

class TwentyCommentsWritten extends AchievementType
{

    public $description = "You've written twenty comments. Great job!";

    public function qualifier($user)
    {
        return $user->comments->count() == 20;
    }

}
