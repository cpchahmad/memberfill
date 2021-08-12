<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_line_Item extends Model
{
    use HasFactory;
    protected $table = 'order_line_items';
    protected $fillable = [
        'order_id',
        'shopify_order_id',
        'shopify_product_id',
        'sku',
        'title',
        'quantity',
        'price',
        'shopify_variant_id',
        'item_src',
        'store_created_at',

    ];
}
