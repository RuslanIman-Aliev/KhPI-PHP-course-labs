<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'payload' => 'array',
        'period_start' => 'date',
        'period_end' => 'date',
    ];
}