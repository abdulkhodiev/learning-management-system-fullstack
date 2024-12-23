<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'image',
        'chat_id',
        'is_read'
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }

}
