<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'status',
        'name',
        'coupon_code',
        'quantity',
        'uses_per_customer',
        'discount_amount',
        'start_time',
        'end_time',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }


}
