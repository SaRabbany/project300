<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userWorkAnalysis extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'total_clicks', 'total_orders'];
}
