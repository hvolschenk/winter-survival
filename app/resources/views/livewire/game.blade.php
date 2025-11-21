<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <strong>Game #{{ $game->hash }}</strong><br /><br />

    <strong>Settings:</strong><br />
    <em>Difficulty</em>:
    {{ __("settings.difficulty__{$game->settings->difficulty->value}__name") }}
    <br />
    <em>Units</em>:
    {{ __("settings.units__{$game->settings->units->value}__name") }}
    <br /><br />

    <strong>Character:</strong><br />
    <em>Health</em>: {{ $game->character->health }}<br />
    <em>Heat</em>: {{ $game->character->heat }}<br />
    <em>Hydration</em>: {{ $game->character->hydration }}<br />
    <em>Satiation</em>: {{ $game->character->satiation }}<br />
    <em>Stamina</em>: {{ $game->character->stamina }}<br /><br />

    <strong>Loadouts:</strong><br />
    @foreach ($game->character->loadouts as $loadout)
        <strong>Loadout #{{ $loop->index }}</strong><br />
        <em>Backpack:</em>: {{ __($loadout->backpack->l10n_name) }}
        <br />

        <em>Gloves</em>:
        @if ($loadout->gloves)
            {{ __($loadout->gloves->l10n_name) }}
        @endif
        <br />

        <em>Hat</em>:
        @if ($loadout->hat)
            {{ __($loadout->hat->l10n_name) }}
        @endif
        <br />

        <em>Jacket</em>:
        @if ($loadout->jacket)
            {{ __($loadout->jacket->l10n_name) }}
        @endif
        <br />

        <em>Pants</em>:
        @if ($loadout->pants)
            {{ __($loadout->pants->l10n_name) }}
        @endif
        <br />

        <em>Shirt</em>:
        @if ($loadout->shirt)
            {{ __($loadout->shirt->l10n_name) }}
        @endif
        <br />

        <em>Shoes</em>:
        @if ($loadout->shoes)
            {{ __($loadout->shoes->l10n_name) }}
        @endif
        <br />

        <em>Socks</em>:
        @if ($loadout->socks)
            {{ __($loadout->socks->l10n_name) }}
        @endif
        <br />

        <em>Sweater</em>:
        @if ($loadout->sweater)
            {{ __($loadout->sweater->l10n_name) }}
        @endif
        <br />

        <em>Underwear</em>:
        @if ($loadout->underwear)
            {{ __($loadout->underwear->l10n_name) }}
        @endif
        <br /><br />
    @endforeach
    <strong>Inventory</strong>:<br />
    <em>Clothing</em>:<br />
    @foreach ($game->character->inventory->clothing as $clothingItem)
        {{ __($clothingItem->l10n_name) }}<br />
    @endforeach
    <br />
</div>
