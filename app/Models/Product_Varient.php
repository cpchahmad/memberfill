<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Varient extends Model
{
    use HasFactory;
    protected $table= 'product_varients';
    protected $fillable = [
        'shopify_variant_id',
        'title',
        'option1',
        'option2',
        'option3',
        'sku',
        'requires_shipping',
        'fulfillment_service',
        'taxable',
        'image',
        'price',
        'compare_at_price',
        'weight',
        'weight_unit',
        'grams',
        'inventory_item_id',
        'inventory_quantity',
        'inventory_management',
        'inventory_policy',
        'barcode',
        'shopify_product_id',
        'product_id',
        'shop_id',
    ];
    public function varient_images(){
        return $this->hasOne(Product_Image::class,'images','image');
    }

}
