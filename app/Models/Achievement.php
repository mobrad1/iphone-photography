<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    public function unlock(User $user)
    {
        $this->users()->attach($user);
    }
    public function users()
    {
        return $this->belongsToMany(User::class,"user_achievements");
    }
}
