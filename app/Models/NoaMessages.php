<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoaMessages extends Model
{
    use HasFactory;

    protected $fillable = ['from_id', 'to_id', 'body', 'attachment', 'seen'];
}