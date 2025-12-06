<?php

namespace App\Livewire;

use App\Enums\Difficulty;
use App\Models\Game;
use App\Services\NewGameService;
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
     * Whether to show the "New game" form
     *
     * @var bool
     */
    public bool $isCreateFormShown = false;

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
        $newGameService = new NewGameService(Difficulty::from($validated['difficulty']));
        $game = $newGameService->createNewGame();
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
