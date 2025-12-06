<div>
    <div>
        <h1>{{ __('game.new-game__title') }}</h1>
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
            @else
                <p>
                    {{ __("settings.difficulty__{$difficulty}__description") }}
                </p>
            @enderror
            <button type="submit">
                {{ __('game.action--new') }}
            </button>
        </form>

        <a href="{{ route('title-screen') }}">
            {{ __('game.action__back') }}
        </a>
    </div>
</div>
