<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function show($id){
    
        $collab::findOrFail($id);
        $skills = $collab->userSkills;
        return response()->json(['skills' => $skills]);
    }

    public function addSkill(Request $request, $id){
        $collab = User::find($id);
        $collab->userSkills::forceCreate(request()->all());
    }
}
