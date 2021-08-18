<?php


namespace App\Achievements\LessonsWatched;


use App\Models\Achievement;

class FirstLessonWatched
{
    public $name = "First Lesson Watched";
    public $description = "You've watched your first lesson. Great job!";
    protected $model;

    public function __construct()
    {
        $this->model =Achievement::firstOrCreate([
            'name' => $this->name,
            'description' => $this->description
        ]);
    }

    public function qualifier($user)
    {
        return $user->watched->count() == 1;
    }

    public function modelKey()
    {
        return $this->model->getKey();
    }
}
