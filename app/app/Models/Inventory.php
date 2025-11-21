<?php

namespace App\Models;

use App\Models\Character;
use App\Models\Clothing;
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
}
