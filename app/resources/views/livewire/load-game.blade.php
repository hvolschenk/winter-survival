<div class="container flex h-screen items-center mx-auto">
    <div class="flex flex-col gap-2 mx-auto mt-8 w-sm">
        <h1 class="font-bold text-lg">{{ __('game.load-game__title') }}</h1>

        <form wire:submit="onGameLoad">
            <label class="block" for="gameID">{{ __('game.id') }}</label>
            <input
                class="border border-neutral-800 dark:border-neutral-100 px-2 py-1 w-full"
                id="gameID"
                name="gameID"
                type="text"
                wire:model="gameID"
            />
            @error('gameID')
                <span class="text-sm">{{ $message }}</span>
            @enderror
            <button
                class="border border-neutral-800 cursor-pointer dark:border-neutral-100 drop-shadow-lg hover:bg-neutral-800/10 dark:hover:bg-neutral-100/10 mt-8 px-2 py-1 w-full"
                type="submit"
            >
                {{ __('game.action--load') }}
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
