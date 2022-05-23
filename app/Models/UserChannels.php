<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class UserChannels extends Model
{
    use HasFactory;

    protected $primaryKey = ['channel_id', 'user_id'];

    protected $fillable = ['channel_id', 'user_id'];

    public $incrementing = false;
}
