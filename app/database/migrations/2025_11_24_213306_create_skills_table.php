<?php

use App\Models\Character;
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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('bow_experience')->default(0);
            $table->unsignedInteger('cooking_experience')->default(0);
            $table->unsignedInteger('firearm_experience')->default(0);
            $table->unsignedInteger('fire_starting_experience')->default(0);
            $table->unsignedInteger('fishing_experience')->default(0);
            $table->unsignedInteger('tailoring_experience')->default(0);
            $table->foreignIdFor(Character::class)->index()->nullable()->constrained();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
