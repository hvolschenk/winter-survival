<?php

namespace App\Models;

use App\Enums\Difficulty;
use App\Enums\Units;
use App\Models\Game;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model
{
    use SoftDeletes;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'difficulty' => Difficulty::Medium->value,
        'units' => Units::Metric->value,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'difficulty',
        'units',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'difficulty' => Difficulty::class,
            'units' => Units::class,
        ];
    }

    /**
     * The game that these settings belong to
     *
     * @return BelongsTo<\App\Models\Game>
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
