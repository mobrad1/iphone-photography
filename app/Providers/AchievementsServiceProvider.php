<?php

namespace App\Providers;

use App\Achievements\CommentsWritten;
use App\Achievements\LessonsWatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AchievementsServiceProvider extends ServiceProvider
{
    protected $achievements = [
        LessonsWatched\FirstLessonWatched::class,
        CommentsWritten\FirstCommentWritten::class
    ];
    public function register()
    {
        //
         $this->app->singleton('achievements',function(){
            return collect($this->achievements)->map(function ($achievement){
               return new $achievement;
            });
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(\App\Events\LessonWatched::class,\App\Listeners\UnlockLessonWatchedAchievements::class);
        Event::listen(\App\Events\CommentWritten::class,\App\Listeners\UnlockCommentWrittenAchievements::class);
    }
}
