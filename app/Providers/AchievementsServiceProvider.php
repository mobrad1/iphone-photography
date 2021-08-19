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
        LessonsWatched\FiveLessonsWatched::class,
        LessonsWatched\TenLessonsWatched::class,
        LessonsWatched\TwentyFiveLessonsWatched::class,
        LessonsWatched\FiftyLessonsWatched::class,
        CommentsWritten\FirstCommentWritten::class,
        CommentsWritten\ThreeCommentsWritten::class,
        CommentsWritten\FiveCommentsWritten::Class,
        CommentsWritten\TenCommentsWritten::class,
        CommentsWritten\TwentyCommentsWritten::class
    ];
    public function register()
    {
        //
         $this->app->singleton('achievements',function(){
             return cache()->rememberForever("achievements",function (){
                 return collect($this->achievements)->map(function ($achievement){
                    return new $achievement;
                 });
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
