<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Unlock badge for user
     * @param User $user
     * @return bool
     */
    public function unlock(User $user)
    {
        return $user->update(["badge_id" => $this->id]);
    }

}
