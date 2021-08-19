<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserAchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::take(5)->get();
        $achievements= Achievement::all()->pluck("id");

        foreach ($users as $user){
            $user->achievements()->sync($achievements);
        }
    }
}
