<?php

namespace App\Repositories\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;

class RolesRepository extends BaseRepository
{
    public function __construct(
        private readonly Model $model,
        private readonly array $relationships = [],
        private readonly array $shownRelationshipsInList = []

    )
    {
        parent::__construct(
            $model,
            'model-user-role',
            $relationships,
            $shownRelationshipsInList,
            [],
            []
        );
    }

    public function findByName($name)
    {
        return $this->model->query()->where('name', $name)->first();
    }
}
