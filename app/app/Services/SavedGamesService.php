<?php

namespace App\Services;

use App\Models\Game;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cookie;

class SavedGamesService {
    /**
     * The name of the cookie where saved games are stored.
     *
     * @var string
     */
    private const SAVED_GAMES_COOKIE_NAME = 'SAVED_GAMES';

    /**
     * Builds the list of saved games available on the user's local browser.
     *
     * @return Collection<\App\Models\Game>
     */
    public static function list(): Collection
    {
        $savedGameHashes = SavedGamesService::listHashes();
        if (count($savedGameHashes) > 0) {
            $games = Game::with(['settings'])->whereIn('hash', $savedGameHashes)->get();
            return $games;
        }
        return collect();
    }

    /**
     * Builds a list of saved game hashes
     *
     * @return list<string>
     */
    private static function listHashes(): array
    {
        $savedGamesCookie = Cookie::get(SavedGamesService::SAVED_GAMES_COOKIE_NAME, '');
        $savedGameHashes = $savedGamesCookie === '' ? [] : explode(',', $savedGamesCookie);
        return $savedGameHashes;
    }

    /**
     * Adds a new saved game to the list of saved games available on the user's local browser.
     * Queues the cookie to be set with the next response.
     *
     * @return void
     */
    public static function new(Game $game): void
    {
        $savedGameHashes = SavedGamesService::listHashes();
        array_push($savedGameHashes, $game->hash);
        Cookie::queue(SavedGamesService::SAVED_GAMES_COOKIE_NAME, join(',', $savedGameHashes));
    }
}
