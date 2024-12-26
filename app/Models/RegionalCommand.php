<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegionalCommand extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = ['name', 'slug'];
    public function sub_command()
    {
        return $this->hasMany(SubCommand::class);
    }
}
