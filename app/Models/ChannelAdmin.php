<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelAdmin extends Model
{
    use HasFactory;

    protected $fillable = ['owner', 'user_id', 'channel_id'];

    protected $primaryKey = ['channel_id', 'user_id'];

    public $incrementing = false;
}
