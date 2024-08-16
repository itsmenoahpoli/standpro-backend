<?php

namespace App\Models\Archives;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArchiveFile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function archive_folder() : BelongsTo
    {
        return $this->belongsTo(\App\Models\Archives\ArchiveFileFolder::class);
    }
}
