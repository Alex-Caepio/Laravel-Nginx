<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ValidateRegistration;

class UserService {

    public $token;

    public function createUser(array $data){

        User::create($data);

        /**/
    }     
    public function newToken(User $user){
        $accessToken = $user->createToken('authToken')->accessToken;

        //return response(['accessToken'=>$accessToken], 201);
        return $this->token = $accessToken;

    }

    
}
    

