<?php

namespace App\Models;

use App\Models\Loadout;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Backpack extends Model
{
    /** @use HasFactory<\Database\Factories\BackpackFactory> */
    use HasFactory, SoftDeletes;

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
        'loadout_id',
    ];

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
