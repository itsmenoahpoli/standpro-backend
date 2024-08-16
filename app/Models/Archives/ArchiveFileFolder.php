<?php

namespace App\Models\Archives;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArchiveFileFolder extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function archive_files() : HasMany
    {
        return $this->hasMany(\App\Models\Archives\ArchiveFile::class);
    }
}
