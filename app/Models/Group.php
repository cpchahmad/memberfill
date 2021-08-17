<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'shop_id',

    ];
    public function group_details()
    {
        return $this->hasMany(Group_Varient::class);
    }
}
