<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\TournamentGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TournamentGameController extends Controller
{
    public function storeBulk(Request $request, Tournament $tournament)
    {
        
        $validated = $request->validate([
            'games' => ['required', 'array'],
        ]);

        DB::transaction(function () use ($tournament, $validated) {
            foreach ($validated['games'] as $game) {

                if (($game['side_1_score'] + $game['side_2_score']) > 0) {
                    TournamentGame::updateOrCreate(['id' => $game['id']], $game);
                }
                
            }
        });

        return response()->json(['success' => true]);
    }

    public function update(Request $request, Tournament $tournament, TournamentGame $game) {
        
        if ($game->tournament_id !== $tournament->id) {
            abort(404);
        }

        $validated = $request->validate([
            'side_1_score' => ['required', 'integer'],
            'side_2_score' => ['required', 'integer'],
        ]);

        $game->update($validated);

        return response()->json($game);
    }    

    public function destroyAll(Tournament $tournament)
    {
        TournamentGame::where('tournament_id', $tournament->id)->delete();
        
        return response()->json(['message' => 'Games deleted successfully']);
    }    
}