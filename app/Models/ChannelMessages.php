<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChannelMessages extends Model
{
    use HasFactory;

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

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
