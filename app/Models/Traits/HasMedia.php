<?php

namespace App\Models\Traits;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait HasMedia
 *
 * Provides media relationship functionality for any model.
 * Use this trait to enable polymorphic media attachments.
 */
trait HasMedia
{
    /**
     * Get all media associated with this model.
     */
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    /**
     * Get media items from a specific collection.
     */
    public function getMedia(string $collectionName = 'default'): \Illuminate\Database\Eloquent\Collection
    {
        return $this->media()
            ->collection($collectionName)
            ->ordered()
            ->get();
    }

    /**
     * Get the first media item from a collection.
     */
    public function getFirstMedia(string $collectionName = 'default'): ?Media
    {
        return $this->media()
            ->collection($collectionName)
            ->ordered()
            ->first();
    }

    /**
     * Get the URL of the first media item from a collection.
     */
    public function getFirstMediaUrl(string $collectionName = 'default', string $default = ''): string
    {
        $media = $this->getFirstMedia($collectionName);

        return $media ? $media->url : $default;
    }

    /**
     * Check if the model has any media in the given collection.
     */
    public function hasMedia(string $collectionName = 'default'): bool
    {
        return $this->media()
            ->collection($collectionName)
            ->exists();
    }

    /**
     * Get the avatar image URL (shortcut for avatar collection).
     */
    public function getAvatarUrl(string $default = ''): string
    {
        return $this->getFirstMediaUrl(Media::COLLECTION_AVATAR, $default);
    }

    /**
     * Get the hero image URL (shortcut for hero collection).
     */
    public function getHeroUrl(string $default = ''): string
    {
        return $this->getFirstMediaUrl(Media::COLLECTION_HERO, $default);
    }

    /**
     * Get all gallery images (shortcut for gallery collection).
     */
    public function getGallery(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->getMedia(Media::COLLECTION_GALLERY);
    }

    /**
     * Clear all media from a specific collection.
     */
    public function clearMediaCollection(string $collectionName = 'default'): void
    {
        $this->media()
            ->collection($collectionName)
            ->delete();
    }
}
