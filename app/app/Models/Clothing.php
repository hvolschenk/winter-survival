<?php

namespace App\Models;

use App\Enums\ClothingType;
use App\Models\Loadout;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clothing extends Model
{
    /** @use HasFactory<\Database\Factories\ClothingFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The model's default values for attributes.
     *
     * @var list<string>
     */
    protected $attributes = [
        'condition' => 100,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'armor',
        'condition',
        'l10n_name',
        'l10n_description',
        'type',
        'warmth_celcius',
        'wind_protection_celcius',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'loadout_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => ClothingType::class,
        ];
    }

    /**
     * The loadout that this clothing belongs to
     *
     * @return BelongsTo<\App\Models\Loadout>
     */
    public function loadout(): BelongsTo
    {
        return $this->belongsTo(Loadout::class);
    }
}
