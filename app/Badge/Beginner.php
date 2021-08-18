<?php


namespace App\Badge;


class Beginner extends BadgeType
{
    public $achievement_points = 0;


    public function qualifier($user)
    {

        return $user->achievements->count() == $this->achievement_points;
    }
}
