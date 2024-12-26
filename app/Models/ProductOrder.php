<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $fillable = [

  'service_order_id',
        'product_id',
        'quantity',
        'product_price'];

    public function serviceOrder()
    {
        return $this->belongsTo(ServiceOrder::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
