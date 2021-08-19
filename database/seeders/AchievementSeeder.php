<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $achievements = [
          "First Lesson Watched",
          "Five Lessons Watched",
          "Ten Lessons Watched",
          "Twenty Lessons Watched"
        ];
        foreach ($achievements as $achievement){
            Achievement::factory()->create(["name" => $achievement]);
        }
    }
}
