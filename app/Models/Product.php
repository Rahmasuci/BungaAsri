<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function imgProduct(){
        return $this->hasMany('App\Models\ImgProduct', 'product_id');
    }
    
    public function orderDetail(){
        return $this->hasMany('App\Models\Product', 'product_id');
    }
}
