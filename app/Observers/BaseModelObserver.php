<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class BaseModelObserver
{
    protected string $cacheKey;

    public function __construct(string $cacheKey)
    {
        $this->cacheKey = $cacheKey;
    }

    public function created($model)
    {
        Cache::forget($this->cacheKey);
    }

    public function updated($model)
    {
        Cache::forget($this->cacheKey);
    }

    public function deleted($model)
    {
        Cache::forget($this->cacheKey);
    }
}
