<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Requests\Users\LoginUserValidator;
use App\Requests\Users\CreateUserValidator;


class AuthController extends BaseController
{
    public  $UserService;
    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }
    public function register(CreateUserValidator $createUserValidator)
    {
       if(!empty($createUserValidator->getErrors()))
       {
           return $this->sendResponse($createUserValidator->getErrors(),false,406);
       }
       $user = $this->UserService->CreateUser($createUserValidator->request()->all());
       $message['user']=$user;
       $message['token'] =  $user->createToken('MyApp')->plainTextToken;
       return $this->sendResponse($message,true,200);
    }
    public function login(LoginUserValidator $loginUserValidator)
    {
        if(!empty($loginUserValidator->getErrors()))
        {
            return $this->sendResponse($loginUserValidator->getErrors(),false,406);
        }
        $request = $loginUserValidator->request();
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],true)){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            return $this->sendResponse($success,true,200);
        }else{
            return $this->sendResponse('Unauthorised',false,401);
        }
    }
    public function logout()
    {
        Auth::user()->tokens()->delete();
        return $this->sendResponse('Logged out',true,200);
    }
}
