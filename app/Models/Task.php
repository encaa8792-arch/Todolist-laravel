<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task', 'category', 'deadline', 'is_done'];

    protected $casts = [
        'is_done' => 'boolean',
    ];

}