<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Spatie\QueryBuilder\QueryBuilder;
use App\Repositories\BaseRepositoryInterface;
use App\Observers\BaseModelObserver;

class BaseRepository implements BaseRepositoryInterface
{
    private $eloquentModel;
    private $cacheTTL = 60;

    public function __construct(
        private readonly Model $model,
        private string $cacheKey,
        private readonly array $relationships,
        private readonly array $showRelationshipsInList,
        private readonly array $searchFilters = [],
        private readonly array $sortFilters = [],

    )
    {
        $this->eloquentModel = $this->model->query();
        $this->model::observe(function() {
            return new BaseModelObserver($this->cacheKey);
        });
    }

    public function getListUsingQueryBuilder()
    {
        $result = QueryBuilder::for($this->eloquentModel)
                ->allowedFilters($this->searchFilters)
                ->defaultSort('-id')
                ->allowedSorts($this->sortFilters)
                ->allowedIncludes($this->relationships)
                ->get();

        return $result;
    }

    public function getPaginated($page = 1, $pageSize = 25, $orderBy = 'created_at', $sortBy = 'asc')
    {
        $result = $this->eloquentModel->with($this->showRelationshipsInList)->orderBy($orderBy, $sortBy)->paginate($pageSize);

        return Cache::remember($this->cacheKey, $this->cacheTTL, function () use ($result) {
                return $result;
            }
        );
    }

    public function getUnpaginated($orderBy = 'id', $sortBy = 'desc')
    {
        $result = $this->eloquentModel->with($this->showRelationshipsInList)->orderBy($orderBy, $sortBy)->get();

        return Cache::remember($this->cacheKey, $this->cacheTTL, function () use ($result) {
                return $result;
            }
        );
    }

    public function create($data)
    {
        DB::beginTransaction();

        try
        {
            $result = $this->model->create($data);

            DB::commit();

            return $result;
        } catch (\Exception $err)
        {
            DB::rollback();
            throw new HttpException(500, $err->getMessage());
        }
    }

    public function updateById($id, $data)
    {
        DB::beginTransaction();

        try
        {
            $result = tap($this->model->find($id))->update($data)->first();

            DB::commit();

            return $result;
        } catch (\Exception $err)
        {
            DB::rollback();
            throw new HttpException(500, $err->getMessage());
        }
    }

    public function getById($id)
    {
        $result = $this->model->with($this->relationships)->find($id);

        return $result;
    }

    public function deleteById($id)
    {
        DB::beginTransaction();

        try
        {
            $result = $this->model->findOrFail($id)->delete();

            DB::commit();

            return $result;
        } catch (\Exception $err)
        {
            DB::rollback();
            throw new HttpException(500, $err->getMessage());
        }
    }
}
