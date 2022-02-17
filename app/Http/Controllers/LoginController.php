<?php

namespace App\Http\Controllers\Api\V1;

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

    public function register(ValidateRegistration $request, array $data)
    {
        $request->email = $data['email'];
        $request->password = $data['password'];
        $request->password_confirmation = $data['password_confirmation'];

    }

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(UserService $userService, array $data)
    {
        $userService->createUser($data);
    }

}


    

