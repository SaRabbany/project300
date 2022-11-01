<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userHasChild extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'child_user_id', 'id');
    }
}
