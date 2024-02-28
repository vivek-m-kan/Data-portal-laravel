<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Roles extends Model
{
    use HasFactory;

    protected $primaryKey = "uuid";

    public $incrementing = false;

    protected $fillable = [
        'uuid',
        'role',
    ];

    public function getRoleNameAttribute() : string {
        return Str::ucfirst($this->role);
    }

    public function users() : HasMany {
        return $this->hasMany(User::class, "role_id", 'uuid');
    }
}
