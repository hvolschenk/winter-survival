<?php

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
        Schema::create('backpacks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('l10n_name');
            $table->string('l10n_description');
            $table->unsignedTinyInteger('capacity');
            $table->foreignIdFor(Loadout::class)->index()->nullable()->constrained();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backpacks');
    }
};
