<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\TournamentPlayer;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Validator;

class TournamentPlayerController extends Controller
{

    public function storeBulk(Request $request, Tournament $tournament)
    {
        
        $validated = $request->validate([
            'players' => ['required', 'array'],
        ]);

        foreach ($validated['players'] as $player) {
            $player = Player::firstOrCreate(
                ['id' => $player['player_id']],
                ['name' => $player['name']],
            );
        }

        DB::transaction(function () use ($tournament, $validated) {
            foreach ($validated['players'] as $player) {
                TournamentPlayer::updateOrCreate(['id' => $player['id']], $player);
            }
        });

        return response()->json(['success' => true]);
    }

    public function store(Request $request, Tournament $tournament)
    {
        $validated = $request->validate([
            'id' => ['required', 'string'],
            'player_id' => ['nullable', 'string'],
            'name' => ['required', 'string'],
        ]);

        $validated['tournament_id'] = $tournament->id;

        $player = TournamentPlayer::create($validated);

        return response()->json($player, 201);
    }

    public function destroy(Tournament $tournament, TournamentPlayer $player)
    {
        
        if ($player->tournament_id !== $tournament->id) {
            abort(404);
        }

        $player->delete();

        return response()->json([
            'message' => 'Player deleted successfully',
        ]);
    }    
}