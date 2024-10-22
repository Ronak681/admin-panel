<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseNewItem extends Model
{
    protected $table = 'purchase_order_items';
    use HasFactory;
     public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'order_id','id')->where('is_deleted',0);
    }
  
}



