<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'checkout_date',
        'accepted_payment_date',
        'shipment_date',
        'closed_date',
        'address'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function orderDetail(){
        return $this->hasOne('App\Models\OrderDetail', 'order_id');
    }
}
