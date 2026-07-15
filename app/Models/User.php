<?php

namespace App\Models;

use App\Enums\Status;
use App\Enums\UserRole;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'status'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, InteractsWithMedia;

    protected $with = ['media'];
    public const MEDIA_COLLECTION = 'backend/users';
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            'status' => Status::class,
        ];
    }

    // Relationships
        public function properties(): HasMany
        {
            return $this->hasMany(Property::class, 'user_id');
        }
    // Relationships


    // Scopes
        public function scopeStatus(Builder $query, Status $status): Builder
        {
            return $query->where('status', $status);
        }

        public function scopeRole(Builder $query, UserRole $role): Builder
        {
            return $query->where('role', $role);
        }

        public function scopeFilter($query, array $filters)
        {
            return $query
                ->when($filters['name'] ?? null,
                    fn ($q, $value) =>
                        $q->where('name', 'like', "%{$value}%"))

                ->when($filters['email'] ?? null,
                    fn ($q, $value) =>
                        $q->where('email', 'like', "%{$value}%"))

                ->when($filters['role'] ?? null,
                    fn ($q, $value) =>
                        $q->where('role', $value))

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
