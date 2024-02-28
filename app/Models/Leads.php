<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Leads extends Model
{
    use HasFactory;

    protected $primaryKey = "uuid";

    public $incrementing = false;

    protected $fillable = [
        'uuid',
        'details',
        'email',
        'status',
    ];

    protected $casts = [
        'details' => "JSON",
    ];

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Clients::class, "leads_clients", "leads_id", "clients_id", "uuid")->withTimestamps();
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaigns::class, "campaigns_id", "uuid");
    }

//    protected function details(): Attribute
//    {
//        return Attribute::make(
//            set: function(mixed $value, array $attributes) {
//                dd($attributes);
//                return json_encode($attributes['details']);
//        },
//            get: fn(mixed $value, array $attributes) => json_decode($attributes['details']),
//        );
//    }
}
