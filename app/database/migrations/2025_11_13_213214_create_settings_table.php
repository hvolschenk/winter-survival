<?php

use App\Enums\Difficulty;
use App\Enums\Units;
use App\Models\Game;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('difficulty', array_column(Difficulty::cases(), 'value'))
                ->default(Difficulty::Medium->value);
            $table->enum('units', array_column(Units::cases(), 'value'))
                ->default(Units::Metric->value);
            $table->foreignIdFor(Game::class);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
