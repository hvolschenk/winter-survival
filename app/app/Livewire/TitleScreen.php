<?php

namespace App\Livewire;

use App\Models\Character;
use App\Enums\Difficulty;
use App\Models\Game;
use Illuminate\Validation\Rule;
use Livewire\Component;

class TitleScreen extends Component
{
    /**
     * The `Difficulty` form field value, used when creating a new game.
     *
     * @var string
     */
    public string $difficulty = Difficulty::Medium->value;

    /**
     * The `Game ID` form field value, used when loading a game.
     *
     * @var string
     */
    public string $gameID = '';

    /**
     * Whether to show the "New game" form
     *
     * @var bool
     */
    public bool $isCreateFormShown = false;

    /**
     * Whether to show the "Load game" form
     *
     * @var bool
     */
    public bool $isLoadFormShown = false;

    /**
     * Toggles the visibility of the "New game" form
     *
     * @return void
     */
    public function createFormToggle(): void
    {
        $this->isCreateFormShown = !$this->isCreateFormShown;
    }

    /**
     * Toggles the visibility of the "Load game" form
     *
     * @return void
     */
    public function loadFormToggle(): void
    {
        $this->isLoadFormShown = !$this->isLoadFormShown;
    }

    /**
     * Create a new game
     *
     * @return void
     */
    public function onGameCreate()
    {
        $this->authorize('create', Game::class);
        $validated = $this->validate([
            'difficulty' => [
                'required',
                Rule::enum(Difficulty::class),
            ],
        ]);
        $game = Game::factory()
            ->has(Character::factory())
            ->create([
                'difficulty' => $validated['difficulty'],
            ]);
        return redirect(route('game', $game));
    }

    /**
     * Load a game by its hash by submitting the "Load game" form
     */
    public function onGameLoad()
    {
        $validated = $this->validate([
            'gameID' => 'required|min:8|exists:games,hash',
        ]);
        $gameID = $validated['gameID'];
        $game = Game::where(['hash' => $gameID])->first();
        $this->authorize('view', $game);
        return redirect(route('game', $game));
    }

    /**
     * Render the component with a view
     */
    public function render()
    {
        return view('livewire.title-screen');
    }
}
