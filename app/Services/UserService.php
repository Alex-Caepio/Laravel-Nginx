<?php

namespace App\Services;

use App\Http\Requests\ValidateRegistration;
use App\Models\User;

class UserService {

    public function createUser(array $data){

        $user = User::create($data);
        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['accessToken'=>$accessToken], 201);
    }
    
}

