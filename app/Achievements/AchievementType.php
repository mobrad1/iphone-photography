<?php


namespace App\Achievements;


use App\Models\Achievement;

abstract class AchievementType
{
    protected $model;

    public function __construct()
    {
        $this->model = Achievement::firstOrCreate([
            'name' => $this->name,
            'description' => $this->description
        ]);
    }

    public function modelKey()
    {
        return $this->model->getKey();
    }

}
