<?php

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchievementsController;

Route::get('/users/{user}/achievements', [AchievementsController::class, 'index']);
Event::listen(\App\Events\LessonWatched::class, function ($event){
    $achievementIdsToUnlockForUsers = app('achievements')->filter(function($achievement) use ($event){
        return $achievement->qualifier($event->user);
    })->map(function ($achievement){
        return $achievement->modelKey();
    });
    $event->user->achievements()->sync($achievementIdsToUnlockForUsers);
});
