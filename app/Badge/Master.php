<?php


namespace App\Badge;


class Master extends BadgeType
{
    public $achievement_points = 10;


    public function qualifier($user)
    {

        return $user->achievements->count() == $this->achievement_points;
    }
}
