<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockrequest extends Model
{
    use HasFactory;

    protected $table = 'stockrequests';
    protected $fillable = [
        'treat_comment',

        'status',
        'treated_by',
        'approval_date',
        'decline_date'
    ];
    // Relationship With User
    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
    public function treater()
    {
        return $this->belongsTo(User::class, 'treated_by');
    }

    // Relationship With User
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }

    // Relationship With User
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
