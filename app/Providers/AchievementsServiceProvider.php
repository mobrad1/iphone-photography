<?php

namespace App\Providers;

use App\Achievements\LessonsWatched\FirstLessonWatched;
use Illuminate\Support\ServiceProvider;

class AchievementsServiceProvider extends ServiceProvider
{
    protected $achievements = [
        FirstLessonWatched::class
    ];
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->singleton('achievements',function(){
            return collect($this->achievements)->map(function ($achievement){
               return new $achievement;
            });
        });
    }
}
