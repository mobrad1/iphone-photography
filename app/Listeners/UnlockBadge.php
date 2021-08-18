<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UnlockBadge
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
     * @param  object  $event
     * @return void
     */
    public function handle(AchievementUnlocked $event)
    {

        app('badges')->filter(function($badge) use ($event){
            //If user is qualified for the achievement dispatch the event achievementUnlocked
            if($badge->qualifier($event->user)){
                \App\Events\BadgeUnlocked::dispatch($badge->title(),$event->user->fresh());
            }
        });

    }
}
