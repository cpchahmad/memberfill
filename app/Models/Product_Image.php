<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Image extends Model
{
    use HasFactory;
    protected $table = 'product_images';
    protected $fillable = [
        'product_id',
        'images',
        'src'
    ];
    public function varient_images(){
        return $this->belongsTo(Product_Varient::class,'image','images');
    }
}
