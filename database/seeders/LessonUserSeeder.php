<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;

class LessonUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = User::take(5)->get();
        $achievements= Lesson::take(5)->get()->pluck("id")->toArray();
        $watchedLessons = array_fill_keys($achievements, ['watched' => true]);
        foreach ($users as $user){
            $user->lessons()->sync($watchedLessons);
        }
    }
}
