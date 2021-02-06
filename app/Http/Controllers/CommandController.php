<?php

namespace App\Http\Controllers;

use App\Models\Command;
use Illuminate\Http\Request;

class CommandController extends Controller
{


    public function create(){

        return view('ajaxCommands.create');

    }

    public function store(Request $request){

        $file_name = $this ->saveImage($request->photo,'images/commands');


        //Insert data to DB

        Command::create([
            'photo'=>$file_name,
            'nom_ar'=> $request->nom_ar,
            'nom_en'=> $request->nom_en,
            'prix'=> $request->prix,
            'article_ar'=> $request->article_ar,
            'article_en'=> $request->article_en,
        ]);
    }




}
