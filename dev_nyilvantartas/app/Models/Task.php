<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];
}

