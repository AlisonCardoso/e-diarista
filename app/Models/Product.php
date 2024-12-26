<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'sub_category_id',
        'price',
        'stock'
    ];
    public function subcategory()
      {
        return $this->belongsTo(Subcategory::class);
    }
    public function ProductOrders()
    {
        return $this->hasMany(ProductOrder::class);
    }

    public function budgets()
{
    return $this->belongsToMany(Budget::class)
                ->withPivot('product_quantity', 'product_price', 'total_product_value')
                ->withTimestamps();
}
    public function serviceOrders()
    {
        return $this->belongsToMany(ServiceOrder::class, 'service_order_product')
            ->withPivot('product_quantity', 'product_price')
            ->withTimestamps();
    }

}
