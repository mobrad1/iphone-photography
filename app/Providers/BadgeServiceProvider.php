<?php

namespace App\Providers;

use App\Badge;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class BadgeServiceProvider extends ServiceProvider
{
    protected $badges = [
        Badge\Beginner::class,
        Badge\Intermediate::class,
        Badge\Advanced::class,
        Badge\Master::class,
    ];
    public function register()
    {

        $this->app->singleton('badges',function(){
            return collect($this->badges)->map(function ($badges){
               return new $badges;
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

        Event::listen(\App\Events\AchievementUnlocked::class,\App\Listeners\UnlockBadge::class);
    }
}
