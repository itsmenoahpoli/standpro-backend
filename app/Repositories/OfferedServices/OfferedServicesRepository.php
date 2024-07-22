<?php

namespace App\Repositories\OfferedServices;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;

class OfferedServicesRepository extends BaseRepository
{
    public function __construct(
        private readonly Model $model,
        private readonly array $relationships = [],
        private readonly array $shownRelationshipsInList = []

    )
    {
        parent::__construct(
            $model,
            'offered-service-model',
            $relationships,
            $shownRelationshipsInList,
            [],
            []
        );
    }
}
