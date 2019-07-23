<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
class Authenticationcontroller extends Controller
{






	 function register(request $request){
  	
 
		 	$validator = Validator::make($request->all(), [
		             "username" =>  "required",
		     		 'email' => 'required|string|email|max:255|unique:users',
		     		 'password' => 'required|string|min:6|'
		       ]);
		        
		       if ($validator->fails()) {
		          
		            return $validator->messages();
		       }
		       else {
		        $user = new User;
		    if(isset($request->level)){
		    $user->level = $request->level;

		    }
		    $user->username = $request->username;
		    $user->email = $request->email;
		    $user->password = bcrypt($request->password);
		    $user->save();

		  
		    $response['code'] = 200;
		    $response['user'] = $user;
		    return response()->json($response ,200);
		       }
	}

  }
