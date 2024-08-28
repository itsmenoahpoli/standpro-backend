<?php

namespace App\Services\Admin\Uploads;

use App\Models\Uploads\UploadFile;
use App\Repositories\Admin\Uploads\UploadFilesRepository;
use App\Services\Admin\Uploads\UploadFoldersService;

class UploadFilesService extends UploadFilesRepository
{
    public function __construct(
        UploadFile $model,
        private readonly UploadFoldersService $uploadFoldersService
    )
    {
        parent::__construct($model, ['upload_folder'], ['upload_folder']);
    }

    public function create($payload)
    {
        return $payload;

        // $folderPath = $this->uploadFoldersService->getById($payload['upload_folder_id']);

        // return $folderPath;

        // return parent::create($payload);
    }
}
