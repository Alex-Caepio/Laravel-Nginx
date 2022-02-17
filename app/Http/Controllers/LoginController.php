<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ValidateRegistration;

class LoginController extends Controller
{
    /*public function register(ValidateRegistration $request)
    {
        $user = User::create($request->validated());

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['accessToken'=>$accessToken], 201);
    }*/

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function store(ValidateRegistration $request)
    {
        $data = [];
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $this->userService->createUser($data);
        return response(["token" => $this->userService->token], 201);

    }

         
}


    

