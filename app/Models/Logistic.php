<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistic extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'purpose',
        'amount',
        'requested_by',
        'sent_to',
        'start_date',
        'end_date',
        'status',
        'comment',
        'treated_by',
        'approval_date',
        'decline_date',
        'disbursed_date',
        'attachments',
        'retire_date',
        'retire_attachment'

    ];




    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
    public function treatedBy()
    {
        return $this->belongsTo(User::class, 'treated_by');
    }
    // Relationship With Tasks
    public function sentTo()
    {
        return $this->belongsTo(User::class, 'sent_to');
    }
}
