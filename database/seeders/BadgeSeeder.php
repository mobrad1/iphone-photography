<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $badges = ["Beginner" => 0,"Intermediate" => 4,"Advanced" => 8,"Master" => 10];
        foreach ($badges as $key=>$value){
            Badge::factory()->create(["title" => $key,"achievement_points" => $value]);
        }
    }
}
