<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use Illuminate\Support\Facades\Auth;

class TournamentController extends Controller
{

    public function create(Request $request) {
        $validated = $request->validate([
            'id' => ['required', 'string'],
            'name' => ['required', 'string'],
            'date' => ['required', 'date_format:Y-m-d'],
            'format' => ['required', 'string'],
            'courts' => ['required', 'integer', 'min:1'],
            'points' => ['required', 'integer', 'min:1'],
        ]);

        $validated['user_id'] = Auth::user()->id;
        $validated['mixer'] = true;

        $tournament = Tournament::create($validated);

        return response()->json($tournament, 201);
    }

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
