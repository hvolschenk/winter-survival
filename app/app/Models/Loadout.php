<?php

namespace App\Models;

use App\Enums\ClothingType;
use App\Models\Character;
use App\Models\Clothing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loadout extends Model
{
    /** @use HasFactory<\Database\Factories\LoadoutFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The character that this loadout belongs to
     *
     * @return BelongsTo<\App\Models\Character>
     */
    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    /**
     * All clothing belonging to this loadout
     *
     * @return HasMany<\App\Models\Clothing>
     */
    public function clothing(): HasMany
    {
        return $this->hasMany(Clothing::class);
    }

    /**
     * The gloves that the character is wearing.
     *
     * @return HasOne<\App\Models\Clothing>
     */
    public function gloves(): HasOne
    {
        return $this
            ->hasOne(Clothing::class)
            ->where(['type' => ClothingType::Gloves->value]);
    }

    /**
     * The hat that the character is wearing.
     *
     * @return HasOne<\App\Models\Clothing>
     */
    public function hat(): HasOne
    {
        return $this
            ->hasOne(Clothing::class)
            ->where(['type' => ClothingType::Hat->value]);
    }

    /**
     * The jacket that the character is wearing.
     *
     * @return HasOne<\App\Models\Clothing>
     */
    public function jacket(): HasOne
    {
        return $this
            ->hasOne(Clothing::class)
            ->where(['type' => ClothingType::Jacket->value]);
    }

    /**
     * The pants that the character is wearing.
     *
     * @return HasOne<\App\Models\Clothing>
     */
    public function pants(): HasOne
    {
        return $this
            ->hasOne(Clothing::class)
            ->where(['type' => ClothingType::Pants->value]);
    }

    /**
     * The shirt that the character is wearing.
     *
     * @return HasOne<\App\Models\Clothing>
     */
    public function shirt(): HasOne
    {
        return $this
            ->hasOne(Clothing::class)
            ->where(['type' => ClothingType::Shirt->value]);
    }

    /**
     * The shoes the character is wearing.
     *
     * @return HasOne<\App\Models\Clothing>
     */
    public function shoes(): HasOne
    {
        return $this
            ->hasOne(Clothing::class)
            ->where(['type' => ClothingType::Shoes->value]);
    }

    /**
     * The socks that the character is wearing.
     *
     * @return HasOne<\App\Models\Clothing>
     */
    public function socks(): HasOne
    {
        return $this
            ->hasOne(Clothing::class)
            ->where(['type' => ClothingType::Socks->value]);
    }

    /**
     * The sweater that the character is wearing.
     *
     * @return HasOne<\App\Models\Clothing>
     */
    public function sweater(): HasOne
    {
        return $this
            ->hasOne(Clothing::class)
            ->where(['type' => ClothingType::Sweater->value]);
    }

    /**
     * The underwear that the character is wearing.
     *
     * @return HasOne<\App\Models\Clothing>
     */
    public function underwear(): HasOne
    {
        return $this
            ->hasOne(Clothing::class)
            ->where(['type' => ClothingType::Underwear->value]);
    }
}
