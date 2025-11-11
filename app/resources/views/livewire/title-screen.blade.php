<div>
    <button type="button" wire:click="createFormToggle">
        {{ __('game.action--new') }}
    </button>
    @if ($isCreateFormShown)
        <form wire:submit="onGameCreate">
            <label for="difficulty">{{ __('game.difficulty') }}</label>
            <select value="1" wire:model.number="difficulty">
                <option value="0">{{ __('game.difficulty--0') }}</option>
                <option value="1">{{ __('game.difficulty--1') }}</option>
                <option value="2">{{ __('game.difficulty--2') }}</option>
                <option value="3">{{ __('game.difficulty--3') }}</option>
            </select>
            @error('difficulty')
                <span>{{ $message }}</span>
            @enderror
            <button type="submit">{{ __('game.action--new') }}</button>
        </form>
    @endif

    <button type="button" wire:click="loadFormToggle">
        {{ __('game.action--load') }}
    </button>
    @if ($isLoadFormShown)
        <form wire:submit="onGameLoad">
            <label for="gameID">{{ __('game.id') }}</label>
            <input id="gameID" name="gameID" type="text" wire:model="gameID" />
            @error('gameID')
                <span>{{ $message }}</span>
            @enderror
            <button type="submit">{{ __('game.action--load') }}</button>
        </form>
    @endif
</div>
