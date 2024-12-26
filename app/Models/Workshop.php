<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workshop extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = [
        'cnpj',
        'razao_social',
        'descricao_situacao_cadastral',
        'cnae_fiscal_descricao',
        'phone_number',
        'email',
        'responsavel',
    ];

    public function address()
    {
        return $this->hasOne(Address::class);
    }
    public function user()
    {

        return $this->hasMany(User::class);
    }

    public function serviceOrders()
    {
        return $this->hasMany(ServiceOrder::class);
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

}
