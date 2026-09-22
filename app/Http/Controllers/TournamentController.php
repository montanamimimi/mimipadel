<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use Illuminate\Support\Facades\Auth;

class TournamentController extends Controller
{
    public function index() {
        return Tournament::all();
    }

    public function show(Tournament $tournament)
    {
        return $tournament;
    }

    public function store(Request $request) {
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
            'points' => ['required', 'integer', 'min:1'],
            'started' => ['required', 'boolean'],
            'finished' => ['required', 'boolean'],
            'mixer' => ['required', 'boolean'],
        ]);

        $tournament->update($validated);

        return response()->json($tournament);
    }

    public function destroy(Tournament $tournament) {

        $tournament->delete($tournament);

        return response()->json([
            'name' => $tournament->name,
            'deleted' => true,
        ]);
    }    
}
