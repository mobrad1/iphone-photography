<?php

namespace App\Listeners;

use App\Events\CommentWritten;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UnlockCommentWrittenAchievements
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
     * @param  CommentWritten  $event
     * @return void
     */
    public function handle(CommentWritten $event)
    {

        $achievementIdsToUnlockForUsers = app('achievements')->filter(function($achievement) use ($event){
            //If user is qualified for the achievement dispatch the event achievementUnlocked
            if($achievement->qualifier($event->comment->user)){
                   \App\Events\AchievementUnlocked::dispatch($achievement->name(),$event->comment->user);
            }
            return $achievement->qualifier($event->comment->user);
        })->map(function ($achievement){
            return $achievement->modelKey();
        });
        $event->comment->user->achievements()->sync($achievementIdsToUnlockForUsers);
    }
}
