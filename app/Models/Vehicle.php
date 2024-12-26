<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, softDeletes;



    protected $fillable = [
        'situation_vehicle_id',
        'sub_command_id',
        'type_vehicle_id',
        'brand',
        'model',
        'prefix',
        'characterized',
        'asset_number',
        'odometer',
        'plate',
        'year',
        'image',
        'price'
    ];

    // Relacionamento com SubCommand (Muitos para Um)
    public function subCommand()
    {
        return $this->belongsTo(SubCommand::class);
    }

    // Relacionamento com TypeVehicle (Muitos para Um)
    public function typeVehicle()
    {
        return $this->belongsTo(TypeVehicle::class);
    }

    // Relacionamento com SituationVehicle (Muitos para Um)
    public function situationVehicle()
    {
        return $this->belongsTo(SituationVehicle::class);
    }

    // Relacionamento com Budget (Um Veículo pode ter vários Orçamentos)
    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    // Relacionamento com ServiceOrder (Um Veículo pode ter várias Ordens de Serviço)
    public function serviceOrders()
    {
        return $this->hasMany(ServiceOrder::class);
    }
    
}
