<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;
    protected $fillable = [
        'global_limit',
        'graph_interval',
        'shop_id',
        'enable_stats',
    ];
}
