<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(
    [
        'user_id',
        'category_id',
        'name',
        'slug',
        'address',
        'city',
        'country',
        'price',
        'status'
    ]
)]
class Property extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $with = ['media'];
    public const MEDIA_COLLECTION = 'backend/properties';
    protected $appends = ['thumbnail'];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'status' => Status::class,
        ];
    }



    // Accessors
        protected function thumbnail(): Attribute
        {
            return Attribute::make(
                get: fn () => $this->hasMedia(self::MEDIA_COLLECTION)
                    ? $this->getFirstMediaUrl(self::MEDIA_COLLECTION, 'webp')
                    : asset('storage/global/no-image.webp')
            );
        }
    // Accessors



    // Relationships
        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }

        public function category(): BelongsTo
        {
            return $this->belongsTo(Category::class);
        }
    // Relationships



    // Scopes
        public function scopeStatus(Builder $query, Status $status): Builder
        {
            return $query->where('status', $status);
        }

        public function scopeFilter($query, array $filters)
        {
            return $query
               ->when($filters['user_id'] ?? null,
                    fn($q, $value) =>
                        $q->where('user_id', $value))

                ->when($filters['category_id'] ?? null,
                    fn($q, $value) =>
                        $q->where('category_id', $value))

                ->when($filters['name'] ?? null,
                    fn($q, $value) =>
                        $q->where('name', 'like', "%{$value}%"))

                ->when($filters['status'] ?? null,
                    fn ($q, $value) =>
                        $q->where('status', $value));
        }
    // Scopes



    // Media
        public function registerMediaConversions(?Media $media = null): void
        {
            $this->addMediaConversion('webp')
                ->format('webp')
                ->nonQueued();

            $this->addMediaConversion('thumb')
                ->format('webp')
                ->width(300)
                ->height(200)
                ->sharpen(10)
                ->nonQueued();
        }
    // Media
}
