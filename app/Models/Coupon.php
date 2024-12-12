<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * The course that owns the coupon.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }


}
