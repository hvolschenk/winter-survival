<?php

namespace App\Services;

use App\Enums\ClothingType;
use App\Enums\Difficulty;
use App\Models\Backpack;
use App\Models\Character;
use App\Models\Clothing;
use App\Models\Food;
use App\Models\Game;
use App\Models\Inventory;
use App\Models\Loadout;
use App\Models\Settings;
use Exception;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Sqids\Sqids;

class NewGameService {
    /**
     * The list of starter backpacks avilable for each difficulty.
     * A single random backpack will be picked from the list.
     *
     * @var array
     */
    private const STARTER_BACKPACKS = [
        Difficulty::Easy->value => ['sturdy-backpack.json'],
        Difficulty::Medium->value => ['school-bag.json'],
        Difficulty::Hard->value => ['school-bag.json'],
        Difficulty::Brutal->value => ['sling-bag.json'],
    ];

    /**
     * The list of starter clothing available for each difficulty.
     * An array is provided for each slot (each `type` of Clothing),
     * and a single random clothing item will be picked from the list.
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
     * The list of starter food avilable for each difficulty.
     * Each difficulty contains a list of guaranteed items.
     *
     * @var array
     */
    private const STARTER_FOOD = [
        Difficulty::Easy->value => ['energy-bar.json', 'water.json'],
        Difficulty::Medium->value => ['apple.json', 'water.json'],
        Difficulty::Hard->value => ['water.json'],
        Difficulty::Brutal->value => [],
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
        return DB::transaction(function () {
            // The game
            $game = Game::create();
            $sqids = new Sqids(minLength: 8);
            $hash = $sqids->encode([$game->id]);
            $game->hash = $hash;
            $game->save();
            // The character
            $character = Character::create();
            $game->character()->save($character);
            // Inventory
            $inventory = Inventory::create();
            $character->inventory()->save($inventory);
            // Loadout
            $loadout = Loadout::create();
            $character->loadouts()->save($loadout);
            // Backpack
            $backpack = Backpack::create($this->generateStarterBackpack());
            $loadout->backpack()->save($backpack);
            // Clothing
            $clothing = collect();
            foreach ($this->generateStarterClothing() as $starterClothingItemData) {
                $clothingItem = Clothing::create($starterClothingItemData);
                $clothing->push($clothingItem);
            }
            $inventory->clothing()->saveMany($clothing->all());
            $loadout->clothing()->saveMany($clothing->all());
            // Food
            $food = collect();
            foreach ($this->generateStarterFood() as $starterFoodItemData) {
                $foodItem = Food::create($starterFoodItemData);
                $food->push($foodItem);
            }
            $inventory->food()->saveMany($food->all());
            // Settings
            $settings = Settings::create(['difficulty' => $this->difficulty->value]);
            $game->settings()->save($settings);
            return $game;
        });
    }

    /**
     * Generates a starter backpack.
     * Returns an associative array of backpack model values.
     *
     * @return array
     */
    private function generateStarterBackpack(): array
    {
        $backpacksForDifficulty = $this::STARTER_BACKPACKS[$this->difficulty->value];
        $backpackIndex = array_rand($backpacksForDifficulty);
        $filename = 'backpacks/' . $backpacksForDifficulty[$backpackIndex];
        return $this->readItemFromDisk($filename);
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
                $clothing = $this->readItemFromDisk($filename);
                array_push($clothingValues, $clothing);
            }
        }
        return $clothingValues;
    }

    /**
     * Generates a list of starter food values.
     * Each item returned should be an associative array of Food model values.
     *
     * @return list<array>
     */
    private function generateStarterFood(): array
    {
        $foodValues = [];
        $foodForDifficulty = $this::STARTER_FOOD[$this->difficulty->value];
        if (count($foodForDifficulty) > 0) {
            foreach ($foodForDifficulty as $foodFilename) {
                $filename = 'food/' . $foodFilename;
                $foodData = $this->readItemFromDisk($filename);
                array_push($foodValues, $foodData);
            }
        }
        return $foodValues;
    }

    /**
     * Fetches an item preset from disk and returns it as an associative array
     *
     * @param string $path The path to an item definition .json file.
     * @return array
     * @throws Exception When the $path does not contain a valid item.
     */
    private function readItemFromDisk(string $path): array
    {
        $fileContents = $this->localDisk->get($path);
        if (!$fileContents) {
            throw new Exception("The item at $path could not be read");
        }
        return json_decode($fileContents, true);
    }
}
