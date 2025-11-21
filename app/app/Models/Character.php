<?php

namespace App\Models;

use App\Models\Game;
use App\Models\Inventory;
use App\Models\Loadout;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use SoftDeletes;

    /**
     * The model's default values for attributes.
     *
     * @var list<string>
     */
    protected $attributes = [
        'health' => 100,
        'heat' => 100,
        'hydration' => 100,
        'satiation' => 100,
        'stamina' => 100,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'health',
        'heat',
        'hydration',
        'satiation',
        'stamina',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'game_id',
    ];

    /**
     * The game that this character belongs to
     *
     * @return BelongsTo<\App\Models\Game>
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * The character's inventory of all items.
     *
     * @return HasOne<\App\Models\Inventory>
     */
    public function inventory(): HasOne
    {
        return $this->hasOne(Inventory::class);
    }

    /**
     * The characters loadouts
     *
     * @return HasMany<\App\Models\Loadout>
     */
    public function loadouts(): HasMany
    {
        return $this->hasMany(Loadout::class);
    }
}
