<?php

namespace App\Livewire;

use App\Models\Game;
use App\Services\SavedGamesService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class LoadGame extends Component
{
    /**
     * The `Game ID` form field value, used when loading a game.
     *
     * @var string
     */
    public string $gameID = '';

    /**
     * A list of previously created games
     *
     * @var Collection<\App\Models\Game>
     */
    public Collection $savedGames;

    /**
     * Accept parameters and initialize the state of the component
     */
    public function mount()
    {
        $this->savedGames = SavedGamesService::list();
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

    public function render()
    {
        return view('livewire.load-game');
    }
}
