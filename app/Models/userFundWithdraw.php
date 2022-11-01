<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class userFundWithdraw extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'amount', 'method', 'account_number'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
