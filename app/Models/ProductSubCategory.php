<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'product_category_id',
        'name',
        'slug',
        'sort',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
