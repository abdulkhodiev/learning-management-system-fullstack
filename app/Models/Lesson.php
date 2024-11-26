<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duration',
        'video_id',
        'course_chapter_id',
        'priority'
    ];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function courseChapter()
    {
        return $this->belongsTo(CourseChapter::class);
    }


}
