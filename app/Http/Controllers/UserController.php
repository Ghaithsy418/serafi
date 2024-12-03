<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function Register(UserRequest $request){
        $user = User::create(attributes: [
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);

        $token = $user->createToken("myToken")->plainTextToken;

        $data = [$user,$token];

        return response($data,201);
    }

    public function Login(Request $request){
        $data = $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $user = User::where("email",$data["email"])->first();

        if(!$user || !Hash::check($data["password"],$user->password)){
            return response([
                "message" => "bad Datas",
            ],200);
        }

        $token = $user->createToken("myToken")->plainTextToken;

        $response = [$user,$token];

        return response($response,200);

    }

    public function Logout(Request $request){
        $accessToken = $request->bearerToken();
        $token = PersonalAccessToken::find($accessToken);
        $token->delete();



        return [
            "message" => "you logged out Successfully"
        ];
    }
}
