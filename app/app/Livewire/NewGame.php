<?php

namespace App\Livewire;

use App\Enums\Difficulty;
use App\Models\Game;
use App\Services\NewGameService;
use App\Services\SavedGamesService;
use Illuminate\Validation\Rule;
use Livewire\Component;

class NewGame extends Component
{
    /**
     * The `Difficulty` form field value, used when creating a new game.
     *
     * @var string
     */
    public string $difficulty = Difficulty::Medium->value;

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
        SavedGamesService::new($game);
        return redirect(route('game', $game));
    }

    public function render()
    {
        return view('livewire.new-game');
    }
}
