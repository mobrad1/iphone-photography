<?php

namespace App\Models;

use App\Events\LessonWatched;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    /**
     * A user can watch a lesson
     * @param User $user
     */
    public function watch(User $user)
    {
        $this->users()->attach($user,['watched' => true]);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
