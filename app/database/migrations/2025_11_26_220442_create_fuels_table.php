<?php

use App\Models\Inventory;
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
        Schema::create('fuels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('l10n_name');
            $table->string('l10n_description');
            $table->unsignedTinyInteger('burn_time_turns');
            $table->unsignedTinyInteger('heat_celcius');
            $table->unsignedSmallInteger('weight_grams');
            $table->foreignIdFor(Inventory::class)->index()->nullable()->constrained();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuels');
    }
};
