<?php

namespace App\Http\Controllers;

use App\Name;
use Redirect, Response;
use Illuminate\Http\Request;

class NameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $names = Name::all();

        //return view('welcome', compact('names'));
        return view('selectWinner.index', compact('names'));
    }

    public function create()
    {
        return view('selectWinner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $user_id = $request->user_id;
        $name   =   Name::updateOrCreate(
                    ['id' => $user_id],
                    ['name' => $request->name]
                );

        //dd($name);
    
        return Response::json($name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Name  $name
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $name = Name::where('id', $id)->delete();
   
        return Response::json($name);
    }
}
