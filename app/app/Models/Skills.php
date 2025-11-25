<?php

namespace App\Models;

use App\Models\Character;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skills extends Model
{
    use SoftDeletes;

    /**
     * The minimum amount of experience required to achieve levels 1 through 5
     * in the art of wielding the bow.
     *
     * @var list<integer>
     */
    private const BOW_EXPERIENCE_LEVELS = [0, 10, 30, 70, 150];

    /**
     * The minimum amount of experience required to achieve levels 1 through 5
     * in the art of cooking.
     *
     * @var list<integer>
     */
    private const COOKING_EXPERIENCE_LEVELS = [0, 20, 60, 140, 300];

    /**
     * The minimum amount of experience required to achieve levels 1 through 5
     * with firearms.
     *
     * @var list<integer>
     */
    private const FIREARM_EXPERIENCE_LEVELS = [0, 10, 30, 70, 150];

    /**
     * The minimum amount of experience required to achieve levels 1 through 5
     * in fire starting.
     *
     * @var list<integer>
     */
    private const FIRE_STARTING_EXPERIENCE_LEVELS = [0, 15, 45, 105, 225];

    /**
     * The minimum amount of experience required to achieve levels 1 through 5
     * with fishing.
     *
     * @var list<integer>
     */
    private const FISHING_EXPERIENCE_LEVELS = [0, 10, 30, 70, 150];

    /**
     * The minimum amount of experience required to achieve levels 1 through 5
     * with tailoring.
     *
     * @var list<integer>
     */
    private const TAILORING_EXPERIENCE_LEVELS = [0, 5, 15, 35, 75];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'bow_experience' => 0,
        'cooking_experience' => 0,
        'firearm_experience' => 0,
        'fire_starting_experience' => 0,
        'fishing_experience' => 0,
        'tailoring_experience' => 0,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'bow_experience',
        'cooking_experience',
        'firearm_experience',
        'fire_starting_experience',
        'fishing_experience',
        'tailoring_experience',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'character_id',
    ];

    /**
     * An accessor to get the character's bow level from their experience
     *
     * @return Attribute
     */
    protected function bowLevel(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $experience = $attributes['bow_experience'];
                $experienceLevels = self::BOW_EXPERIENCE_LEVELS;
                return $this->userLevel($experience, $experienceLevels);
            },
        );
    }

    /**
     * An accessor to get the character's cooking level from their experience
     *
     * @return Attribute
     */
    protected function cookingLevel(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $experience = $attributes['cooking_experience'];
                $experienceLevels = self::COOKING_EXPERIENCE_LEVELS;
                return $this->userLevel($experience, $experienceLevels);
            },
        );
    }

    /**
     * An accessor to get the character's firearm level from their experience
     *
     * @return Attribute
     */
    protected function firearmLevel(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $experience = $attributes['firearm_experience'];
                $experienceLevels = self::FIREARM_EXPERIENCE_LEVELS;
                return $this->userLevel($experience, $experienceLevels);
            },
        );
    }

    /**
     * An accessor to get the character's fire starting level from their experience
     *
     * @return Attribute
     */
    protected function fireStartingLevel(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $experience = $attributes['fire_starting_experience'];
                $experienceLevels = self::FIRE_STARTING_EXPERIENCE_LEVELS;
                return $this->userLevel($experience, $experienceLevels);
            },
        );
    }

    /**
     * An accessor to get the character's fishing level from their experience
     *
     * @return Attribute
     */
    protected function fishingLevel(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $experience = $attributes['fishing_experience'];
                $experienceLevels = self::FISHING_EXPERIENCE_LEVELS;
                return $this->userLevel($experience, $experienceLevels);
            },
        );
    }

    /**
     * An accessor to get the character's tailoring level from their experience
     *
     * @return Attribute
     */
    protected function tailoringLevel(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $experience = $attributes['tailoring_experience'];
                $experienceLevels = self::TAILORING_EXPERIENCE_LEVELS;
                return $this->userLevel($experience, $experienceLevels);
            },
        );
    }

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
     * Get the user's level in any skill
     * given their current experience in said skill
     * together with a list of minimum experience per level.
     * This assumes that there are always 5 levels.
     *
     * @param int $experience The user's current experience level in the given skill
     * @param list<int> $experienceLevels The list of required experiences per level
     * @return int The current level
     */
    private function userLevel(int $experience, array $experienceLevels): int
    {
        for ($checkLevel = 4; $checkLevel >= 0; $checkLevel--) {
            $requiredExperience = $experienceLevels[$checkLevel];
            if ($experience >= $requiredExperience) {
                return $checkLevel + 1;
            }
        }
        return 1;
    }
}
