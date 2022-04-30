<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelMessages extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'from_user_id');
    }

    public function channel()
    {
        return $this->hasOne(Channels::class);
    }
}
