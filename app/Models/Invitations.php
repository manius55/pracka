<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitations extends Model
{
    use HasFactory;

    protected $primaryKey = ['from_user', 'to_user'];

    public $incrementing = false;

    protected $fillable = [
        'from_user',
        'to_user',
        'accepted'
    ];
}
