<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'languages',
        'category_id',
        'mentor_id',
        'image',
    ];

    /**
     * Automatically cast the 'languages' field to and from JSON.
     */
    protected $casts = [
        'languages' => 'array',
    ];

    /**
     * Get the category that owns the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function students()
    {
        return $this->belongsToMany(User::class, 'purchases', 'course_id', 'user_id')
                    ->withPivot('price', 'purchased_at')
                    ->withTimestamps();
    }


    /**
     * Get the mentor that owns the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    /**
     * Get all the coupons for the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coupon()
    {
        return $this->hasMany(Coupon::class);
    }

    /**
     * Get all the chapters for the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chapters()
    {
        return $this->hasMany(CourseChapter::class);
    }

    /**
     * Get all the reviews for the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseReview()
    {
        return $this->hasMany(CourseReview::class);
    }
}
