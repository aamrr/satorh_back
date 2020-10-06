<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Exceptions\UnauthorizedException;

class UserController extends Controller
{

    /**
     * @SWG\Get(
     *   path="/api/testing/{mytest}",
     *   summary="Get Testing",
     *   operationId="testing",
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error"),
	 *		@SWG\Parameter(
     *          name="mytest",
     *          in="path",
     *          required=true, 
     *          type="string" 
     *      ),
     * )
     *
     */

    public function showALL(){
        // $collabs = User::all();
        $collabs = User::role('collaborator')->orderBy('created_at', 'desc')->get();
        return response()->json($collabs);
    }

    public function show($id){
        //when the user is a collaborator he can only show his own profile
        if (! $request->user()->hasAnyRole(['rh','projectmanager','superadmin'])){
            if ($request->user()->id != $id){
                throw UnauthorizedException::forRoles(['rh','projectmanager','superadmin']);
                return;
            }
        }
        $collab::findOrFail($id);
		return response()->json($collab);
    }

    public function addCollaborator(Request $request){
        
        $validator = Validator::make(request()->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'login' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'The name attribute is required!',
            ]);
        }

        $collab = new User();
        $collab = User::forceCreate(request()->all())->syncRoles('collaborator');
        $collab->password = Hash::make($collab->password);
        $collab->save();
        return response()->json([
            'message' => 'Added !'
        ]);
    }

    public function updateCollaborator(Request $request, $id){

        $collab = User::find($id);
        $collab->update(array_filter(request()->all()));
        return response()->json([
            'message' => 'Updated !'
        ]);
    }

    public function removeCollaborator($id){
        $collab = User::find($id);
        $collab->removeRole('collaborator');
        $collab->forceDelete();
    }

    public function archiveCollaborator($id){
        $collab = User::find($id);
        $collab->removeRole('collaborator');
        $collab->Delete();
    }

    public function showArchive(){
        $archive = User::onlyTrashed()->get();
        return response()->json($archive);
    }
}
