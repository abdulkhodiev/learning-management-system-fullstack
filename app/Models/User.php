<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'role',
        'image',
        'language',
        'description',
        'youtube',
        'x',
        'website',
        'linkedin',
    ];

    public function mentor()
    {
        return $this->hasOne(Mentor::class);
    }

    public function course(){
        return $this->hasMany(Course::class);
    }

    public function completedLessons(){
        return $this->hasMany(CompletedLessons::class);
    }

    public function savedCourses(){
        return $this->hasMany(SavedCourses::class);
    }

    public function courseStudent(){
        return $this->hasMany(CourseStudent::class);
    }


    public function courseReview(){
        return $this->hasMany(CourseReview::class);
    }

    public function chat(){
        return $this->hasMany(Chat::class);
    }

    public function roleUser(){
        return $this->hasOne(RoleUser::class);
    }



}
