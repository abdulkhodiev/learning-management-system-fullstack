<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fields',
        'experience',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function courses()
    {
        return $this->hasMany(Course::class);
    }

}
