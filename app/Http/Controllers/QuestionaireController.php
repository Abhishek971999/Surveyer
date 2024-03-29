<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionaireController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function create(){
        return view('questionaire.create');
    }

    public function store(){
        $data = request()->validate([
            'title'=>'required',
            'purpose'=>'required',
        ]);
        $questionaire = auth()->user()->questionaires()->create($data);
        return redirect('/questionaire/'.$questionaire->id);
    }

    public function show(\App\Questionaire $questionaire){
        $questionaire->load('questions.answers.responses');

        return view('questionaire.show',compact('questionaire'));
    }
}
