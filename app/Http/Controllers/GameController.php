<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    function SaveResult(Request $request) {
        $game = new Game();
        $game->moves_counter = $request->movesCounter;
        $game->result = $request->result;
        $game->first_move = $request->firstMove;
        $game->save();

        // Odpowiedź z sukcesem
        return response()->json([
            'message' => 'Dane zapisane pomyślnie',
            'gra' => $game,
        ], 200);
    }

    function GetResults(Request $request) {
        return $games = Game::all();
    }
}
