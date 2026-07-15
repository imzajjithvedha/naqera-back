<?php

namespace App\Services;

use Illuminate\Support\Str;

class SlugService
{
    public function generateSlug(
        ?string $slug,
        string $value
    ): string {
        return Str::slug(
            $slug ?: $value
        );
    }
}