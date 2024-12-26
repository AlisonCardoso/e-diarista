<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetProduct extends Model
{
    protected $fillable = [
        'budget_id',
        'product_id',
        'product_quantity',
        'product_price',
        'total_product_value',
    ];

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
