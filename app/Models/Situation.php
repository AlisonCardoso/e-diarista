<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Situation extends Model
{
    use HasFactory, softDeletes;
    
    protected $fillable = [
        'name',
        'description'
    ];
     // Relacionamento com Budget (Um para Muitos)
     public function budgets()
     {
         return $this->hasMany(Budget::class);
     }
    }
