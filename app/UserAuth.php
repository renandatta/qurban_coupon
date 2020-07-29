<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAuth extends Model
{
    protected $fillable = [
        'user_id', 'auth', 'token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
