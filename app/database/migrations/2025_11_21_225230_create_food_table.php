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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedTinyInteger('condition')->default(100);
            $table->unsignedTinyInteger('energy')->default(0);
            $table->unsignedTinyInteger('hydration')->default(0);
            $table->string('l10n_name');
            $table->string('l10n_description');
            $table->unsignedTinyInteger('satiation')->default(0);
            $table->unsignedTinyInteger('stamina')->default(0);
            $table->foreignIdFor(Inventory::class)->index()->nullable()->constrained();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
