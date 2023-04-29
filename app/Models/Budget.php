<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'description',
        'amount',
        'start_date',
        'end_date',
        'actual_amount',
        'requested_by',
        'sent_to',
        'comment',
        'treated_by',
        'decline_date',
        'approval_date',
        'status'

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

    // Relationship With User
    public function treatedBy()
    {
        return $this->belongsTo(User::class, 'treated_by');
    }
}
