<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    use HasFactory;
    protected $table ='icons';
    protected $fillable = ['icon', 'category_id'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
