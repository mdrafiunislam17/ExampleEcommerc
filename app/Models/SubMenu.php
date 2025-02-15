<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',  // Foreign key referencing the parent menu
        'name',
        'slug',
        'sort',
        'url',
        'content',
    ];

    // Relationship with the Menu model (One SubMenu belongs to one Menu)
    public function menu()
    {
        return $this->belongsTo(Menu::class); // Defining the inverse of the relationship
    }

    // Optionally, you can add a boot method to automatically generate the slug
//    protected static function boot()
//    {
//        parent::boot();
//
//        static::creating(function ($subMenu) {
//            if (!$subMenu->slug) {
//                // You can also use the Str helper or str() helper for generating the slug
//                $subMenu->slug = str($subMenu->name)->slug();
//            }
//        });
//    }
}
