<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(
    [
        'name',
        'slug',
        'status'
    ]
)]
class Category extends Model
{
    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }
    
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    


    // Relationships
        public function properties(): HasMany
        {
            return $this->hasMany(Property::class);
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
                ->when($filters['name'] ?? null,
                    fn($q, $value) =>
                        $q->where('name', 'like', "%{$value}%"))

                ->when($filters['status'] ?? null,
                    fn ($q, $value) =>
                        $q->where('status', $value));
        }
    // Scopes
}
