<?php

use App\Enums\ClothingType;
use App\Models\Inventory;
use App\Models\Loadout;
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
        Schema::create('clothing', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('l10n_name');
            $table->string('l10n_description');
            $table->enum('type', array_column(ClothingType::cases(), 'value'));
            $table->unsignedTinyInteger('condition')->default(100);
            $table->unsignedTinyInteger('warmth_celcius');
            $table->unsignedTinyInteger('armor');
            $table->unsignedTinyInteger('wind_protection_celcius');
            $table->unsignedSmallInteger('weight_grams');
            $table->foreignIdFor(Inventory::class)->index()->nullable()->constrained();
            $table->foreignIdFor(Loadout::class)->index()->nullable()->constrained();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clothing');
    }
};
