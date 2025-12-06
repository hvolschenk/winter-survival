<?php

use App\Livewire\Game;
use App\Livewire\LoadGame;
use App\Livewire\TitleScreen;
use Illuminate\Support\Facades\Route;

Route::get('/game/load', LoadGame::class)->name('load-game');
Route::get('/game/{game:hash}', Game::class)->name('game');
Route::get('/', TitleScreen::class)->name('title-screen');
