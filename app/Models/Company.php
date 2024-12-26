<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'slug', 'pelotao','sub_command_id'];

    public function sub_command()
    {
        return $this->belongsTo(SubCommand::class);
    }
}
