<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\TournamentPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TournamentPlayerController extends Controller
{
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