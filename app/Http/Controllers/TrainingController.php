<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function show($id){
    
        $collab::findOrFail($id);
        $trainings = $collab->userTrainings;
        return response()->json(['trainings' => $train]);
    }

    public function addTraining(Request $request, $id){
        $collab = User::find($id);
        $collab->userTrainings::forceCreate(request()->all());
    }
}
