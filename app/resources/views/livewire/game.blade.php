<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <strong>Game #{{ $game->hash }}</strong><br />
    Health: {{ $game->character->health }}<br />
    Heat: {{ $game->character->heat }}<br />
    Hydration: {{ $game->character->hydration }}<br />
    Satiation: {{ $game->character->satiation }}<br />
    Stamina: {{ $game->character->stamina }}
</div>
