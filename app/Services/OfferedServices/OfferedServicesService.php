<?php

namespace App\Services\Patients;

use App\Models\OfferedServices\OfferedService;
use App\Repositories\OfferedServices\OfferedServicesRepository;

class OfferedServicesService extends OfferedServicesRepository
{
    public function __construct(OfferedService $model)
    {
        parent::__construct($model, [], []);
    }
}
