<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelMessages extends Model
{
    use HasFactory;

    public function message()
    {
        return $this->hasMany(Message::class);
    }

    public function user()
    {
        return $this->hasMany(User::class, 'from_user_id');
    }

    public function channel()
    {
        return $this->hasMany(Channels::class);
    }
}
