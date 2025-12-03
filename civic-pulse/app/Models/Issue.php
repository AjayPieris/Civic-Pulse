<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Issue extends Model
{
    use HasFactory;

    // ADD THIS LIST: These are the only columns allowed to be filled via ::create()
    protected $fillable = [
        'title',
        'description',
        'status',
    ];
}