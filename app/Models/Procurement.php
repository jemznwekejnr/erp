<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    use HasFactory;


    protected $fillable = [
        'item',
        'quantity',
        'amount',
        'unit_price',
        'total_price',
        'requested_by',
        'sent_to',
        'date',
        'attachment'

    ];
    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
    // Relationship With User
    public function sentTo()
    {
        return $this->belongsTo(User::class, 'sent_to');
    }


    public function treatedBy()
    {
        return $this->belongsTo(User::class, 'treated_by');
    }
}
