<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AuthController extends Controller
{

    public function register(Request $request){
        $fileds = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed',
        ]);
        $user = User::create([
            'name'=>$fileds['name'],
            'email'=>$fileds['email'],
            'password'=>bcrypt($fileds['password']),
        ]);

        $token = $user->createToken('userToken')->plainTextToken;
        $resonse =[
            "user"=>$user,
            "user Token"=>$token
        ];
        return response($resonse,201);
    }


    public function login(Request $request){
        $fileds = $request->validate([

            'email'=>'required|string',
            'password'=>'required|string'
        ]);
        $user = User::where('email',$fileds['email'])->first();
            if(!$user || !Hash::check($fileds['password'], $user->password)){
                return response([
                    "message"=>"wrong password|| User name",
                ],401);
            }

        $token = $user->createToken('userToken')->plainTextToken;
        $resonse =[
            "user"=>$user,
            "user Token"=>$token
        ];
        return response($resonse,201);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return [
            "message"=>"Logout Done"
        ];
    }

}
