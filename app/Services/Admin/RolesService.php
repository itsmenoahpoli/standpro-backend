<?php

namespace App\Services\Admin;

use App\Models\UserRole;
use App\Repositories\Admin\RolesRepository;

class RolesService extends RolesRepository
{
    public function __construct(UserRole $model)
    {
        parent::__construct($model, ['users'], []);
    }

    public function findByName($name)
    {
        return parent::findByName($name);
    }
}
