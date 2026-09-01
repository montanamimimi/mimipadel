<?php

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
        Schema::create('player_rating_history', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('tournament_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignUlid('player_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignUlid('tournament_game_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedSmallInteger('old_rating');
            $table->unsignedTinyInteger('rating_change');
            $table->unsignedSmallInteger('new_rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_rating_history');
    }
};
