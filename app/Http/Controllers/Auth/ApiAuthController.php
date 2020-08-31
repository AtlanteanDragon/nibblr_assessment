<?php

namespace App\Http\Controllers\Auth;
use App\User;
use App\UserData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ApiAuthController extends Controller
{
    public function register (Request $request){
    	$validator = Validator::make($request->all(), [
    		'name' => 'required|string|max:255',
        	'email' => 'required|string|email|max:255|unique:users',
        	'password' => 'required|string|min:6|confirmed',
    		'street' => 'required|string|max:255',
        	'number' => 'required|string|max:255',
        	'city' => 'required|string|max:255'
    	]);
    	if ($validator->fails())
	        return response(['errors'=>$validator->errors()->all()], 422);
	    $user = User::create([
	    	'name' => $request['name'],
	    	'email' => $request['email'],
	    	'password' => Hash::make($request['password']),
	    	'remember_token' => Str::random(10)
	    ]);
	    $userData = UserData::create([
	    	'street' => $request['street'],
        	'number' => $request['number'],
        	'city' => $request['city'],
        	'user_id' => $user->id
	    ]);
	    $token = $user->createToken('Laravel Password Grant Client')->accessToken;
	    return response(['token' => $token], 200);
	}

	public function login (Request $request) {
	    $validator = Validator::make($request->all(), [
	        'email' => 'required|string|email|max:255',
	        'password' => 'required|string|min:6',
	    ]);
	  
	    error_log('detected email: '.$request->email);
	    error_log('detected password: '.$request->password);
	    
	    if ($validator->fails()){
	    	error_log("validation failed");
	        return response(['errors'=>$validator->errors()->all()], 422);

	    }
	    error_log("retrieve user");
	    $user = User::where('email', $request->email)->first();
	    error_log("user checking");
	    if ($user) {
	    	error_log("user exists");

	        if (Hash::check($request->password, $user->password))
	            return response(["success"=>true, 'token' => $user->createToken('Laravel Password Grant Client')->accessToken, 'user' => $user ], 200);
	        else 
	            return response(["success"=>false, "message" => "Password mismatch"], 422);
	    } else 
	        return response(["success"=>false, "message" =>'User does not exist'], 422);
	}
	public function logout (Request $request) {
	    $token = $request->user()->token();
	    $token->revoke();
	    $response = ['message' => 'You have been successfully logged out!'];
	    return response($response, 200);
	}
	public function edit (Request $request){
		$validator = Validator::make($request->all(), [
    		'name' => 'required|string|max:255',
        	'email' => 'required|string|email|max:255|unique:users',
        	'password' => 'nullable|string|min:6|confirmed',
        	'newpassword' => 'nullable|string|min:6|confirmed',
    		'street' => 'required|string|max:255',
        	'number' => 'required|string|max:255',
        	'city' => 'required|string|max:255'
    	]);
    	if ($validator->fails())
	        return response(['errors'=>$validator->errors()->all()], 422);
    	$user = User::where('id', $request->User()->id);
    	if(Hash::check($request['password'], $user->password) ){
	    	$user->email = $request['email'];
	    	$user->name = $request['name'];
    		if($request['newpassword'] != null)
    			$user->password = Hash::make($request['newpassword']);
    		$user->save();
 			$userData = UserData::where('user_id', $user->id);
 			$userData->street = $request['street'];
 			$userData->number = $request['number'];
 			$userData->city = $request['city'];
 			$userData->save();
 			return response(["status" => "Success"], 200);
    	} else 
    		return response(["message" => "Password mismatch"], 422);
	}
}
