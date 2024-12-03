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
        'category_id',
        'mentor_id',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public function coupon()
    {
        return $this->hasMany(related: Coupon::class);
    }

    public function chapters()
    {
        return $this->hasMany(CourseChapter::class);
    }

    public function courseReview(){
        return $this->hasMany(CourseReview::class);
    }
}
