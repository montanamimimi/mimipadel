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
        Schema::create('tournament_games', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('tournament_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('round')->default(0);

            $table->foreignUlid('side1_player1_id')
                ->nullable()
                ->constrained('tournament_players');

            $table->foreignUlid('side1_player2_id')
                ->nullable()
                ->constrained('tournament_players');

            $table->foreignUlid('side2_player1_id')
                ->nullable()
                ->constrained('tournament_players');

            $table->foreignUlid('side2_player2_id')
                ->nullable()
                ->constrained('tournament_players');

            $table->integer('side_1_score')->default(0);
            $table->integer('side_2_score')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_games');
    }
};
