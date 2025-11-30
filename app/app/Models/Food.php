<?php

namespace App\Models;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use SoftDeletes;

    /**
     * The model's default values for attributes.
     *
     * @var list<string>
     */
    protected $attributes = [
        'condition' => 100,
        'energy' => 0,
        'hydration' => 0,
        'satiation' => 0,
        'stamina' => 0,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'condition',
        'energy',
        'hydration',
        'l10n_description',
        'l10n_name',
        'satiation',
        'stamina',
        'weight_grams',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'inventory_id',
    ];

    /**
     * The inventory that this food is inside of
     *
     * @return BelongsTo<\App\Models\Inventory>
     */
    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }
}
