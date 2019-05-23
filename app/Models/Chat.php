<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'chat',
        'room_id',
        'is_seen',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
