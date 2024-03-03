<?php

namespace App\Models;

use App\Enums\LanguageEnum;
use App\Enums\VisibilityEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property-read User|null $user
 *
 * @property-read string $formatted_created_at
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $body
 * @property string $language
 * @property VisibilityEnum $visibility
 * @property string $uri
 * @property Carbon|null $expires_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Paste extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'language',
        'visibility',
        'uri',
        'expires_at'
    ];

    protected $casts = [
        'language' => LanguageEnum::class,
        'visibility' => VisibilityEnum::class,
        'expires_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $appends = [
        'formatted_created_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at
            ->setTimezone('Asia/Krasnoyarsk')
            ->format('d.m.Y H:i');
    }
}
