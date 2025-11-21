<?php

namespace App\Models;

use App\Models\Character;
use App\Models\Settings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use SoftDeletes;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'turn' => 1,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'hash',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [];

    /**
     * The character for this playthrough
     *
     * @return HasOne<\App\Models\Character>
     */
    public function character(): HasOne
    {
        return $this->hasOne(Character::class);
    }

    /**
     * The character for this playthrough
     *
     * @return HasOne<\App\Models\Settings>
     */
    public function settings(): HasOne
    {
        return $this->hasOne(Settings::class);
    }
}
