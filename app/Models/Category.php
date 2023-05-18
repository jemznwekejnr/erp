<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',

    ];

    // Relationship With Tasks
    public function stocks()
    {
        return $this->hasMany(Stock::class, 'cat_id');
    }
}
