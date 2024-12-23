<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function users()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'course_id', 'user_id')
        ->withPivot('id', 'status', 'commission', 'created_at')
        ->withTimestamps();
    }


    /**
     * Get the mentor that owns the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
    }

    /**
     * Get all the coupons for the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coupon(): HasMany
    {
        return $this->hasMany(Coupon::class);
    }

    /**
     * Get all the chapters for the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(CourseChapter::class, 'course_id');
    }

    /**
     * Get all the reviews for the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseReview(): HasMany
    {
        return $this->hasMany(CourseReview::class);
    }
}
