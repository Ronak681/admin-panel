<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table ='categories';
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }
    // protected $casts = [
    //     'icon' => 'array',
    // ];
    public function icons()
    {
        return $this->hasMany(Icon::class);
    }

}
