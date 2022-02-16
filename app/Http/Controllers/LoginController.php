<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function register(ValidateRegistration $request)
    {
        $user = User::create($request->validated());

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['accessToken'=>$accessToken], 201);
    }
}


    

