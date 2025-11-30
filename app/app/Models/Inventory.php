<?php

namespace App\Models;

use App\Models\Character;
use App\Models\Clothing;
use App\Models\Food;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use SoftDeletes;

    /**
     * The model's default values for attributes.
     *
     * @var list<string>
     */
    protected $attributes = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'character_id',
    ];

    /**
     * The character that this inventory belongs to
     *
     * @return BelongsTo<\App\Models\Character>
     */
    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    /**
     * The clothing in the character's inventory
     *
     * @return HasMany<\App\Models\Clothing>
     */
    public function clothing(): HasMany
    {
        return $this->hasMany(Clothing::class);
    }

    /**
     * The food in the character's inventory
     *
     * @return HasMany<\App\Models\Food>
     */
    public function food(): HasMany
    {
        return $this->hasMany(Food::class);
    }

    /**
     * The fuel sources in the character's inventory
     *
     * @return HasMany<\App\Models\Fuel>
     */
    public function fuel(): HasMany
    {
        return $this->hasMany(Fuel::class);
    }

    /**
     * The igniters in the character's inventory
     *
     * @return HasMany<\App\Models\Igniter>
     */
    public function igniters(): HasMany
    {
        return $this->hasMany(Igniter::class);
    }

    /**
     * The tools in the character's inventory
     *
     * @return HasMany<\App\Models\Tool>
     */
    public function tools(): HasMany
    {
        return $this->hasMany(Tool::class);
    }
}
