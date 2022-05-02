<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelMessages extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_id',
        'from_user_id',
        'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channels::class);
    }
}
