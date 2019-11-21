<?php

namespace App\Http\Controllers;

use App\Name;
use Redirect, Response, Validator;
use Illuminate\Http\Request;

class SelectWinnersController extends Controller
{
    public function winners(Request $request)
    {
        $numberToSelectWinner = $request->numberOfWinners;
        $names = Name::all();

        if (count($names) < $numberToSelectWinner)
        {
            $errorMsg = 'You have entered the number ' . $numberToSelectWinner . ' to select the winners.'
                      . ' But there are only ' . count($names) . ' users exists.' 
                      . ' Please enter the number less than ' . count($names) . '.';

            return redirect()->action('NameController@index')->withFail($errorMsg); 
        }

        $winnerNames = Name::inRandomOrder()->take($numberToSelectWinner)->get();
        
        return view('selectWinner.index', compact('names', 'winnerNames'));
    }

    public function clear()
    {
        return redirect()->action('NameController@index');
    }
}
