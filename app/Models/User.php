<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles;

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



    public function courseReview(){
        return $this->hasMany(CourseReview::class);
    }





}
