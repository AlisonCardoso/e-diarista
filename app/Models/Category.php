<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Category extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = ['name'];
    public function subcategories()
{
return $this->hasMany(Subcategory::class, 'category_id');
}
}
