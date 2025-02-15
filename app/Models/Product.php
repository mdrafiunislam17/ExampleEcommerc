<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'brand_id',
        'description',
        'slug',
        'price', // এখানে price যোগ করুন
        'status',
    ];


    /**
     * Get the category associated with the product.
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    /**
     * Get the brand associated with the product.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /**
     * If the product has variations (optional parent-child relationship).
     */
    public function variations()
    {
        return $this->hasMany(Product::class, 'parent_id');
    }

    /**
     * Format the price to 2 decimal places.
     */
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2); // 10,000.00 এর মতো দেখাবে
    }
}
