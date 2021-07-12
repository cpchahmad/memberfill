<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'shopify_product_id',
        'title',
        'description',
        'handle',
        'vendor',
        'type',
        'featured_image',
        'tags',
        'options',
        'images',
        'shop_id',
        'published_at',
        'status',
        'limit',

    ];
    public function Product_Varients(){
        return $this->hasMany(Product_Varient::class,'product_id','id');
    }

}
