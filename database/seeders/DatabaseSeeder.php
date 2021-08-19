<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BadgeSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(AchievementSeeder::class);
        $this->call(UserAchievementSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(LessonUserSeeder::class);

    }
}
