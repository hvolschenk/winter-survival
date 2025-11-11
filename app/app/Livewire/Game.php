<?php

namespace App\Livewire;

use App\Models\Game as GameModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Game extends Component
{
    /**
     * The game itself. This should hold all necessary information.
     *
     * @var GameModel
     */
    public GameModel $game;

    /**
     * Mount the component.
     * Check whether the user is authorized to view this game,
     * bind the route bound model to this controller/class.
     * (The model is automatically bound, just for completeness)
     */
    public function mount(GameModel $game)
    {
        $this->authorize('view', $game);
        $this->game = $game;
    }

    /**
     * Renders the component
     */
    public function render()
    {
        return view('livewire.game', ['game' => $this->game]);
    }
}
