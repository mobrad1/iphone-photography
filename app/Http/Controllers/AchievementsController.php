<?php

namespace App\Http\Controllers;

use App\Events\AchievementUnlocked;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function index(User $user)
    {
        $achievements = Achievement::all();
        // I need to call the achievements for the user so my Listener for badges can be called
        foreach ($achievements as $achievement){
            AchievementUnlocked::dispatch($achievement->name,$user);
        }

        return response()->json([
            'unlocked_achievements' => $user->achievements->pluck("name"),
            'next_available_achievements' => $user->next_available_achievements,
            'current_badge' => $user->current_badge,
            'next_badge' => $user->next_badge,
            'remaing_to_unlock_next_badge' => $user->remaining_to_unlock_next_badge
        ]);
    }
}
