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
    public function show($numberOfWinners)
    {
        dd($numberOfWinners);
        $names = Name::inRandomOrder()->take($request->numberOfWinners)->get();

        //return view('welcome', compact('names'));       
        return response()->json($names);
    }
}
