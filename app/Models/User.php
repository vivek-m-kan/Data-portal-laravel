<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = "users";

    protected $primaryKey = "uuid";

    public $incrementing = false;

    public const NONE_MANAGABLE_ROLES = ['client', 'partner'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaigns::class, 'created_by', 'uuid');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Roles::class, "role_id", "uuid");
    }

    public function getFullNameAttribute(): string
    {
        return Str::ucfirst($this->first_name . " " . $this->last_name);
    }

    public function getIsAdminAttribute(): bool
    {
        return Auth::user()->role->roleName === 'Admin';
    }
}
