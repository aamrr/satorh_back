<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvalController extends Controller
{
    public function show($id){
        $collab::findOrFail($id);
        $evals = $collab->userEvaluations;
        return response()->json(['evaluations' => $evals]);
    }

    public function addTraining(Request $request, $id){
        $collab = User::find($id);
        $collab->userEvaluations::forceCreate(request()->all());
    }
}
