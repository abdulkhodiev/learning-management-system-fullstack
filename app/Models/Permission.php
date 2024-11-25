<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';


    protected $fillable = [
        'name',
    ];

    public function permissionRole(){
        return $this->hasMany(PermissionRole::class);
    }
}
