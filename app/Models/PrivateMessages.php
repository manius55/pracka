<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateMessages extends Model
{
    use HasFactory;

    public function message()
    {
        return $this->hasMany(Message::class);
    }

    public function fromUser()
    {
        return $this->hasMany(User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->hasMany(User::class, 'to_user_id');
    }
}
