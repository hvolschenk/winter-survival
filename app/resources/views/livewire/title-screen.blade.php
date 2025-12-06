<div class="container flex h-screen items-center mx-auto">
    <div class="flex flex-col gap-2 mx-auto mt-8 w-sm">
        <a
            class="border border-neutral-800 cursor-pointer dark:border-neutral-100 drop-shadow-lg hover:bg-neutral-800/10 dark:hover:bg-neutral-100/10 mt-8 px-2 py-1 w-full"
            href="{{ route('new-game') }}"
        >
            {{ __('game.action--new') }}
        </a>

        <a
            class="border border-neutral-800 cursor-pointer dark:border-neutral-100 drop-shadow-lg hover:bg-neutral-800/10 dark:hover:bg-neutral-100/10 mt-8 px-2 py-1 w-full"
            href="{{ route('load-game') }}"
        >
            {{ __('game.action--load') }}
        </a>
    </div>
</div>
