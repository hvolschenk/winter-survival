<?php

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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedTinyInteger('health')->default(100);
            $table->unsignedTinyInteger('heat')->default(100);
            $table->unsignedTinyInteger('hydration')->default(100);
            $table->unsignedTinyInteger('satiation')->default(100);
            $table->unsignedTinyInteger('stamina')->default(100);
            $table->foreignIdFor(Game::class)->index()->nullable()->constrained();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
