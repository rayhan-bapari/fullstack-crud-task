<?php

namespace App\Models;

use App\Enums\PriorityEnum;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'priority'
    ];
}
