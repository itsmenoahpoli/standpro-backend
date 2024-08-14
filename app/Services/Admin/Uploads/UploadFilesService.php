<?php

namespace App\Services\Admin\Uploads;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Uploads\UploadFile;
use App\Repositories\Admin\Uploads\UploadFilesRepository;

class UploadFilesService extends UploadFilesRepository
{
    public function __construct(UploadFile $model)
    {
        parent::__construct($model, ['upload_folder'], ['upload_folder']);
    }

    public function create($payload)
    {
        return parent::create($payload);
    }
}
