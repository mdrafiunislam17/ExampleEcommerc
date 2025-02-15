<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'gallery_id',
        'sort',
        'path',
        'thumbs',
    ];

    // Define the relationship with the Gallery model
    public function gallery()
    {
        return $this->belongsTo(Gallery::class, 'gallery_id');
    }

}
