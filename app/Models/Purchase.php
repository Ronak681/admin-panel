<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchase_orders';
    use HasFactory;

    public function items()
    {
        return $this->hasMany(PurchaseNewItem::class, 'order_id','id')->where('is_deleted',0);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
