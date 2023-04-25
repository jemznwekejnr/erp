<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profileid');
    }

    // Relationship With Tasks
    public function requestedBy()
    {
        return $this->hasMany(Procurement::class, 'requested_by');
    }
    // Relationship With Tasks
    public function sentTo()
    {
        return $this->hasMany(Procurement::class, 'sent_to');
    }

    // Relationship With Tasks
    public function logisticsRequestedBy()
    {
        return $this->hasMany(Logistic::class, 'requested_by');
    }
    // Relationship With Tasks
    public function logisticsSentTo()
    {
        return $this->hasMany(Logistic::class, 'sent_to');
    }
}
