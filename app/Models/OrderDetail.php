<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_detail';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'total',
        'payment_code'
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function order(){
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function payment(){
        return $this->belongsTo('App\Models\Payment', 'payment_code');
    }

}
