<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Support\Address;

class Clients extends Model
{
    use HasFactory;

    protected $primaryKey = "uuid";

    public $incrementing = false;

    protected $fillable = [
        'uuid',
        'name',
        'company_name',
        'street',
        "city",
        "state",
        "country",
        "postal_code",
        "contact_number",
        "is_verified",
        "verified_by",
        "status",
        "created_by",
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, "client_id", "uuid");
    }

    function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "created_by", "uuid");
    }

    public function scopeVerified(Builder $query): Builder
    {
        return $query->whereIsVerified(1);
    }

    public function scopeFilter($query, $request): Builder
    {
        if ($request->search) {
            $query->where("name", "like", "%$request->search%")->orWhere("company_name", "like", "%$request->search%");
        }
        if ($request->sortField && $request->sortOrder) {
            $query->orderBy($request->sortField, $request->sortOrder);
        }

        return $query;
    }

    protected function address(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => "$attributes[street], $attributes[city], $attributes[state], $attributes[country], $attributes[postal_code]",
        );
    }
}
