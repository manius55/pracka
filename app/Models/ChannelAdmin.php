<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelAdmin extends Model
{
    use HasFactory;

    protected $primaryKey = ['channel_id', 'user_id'];

    protected $fillable = ['owner', 'user_id', 'channel_id'];

    public $incrementing = false;
}
