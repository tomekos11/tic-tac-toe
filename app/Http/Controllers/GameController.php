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
        $won_games_counter = Game::where('result', 1)->count();
        $lost_games_counter = Game::where('result', 2)->count();
        $draws_counter = Game::where('result', 0)->count();
        // $stats = Game::all();
        // Odpowiedź z sukcesem
        return response()->json([
            'message' => 'Dane zapisane pomyślnie',
            'game' => $game,
            'stats' => [
                'wins_amount' => $won_games_counter,
                'loss_amount' => $lost_games_counter,
                'draws_amount' => $draws_counter
            ], 
        ], 200);
    }

    function GetResults(Request $request) {
        return $games = Game::all();
    }

    function getStats(Request $request) {
        $won_games_counter = Game::where('result', 1)->count();
        $lost_games_counter = Game::where('result', 2)->count();
        $draws_counter = Game::where('result', 0)->count();

        return response()->json([
            'message' => 'Pomyślnie pobrano statystyki',
            'stats' => [
                'wins_amount' => $won_games_counter,
                'loss_amount' => $lost_games_counter,
                'draws_amount' => $draws_counter
            ], 
        ], 200);
    }
}
