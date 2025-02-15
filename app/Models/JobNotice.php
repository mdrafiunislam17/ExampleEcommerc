<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobNotice extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'status',
        'slug'  // Add 'slug' to fillable
    ];



}
