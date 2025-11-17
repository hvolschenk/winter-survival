<?php

namespace App\Services;

use App\Enums\ClothingType;
use App\Enums\Difficulty;
use App\Models\Character;
use App\Models\Clothing;
use App\Models\Game;
use App\Models\Loadout;
use App\Models\Settings;
use Exception;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\Storage;

class NewGameService {
    /**
     * The list of starter gear available for each difficulty.
     * An array is provided for each slot (each `type` of Clothing),
     * and a single random item will be picked from the list.
     *
     * @var array
     */
    private const STARTER_CLOTHING = [
        Difficulty::Easy->value => [
            ClothingType::Gloves->value => [],
            ClothingType::Hat->value => ['hats/baseball-cap.json'],
            ClothingType::Jacket->value => ['jackets/leather-jacket.json'],
            ClothingType::Pants->value => ['pants/jeans.json'],
            ClothingType::Shirt->value => ['shirts/tshirt.json'],
            ClothingType::Shoes->value => [],
            ClothingType::Socks->value => [],
            ClothingType::Sweater->value => [],
            ClothingType::Underwear->value => [],
        ],
        Difficulty::Medium->value => [
            ClothingType::Gloves->value => [],
            ClothingType::Hat->value => ['hats/baseball-cap.json'],
            ClothingType::Jacket->value => ['jackets/leather-jacket.json'],
            ClothingType::Pants->value => ['pants/jeans.json'],
            ClothingType::Shirt->value => ['shirts/tshirt.json'],
            ClothingType::Shoes->value => [],
            ClothingType::Socks->value => [],
            ClothingType::Sweater->value => [],
            ClothingType::Underwear->value => [],
        ],
        Difficulty::Hard->value => [
            ClothingType::Gloves->value => [],
            ClothingType::Hat->value => ['hats/baseball-cap.json'],
            ClothingType::Jacket->value => ['jackets/leather-jacket.json'],
            ClothingType::Pants->value => ['pants/jeans.json'],
            ClothingType::Shirt->value => ['shirts/tshirt.json'],
            ClothingType::Shoes->value => [],
            ClothingType::Socks->value => [],
            ClothingType::Sweater->value => [],
            ClothingType::Underwear->value => [],
        ],
        Difficulty::Brutal->value => [
            ClothingType::Gloves->value => [],
            ClothingType::Hat->value => ['hats/baseball-cap.json'],
            ClothingType::Jacket->value => ['jackets/leather-jacket.json'],
            ClothingType::Pants->value => ['pants/jeans.json'],
            ClothingType::Shirt->value => ['shirts/tshirt.json'],
            ClothingType::Shoes->value => [],
            ClothingType::Socks->value => [],
            ClothingType::Sweater->value => [],
            ClothingType::Underwear->value => [],
        ],
    ];

    /**
     * The game difficulty chosen by the player.
     *
     * @var Difficulty
     */
    private Difficulty $difficulty = Difficulty::Medium;

    /**
     * The local disk where the clothing information is stored.
     *
     * @var Filesystem
     */
    private Filesystem $localDisk;

    /**
     * Construct a new `NewGameService` instance.
     *
     * @param ?Difficulty $difficulty The game difficulty as selected by the player.
     */
    public function __construct(?Difficulty $difficulty)
    {
        $this->localDisk = Storage::disk('local');
        if ($difficulty) {
            $this->difficulty = $difficulty;
        }
    }

    /**
     * Creates a new game.
     *
     * @return Game
     */
    public function createNewGame(): Game
    {
        $starterClothing = $this->generateStarterClothing();
        $game = Game::factory()
            ->has(Character::factory()
                ->has(Loadout::factory()
                    ->has(Clothing::factory()
                        ->count(count($starterClothing))
                        ->state(new Sequence(...$starterClothing)),
                    ),
                ),
            )
            ->has(Settings::factory()
                ->state(['difficulty' => $this->difficulty->value])
            )
            ->create();
        return $game;
    }

    /**
     * Generates a list of starter clothing values.
     * Each item returned should be an associative array of Clothing model values.
     *
     * @return list<array>
     */
    private function generateStarterClothing(): array
    {
        $clothingValues = [];
        $clothingForDifficulty = $this::STARTER_CLOTHING[$this->difficulty->value];
        foreach (ClothingType::cases() as $clothingType) {
            $filesForClothingType = $clothingForDifficulty[$clothingType->value];
            if (count($filesForClothingType) > 0) {
                $typeIndex = array_rand($filesForClothingType);
                $filename = 'clothing/' . $filesForClothingType[$typeIndex];
                $clothing = $this->readClothingFromDisk($filename);
                array_push($clothingValues, $clothing);
            }
        }
        return $clothingValues;
    }

    /**
     * Fetches the clothing preset from disk and returns it as an associative array
     *
     * @param string $path The path to the clothing definition .json file.
     * @return array
     * @throws Exception When the $path does not contain valid clothing.
     */
    private function readClothingFromDisk(string $path): array
    {
        $fileContents = $this->localDisk->get($path);
        if (!$fileContents) {
            throw new Exception("The clothing at $path could not be read");
        }
        return json_decode($fileContents, true);
    }
}
