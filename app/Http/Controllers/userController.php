<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\User;
class userController extends Controller
{

          public function __construct()
    {
        $this->middleware('auth:api');
       

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth::user();
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

 
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
             "username" =>  "required"
       ]);
        
       if ($validator->fails()) {
          
            return $validator->messages();
       }


       $user = User::findorFail($id);
       $user->username = $request->username;
       $user->save();    
         $responce['code' ] = 200;
         return response()->json($responce,200);
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorFail($id);
        $user->delete();
        $responce['code' ] = 200;
         return response()->json($responce,200);
    }
}
