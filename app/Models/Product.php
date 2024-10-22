<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;
    protected $table ='_product';
    
    protected $casts = [
        'image' => 'array',
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories')->where('is_deleted',0);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
}
