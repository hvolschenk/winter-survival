<div class="container flex h-screen items-center mx-auto">
    <div class="flex flex-col gap-2 mx-auto mt-8 w-sm">
        <h1 class="font-bold text-lg">{{ __('game.new-game__title') }}</h1>
        <form wire:submit="onGameCreate">
            <label class="block" for="difficulty">{{ __('game.difficulty') }}</label>
            <select
                class="border border-neutral-800 dark:border-neutral-100 px-2 py-1 w-full"
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
                <span class="text-sm">{{ $message }}</span>
            @else
                <p class="dark:text-neutral-300 text-neutral-500 text-sm">
                    {{ __("settings.difficulty__{$difficulty}__description") }}
                </p>
            @enderror
            <button
                class="border border-neutral-800 cursor-pointer dark:border-neutral-100 drop-shadow-lg hover:bg-neutral-800/10 dark:hover:bg-neutral-100/10 mt-8 px-2 py-1 w-full"
                type="submit"
            >
                {{ __('game.action--new') }}
            </button>
        </form>

        <a
            class="border border-neutral-800 cursor-pointer dark:border-neutral-100 drop-shadow-lg hover:bg-neutral-800/10 dark:hover:bg-neutral-100/10 px-2 py-1 text-center"
            href="{{ route('title-screen') }}"
        >
            {{ __('game.action__back') }}
        </a>
    </div>
</div>
