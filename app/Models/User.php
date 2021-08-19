<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'badge_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The comments that belong to the user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * The lessons that a user has access to.
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class);
    }

    /**
     * The lessons that a user has watched.
     */
    public function watched()
    {
        return $this->belongsToMany(Lesson::class)->wherePivot('watched', true);
    }

    /**
     * The achievements that a user has unlocked.
     */
    public function achievements()
    {
        return $this->belongsToMany(Achievement::class,'user_achievements')->withTimestamps();
    }

    /**
     * The badge that a user belongs to
     */
    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }
    /**
     * Get next available achievements
     */
    public function getNextAvailableAchievementsAttribute()
    {
        $myAchievements = $this->achievements()->pluck("id")->toArray();

        $allAchievements = Achievement::all()->pluck("id")->toArray();

        return Achievement::whereIn("id",array_values(array_diff($allAchievements,$myAchievements)))->pluck('name');
    }

     /**
     * Get next badge
     */

    public function getNextBadgeAttribute()
    {
        if(Badge::all()->count() > 0){
           $nextBadges = Badge::all()->sortBy("achievement_points")->filter(function ($value) {
            return $value->achievement_points > $this->badge->achievement_points ;
           });
           if($nextBadges->count() > 0){
                return $nextBadges->first()->title;
            }
        }
        return "No Next badge";
    }

     /**
     * Get remain badges to unlock
     */

    public function getRemainingToUnlockNextBadgeAttribute()
    {
        // First get all badges and sort them by achievement points
        $nextBadges = Badge::all()->sortBy("achievement_points")->filter(function ($value) {
            return $value->achievement_points > $this->badge->achievement_points ;
        });
        if($nextBadges->count() == 0){
            return 0;
        }
        return $nextBadges->first()->achievement_points - $this->badge->achievement_points;
    }

    /**
     * Get Current Badge
     */
    public function getCurrentBadgeAttribute()
    {
        return $this->badge->title;
    }
}
