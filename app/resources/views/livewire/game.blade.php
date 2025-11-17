<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <strong>Game #{{ $game->hash }}</strong><br /><br />

    <strong>Settings:</strong><br />
    <em>Difficulty</em>: {{ $game->settings->difficulty }}<br />
    <em>Units</em>: {{ $game->settings->units }}<br /><br />

    <strong>Character:</strong><br />
    <em>Health</em>: {{ $game->character->health }}<br />
    <em>Heat</em>: {{ $game->character->heat }}<br />
    <em>Hydration</em>: {{ $game->character->hydration }}<br />
    <em>Satiation</em>: {{ $game->character->satiation }}<br />
    <em>Stamina</em>: {{ $game->character->stamina }}<br /><br />
</div>
