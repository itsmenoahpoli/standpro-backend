<?php

namespace App\Services\Patients;

use App\Models\Patients\PatientRecord;
use App\Repositories\Patients\PatientRecordsRepository;

class PatientRecordsService extends PatientRecordsRepository
{
    public function __construct(PatientRecord $model)
    {
        parent::__construct($model, ['user'], ['user']);
    }
}
