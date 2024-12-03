<?php

namespace App\Services ;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Enums\LoginUserEnum;
class AuthService{


    public static function registerUser($user_name,$first_name, $last_name, $email,$password,$image){
        $user= User::create([
            'user_name'=>$user_name,
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'email'=>$email,
            'password'=>Hash::make($password),
            'profile_photo'=> ImageService::upload_image($image)


        ]);

        $token=$user->createToken('web user token')->plainTextToken;
        $user['accessToken']=$token;
        return $user;

    }

    ////login user
    public static function loginUser($email, $password){
        $user=User::where('email',$email)->get();

        if (Auth ::attempt(['email' => $email, 'password' => $password])) {

            $user = Auth::user();
            $user->tokens()->where('name', 'web user token')->delete();
            $tokenResult = $user->createToken('web user token');
            $token = $tokenResult->plainTextToken;
            $user['accessToken']=$token;
            return $user;

        };
        return LoginUserEnum::WRONG_PASSWORD;

    }

    public static function logoutUser(){
        auth()->user()->tokens()->where('name', 'web user token')->delete();
        return true;
    }
}
