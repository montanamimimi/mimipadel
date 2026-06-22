<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;

class TournamentController extends Controller
{
    public function update(Request $request, Tournament $tournament) {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'courts' => ['required', 'integer', 'min:1'],
        ]);

        $tournament->update($validated);

        return response()->json($tournament);
    }

    public function delete(Request $request, Tournament $tournament) {

        $tournament->delete($tournament);

        return response()->json([
            'name' => $tournament->name,
            'deleted' => true,
        ]);
    }    
}
