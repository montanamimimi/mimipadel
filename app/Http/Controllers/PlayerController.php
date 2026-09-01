<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class PlayerController extends Controller
{

    public function create(Request $request) {
        $validated = $request->validate([
            'id' => ['required', 'string'],
            'name' => ['required', 'string'],
        ]);

        $validated['user_id'] = null;

        $player = Player::create($validated);

        return response()->json($player, 201);
    }

    public function update(Request $request, Player $player) {
        $validated = $request->validate([
            'user_id' => ['required', 'string'],
            'name' => ['required', 'string'],            
        ]);

        $player->update($validated);

        return response()->json($player);
    }

    public function delete(Request $request, Player $player) {

        $player->delete($player);

        return response()->json([
            'name' => $player->name,
            'deleted' => true,
        ]);
    }    
}
