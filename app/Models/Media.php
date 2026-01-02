<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mediable_type',
        'mediable_id',
        'collection_name',
        'name',
        'file_name',
        'mime_type',
        'disk',
        'path',
        'size',
        'width',
        'height',
        'custom_properties',
        'order_column',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'custom_properties' => 'array',
        'size' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
        'order_column' => 'integer',
    ];

    /**
     * Common collection names used across the application.
     */
    public const COLLECTION_AVATAR = 'avatar';
    public const COLLECTION_HERO = 'hero';
    public const COLLECTION_GALLERY = 'gallery';
    public const COLLECTION_LOGO = 'logo';
    public const COLLECTION_FEATURED = 'featured';
    public const COLLECTION_DEFAULT = 'default';

    /**
     * Get the parent mediable model (User, Tratamiento, etc.).
     */
    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope to filter by collection name.
     */
    public function scopeCollection($query, string $collectionName)
    {
        return $query->where('collection_name', $collectionName);
    }

    /**
     * Scope to order by the order column.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_column');
    }

    /**
     * Get the full URL to the media file.
     */
    public function getUrlAttribute(): string
    {
        return Storage::disk($this->disk)->url($this->path);
    }

    /**
     * Get human-readable file size.
     */
    public function getHumanReadableSizeAttribute(): string
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Check if the media is an image.
     */
    public function isImage(): bool
    {
        return str_starts_with($this->mime_type, 'image/');
    }

    /**
     * Check if the media is a video.
     */
    public function isVideo(): bool
    {
        return str_starts_with($this->mime_type, 'video/');
    }

    /**
     * Get the file extension.
     */
    public function getExtensionAttribute(): string
    {
        return pathinfo($this->file_name, PATHINFO_EXTENSION);
    }
}
