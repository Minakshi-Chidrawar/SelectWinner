<?php

namespace App\Http\Controllers;

use App\Name;
use Redirect, Response, Validator;
use Illuminate\Http\Request;

class SelectWinnersController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Name  $name
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //dd($request->numberOfWinners);
        $names = Name::all();
        $winnerNames = Name::inRandomOrder()->take($request->numberOfWinners)->get();

        //dd($names);
        //return Response::json($winnerNames);
        return view('selectWinner.index', compact('names', 'winnerNames'));
        //return redirect::route('index', ['names' => $names, 'winnerNames' => $winnerNames]);
    }
}
