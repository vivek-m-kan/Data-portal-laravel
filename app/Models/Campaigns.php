<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Campaigns extends Model
{
    use HasFactory;

    protected $primaryKey = "uuid";

    public $incrementing = false;

    protected $fillable = [
        'uuid',
        'name',
        'created_by',
        'status',
    ];


    protected $casts = [
        'status' => 'boolean',
        'created_at' => "datetime:Y-m-d H:i:s"
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', "uuid");
    }

    public function getStatusNameAttribute(): string
    {
        return $this->status ? 'Active' : "In-active";
    }

    public function scopeFilter($query, $request): Builder
    {
        if ($request->search) {
            $query->where("name", "like", "%$request->search%");
        }
        if ($request->sortField && $request->sortOrder) {
            $query->orderBy($request->sortField, $request->sortOrder);
        }

        return $query;
    }

    protected function addedOn(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['created_at'],
        );
    }
}
