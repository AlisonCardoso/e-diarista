<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceOrder extends Model
{
    use HasFactory , softDeletes;

    protected $fillable = [

        'user_id',
        'vehicle_id',
        'workshop_id',
        'situation_id',
        'service_date',
        'labor_hourly_rate',
        'labor_hours',
       ' total_service_order',
       'labor_total',
        'order_total',
        'description'
    ];

    /**
     * Relacionamento com o veículo.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    
    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    public function situation()
    {
        return $this->belongsTo(Situation::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'service_order_product')
            ->withPivot('product_quantity', 'product_price')
            ->withTimestamps();
    }

    public function calculateLaborTotal()
    {
        return $this->labor_hourly_rate * $this->labor_hours;
    }

    
    public function calculateProductTotal()
    {
        return $this->products->sum(function ($product) {
            return $product->pivot->product_quantity * $product->pivot->product_price;
        });
    }

    
    public function calculateTotal()
    {
        return $this->calculateLaborTotal() + $this->calculateProductTotal();
    }
     public function user(){
        return $this->belongsTo(User::class);
     }


}
