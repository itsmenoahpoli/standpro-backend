<?php

namespace App\Models\Patients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientAppointment extends Model
{
    use HasFactory;

    public $guarded = [];

    public function user() : BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
