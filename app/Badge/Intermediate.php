<?php


namespace App\Badge;


class Intermediate extends BadgeType
{
    public $achievement_points = 4;
    public function qualifier($user)
    {

        return $user->achievements->count() == $this->achievement_points;
    }
}
