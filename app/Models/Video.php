<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'path'
    ];

    /**
     * The associated lesson that owns the Video
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function path(): HasOne
    {
        return $this->hasOne(Lesson::class);
    }


}
