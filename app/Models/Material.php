<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'file_path',
        'file_name',
        'tipe_file',
        'uploaded_by',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function isVideo(): bool
    {
        return in_array($this->tipe_file, ['video/mp4', 'video/webm'], true);
    }

    public function isPdf(): bool
    {
        return $this->tipe_file === 'application/pdf';
    }
}
