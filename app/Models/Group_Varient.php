<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_Varient extends Model
{
    use HasFactory;
    protected $table = 'group_varients';
    protected $fillable = [
        'group_id',
        'product_id',
        'varient_id',
    ];
    public function has_products()
    {
        return $this->hasOne(Product::class, 'id', 'id');
    }
}
