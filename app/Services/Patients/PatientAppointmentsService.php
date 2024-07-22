<?php

namespace App\Services\Patients;

use App\Models\Patients\PatientRecord;
use App\Repositories\Patients\PatientAppointmentsRepository;

class PatientAppointmentsService extends PatientAppointmentsRepository
{
    public function __construct(PatientRecord $model)
    {
        parent::__construct($model, ['user'], ['user']);
    }
}
