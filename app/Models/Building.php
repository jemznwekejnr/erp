<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;


    protected $fillable = [
        'description',
        'training_type',
        'duration',
        'training_mode',
        'training_date',
        'trainees',
        'treat_comment',
        'status',
        'treated_by',

    ];


    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
}
