<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'shopify_order_id',
        'order_number',
        'note',
        'shop_id',
        'date',
        'first_name',
        'last_name',
        'customer_phone',
        'fulfillment_status',
        'currency',
        'total_shipping' ,
        'total_discount',
        'sub_total',
        'total_price',
        'financial_status',

    ];
    public function line_items(){
        return $this->hasMany(Order_line_Item::class,'order_id','id');
    }
}
