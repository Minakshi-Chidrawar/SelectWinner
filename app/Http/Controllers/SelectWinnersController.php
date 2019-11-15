<?php

namespace App\Http\Controllers;

use App\Name;
use Redirect, Response, Validator;
use Illuminate\Http\Request;

class SelectWinnersController extends Controller
{
    public function winners(Request $request)
    {
        $names = Name::all();
        $winnerNames = Name::inRandomOrder()->take($request->numberOfWinners)->get();
        
        return view('selectWinner.index', compact('names', 'winnerNames'));
    }

    public function clear()
    {
        return redirect()->action('NameController@index');
    }
}
