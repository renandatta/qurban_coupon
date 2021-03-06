<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'period_id', 'no_coupon', 'name', 'claim_at', 'claim_media'
    ];

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
