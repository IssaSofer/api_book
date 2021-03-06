<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;


class APILogincontroller extends Controller
{
    //
    public function login(Request $request)
    {
    	$validator = Validator::make($request -> all(), [

    		'email' => 'required|string|email|max:255|',
    		'password' => 'required'
    		]);

    	if($validator -> fails()){
    		return response()->json($validator->errors());
    	}
    	$credentials = $request->only('email', 'password');

    	try{
    		if(!$token =JWTAuth::attempt($credentials)){
    			return response()->json(['error'=>'Invalied user and password'],[401]);
    		}
    	}
    	catch(JWTException $e){
    		return response()->json(['error'=>'Could not create token'],[500]);
    	}

    	return response()->json(compact('token'));
    }
}
