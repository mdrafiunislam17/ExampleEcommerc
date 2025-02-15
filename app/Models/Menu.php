<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sort',
        'slug',
        'url',
        'content',
    ];

    // Automatically generate the slug if not provided
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($menu) {
            if (!$menu->slug) {
                // Use the `str()` helper function instead of Str::slug
                $menu->slug = str($menu->name)->slug();
            }
        });
    }
}
