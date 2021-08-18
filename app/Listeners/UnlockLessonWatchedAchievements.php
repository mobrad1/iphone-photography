<?php

namespace App\Listeners;

use App\Events\LessonWatched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UnlockLessonWatchedAchievements
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LessonWatched  $event
     * @return void
     */
    public function handle(LessonWatched $event)
    {
        //
        $achievementIdsToUnlockForUsers = app('achievements')->filter(function($achievement) use ($event){
        //If user has qualified for the achievement dispatch the event achievementUnlocked
        if($achievement->qualifier($event->user)){
           \App\Events\AchievementUnlocked::dispatch($achievement->name,$event->user);
        }
            return $achievement->qualifier($event->user);
        })->map(function ($achievement){
            return $achievement->modelKey();
        });
        $event->user->achievements()->sync($achievementIdsToUnlockForUsers);
    }
}
