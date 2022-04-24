<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class Friends extends Model
{
    use HasFactory;

    protected $primaryKey = ['user_id', 'friend_id'];

    protected $fillable = ['user_id', 'friend_id'];

    public $incrementing = false;
}
