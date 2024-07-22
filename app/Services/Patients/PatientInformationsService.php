<?php

namespace App\Services\Patients;

use App\Models\Patients\PatientInformation;
use App\Repositories\Patients\PatientInformationsRepository;

class PatientInformationsService extends PatientInformationsRepository
{
    public function __construct(PatientInformation $model)
    {
        parent::__construct($model, ['user'], ['user']);
    }
}
