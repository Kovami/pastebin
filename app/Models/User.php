<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * @property-read Session[]|EloquentCollection $sessions
 * @property-read Paste[]|EloquentCollection $pastes
 * @property-read Paste[]|EloquentCollection $last_pastes
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'login',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $with = ['lastPastes'];

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class, 'user_id', 'id');
    }

    public function pastes(): HasMany
    {
        return $this->hasMany(Paste::class, 'user_id', 'id');
    }

    public function lastPastes(): HasMany
    {
        return $this->pastes()
            ->limit(10);
    }
}
