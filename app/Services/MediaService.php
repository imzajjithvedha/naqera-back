<?php

namespace App\Services;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\HasMedia;

class MediaService
{
    /**
     * Upload media to a collection.
     */
    public function upload(
        Request $request,
        HasMedia $model,
        string $field,
        string $collection,
        bool $replace = false
    ): void {
        if (! $request->hasFile($field)) {
            return;
        }

        if ($replace) {
            $model->clearMediaCollection($collection);
        }

        $model->addMediaFromRequest($field)->toMediaCollection($collection);
    }
}