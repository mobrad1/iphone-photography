<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function unlock(User $user)
    {
        $user->update(["badge_id" => $this->id]);
    }

}
