<?php


namespace App\Achievements\CommentsWritten;


use App\Achievements\AchievementType;

class FirstCommentWritten extends AchievementType
{

    public $description = "You've written your first comment";

    public function qualifier($user)
    {
        return $user->comments->count() == 1;
    }
}
