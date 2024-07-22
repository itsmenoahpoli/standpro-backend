<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity;

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logUnguarded();
    }

    public function user_role() : BelongsTo
    {
        return $this->belongsTo(\App\Models\UserRole::class);
    }

    public function user_otps() : HasMany
    {
        return $this->hasMany(\App\Models\UserOtp::class);
    }

    public function user_sessions() : HasMany
    {
        return $this->hasMany(\App\Models\UserSession::class);
    }

    public function patient_information() : HasOne
    {
        return $this->hasOne(\App\Models\Patients\PatientInformation::class);
    }
}
