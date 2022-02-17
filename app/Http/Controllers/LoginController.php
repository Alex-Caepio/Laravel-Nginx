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
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function store(ValidateRegistration $request, User $user)
    {
        $data = [];
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $data['token'] = $user->createToken('token')->accessToken;
        
        $this->userService->createUser($data);
        
        return response(['token'=>$data['token']], 201);

        
    }

         
}


    

