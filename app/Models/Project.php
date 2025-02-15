<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'sector',
        'client',
        'start_date',
        'end_date',
        'image',
        'description',
    ];
}
