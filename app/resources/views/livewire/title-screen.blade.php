<div>
    <button type="button" wire:click="createFormToggle">
        {{ __('game.action--new') }}
    </button>
    @if ($isCreateFormShown)
        <form wire:submit="onGameCreate">
            <label for="difficulty">{{ __('game.difficulty') }}</label>
            <select
                id="difficulty"
                value="{{ App\Enums\Difficulty::Medium->value }}"
                wire:model.live="difficulty"
            >
                @foreach(App\Enums\Difficulty::cases() as $difficultySetting)
                    <option
                        @selected($difficultySetting == App\Enums\Difficulty::Medium)
                        value="{{ $difficultySetting->value }}"
                    >
                        {{ __("settings.difficulty__{$difficultySetting->value}__name") }}
                    </option>
                @endforeach
            </select>
            @error('difficulty')
                <span>{{ $message }}</span>
            @enderror
            <p>{{ __("settings.difficulty__{$difficulty}__description") }}</p>
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
