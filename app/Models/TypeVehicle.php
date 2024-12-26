<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeVehicle extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['type'];


    public function vehicle()
     {
         return $this->belongsTo(Vehicle::class);
     }

     // App\Models\TypeVehicle.php

public function service_orders()
{
    return $this->hasMany(ServiceOrder::class); // Um tipo de veículo pode ter muitos serviços
}

}
