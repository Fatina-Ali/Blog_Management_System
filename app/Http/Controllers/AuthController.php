<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\ResponseCodeEnum;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Services\AuthService;
use App\Http\Resources\UserResource;
use App\Enums\LoginUserEnum;

class AuthController extends Controller
{


    public function register(RegisterUserRequest $request){

        try{
            $res = AuthService::registerUser($request->user_name, $request->first_name,$request->last_name,$request->email, $request->password,
            $request->profile_photo);

            return $this->successResponse(new UserResource($res));
        }

        catch(\Exception $e){
            return $this->errorResponse('An unexpected error occurred' , ResponseCodeEnum::Internal_Server_Error);
        }
    }


    ////login user
    public function login(LoginUserRequest $request){

        try{
            $res=AuthService::loginUser($request->email,$request->password);

            if($res==LoginUserEnum::WRONG_PASSWORD){
                return $this->errorResponse('Wrong password' , ResponseCodeEnum::Bad_request);
            }
            return $this->successResponse(new UserResource($res));
        }

        catch(\Exception $e){
            return $this->errorResponse('An unexpected error occurred' , ResponseCodeEnum::Internal_Server_Error);
        }

    }

    public function logout(){
        try{
            $res=AuthService::logoutUser();
            return $this->successResponse([],'Logged out Successfully');
        }

        catch(\Exception $e){
            return $this->errorResponse('An unexpected error occurred' , ResponseCodeEnum::Internal_Server_Error);
        }
    }
}
