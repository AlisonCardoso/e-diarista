<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = ['category_id', 'name'];
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function  products()
    {
        return $this->hasMany(Product::class, 'sub_category_id');
    }
}
