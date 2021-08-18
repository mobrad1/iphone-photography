<?php


namespace App\Badge;


use App\Models\Badge;

abstract class BadgeType
{
 protected $model;

    public function __construct()
    {
        $this->model = Badge::firstOrCreate([
            'title' => $this->title(),
            'achievement_points' => $this->achievement_points,

        ]);
    }

    public function modelKey()
    {
        return $this->model->getKey();
    }

    public function title()
    {
        if (property_exists($this,'name')){
            return $this->title;
        }
        return trim(preg_replace('/[A-Z]/',' $0',class_basename($this)));
    }
    abstract public function qualifier($user);
}
