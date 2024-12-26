<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        //'workshop_id',
        'cep',
        'state',
        'city',
        'neighborhood',
        'street',
        'number',
        'complement',
    ];

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }
    public function oficina()
    {
        return $this->belongsTo(Oficina::class);
    }
}
