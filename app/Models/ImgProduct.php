<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgProduct extends Model
{
    use HasFactory;

    protected $table = 'images_product';

    protected $fillable = [
        'path_img',
        'product_id'
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
