<div>
    <div>
        <h1>{{ __('game.load-game__title') }}</h1>

        <form wire:submit="onGameLoad">
            <label for="gameID">{{ __('game.id') }}</label>
            <input
                id="gameID"
                name="gameID"
                type="text"
                wire:model="gameID"
            />
            @error('gameID')
                <span>{{ $message }}</span>
            @enderror
            <button type="submit">
                {{ __('game.action--load') }}
            </button>
        </form>

        <a href="{{ route('title-screen') }}">
            {{ __('game.action__back') }}
        </a>
    </div>
</div>
