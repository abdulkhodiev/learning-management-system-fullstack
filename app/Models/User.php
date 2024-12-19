<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    /**
     * Get all the courses that the user is enrolled in.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id')
            ->withPivot('id', 'status', 'commission', 'created_at')
            ->withTimestamps();
    }


    /**
     * Get the mentor for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mentor(): HasOne
    {
        return $this->hasOne(Mentor::class);
    }

    /**
     * Get all the courses created by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function course(): HasMany{
        return $this->hasMany(related: Course::class);
    }

    /**ßß
     * Get all the reviews for the courses created by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseReview(): HasMany{
        return $this->hasMany(CourseReview::class);
    }
}
