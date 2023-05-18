<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stock_id',
        'cat_id',
        'qty_purchased',
        'unit_price',
        'total_amount',
        'supplier',
        'qty_in_stock'

    ];


    // Relationship With Tasks
    public function categories()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
}
