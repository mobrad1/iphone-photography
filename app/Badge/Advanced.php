<?php


namespace App\Badge;


class Advanced extends BadgeType
{

    public $achievement_points = 8;
    public function qualifier($user)
    {

        return $user->achievements->count() == $this->achievement_points;
    }
}
