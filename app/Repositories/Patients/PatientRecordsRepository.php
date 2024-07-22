<?php

namespace App\Repositories\Patients;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;

class PatientRecordsRepository extends BaseRepository
{
    public function __construct(
        private readonly Model $model,
        private readonly array $relationships = [],
        private readonly array $shownRelationshipsInList = []

    )
    {
        parent::__construct(
            $model,
            'patient-record-model',
            $relationships,
            $shownRelationshipsInList,
            [],
            []
        );
    }
}
