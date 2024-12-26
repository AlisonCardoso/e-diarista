<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = [
        'vehicle_id',
        'workshop_id',
        'situation_id',
        'service_date',
        'labor_hourly_rate',
        'labor_hours'
    ];


    // Relacionamento com Vehicle (1:N)
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Relacionamento com Workshop (1:N)
    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    // Relacionamento com Situation (1:N)
    public function situation()
    {
        return $this->belongsTo(Situation::class);
    }

    // Relacionamento com Products (M:N)
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('product_quantity', 'product_price', 'total_product_value')
            ->withTimestamps();
    }
    

    // Cálculo do total de valor do orçamento
    public function getTotalValueAttribute()
    {
        $totalProducts = $this->products->sum('pivot.total_product_value');
        $laborTotal = $this->labor_hourly_rate * $this->labor_hours;
        return $totalProducts + $laborTotal;
    }
}
