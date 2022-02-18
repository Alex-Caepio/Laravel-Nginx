<?php

namespace App\Services;

use App\Models\User;

class UserService {

    public $token;

    public function createUser(array $data){

        $user = User::create($data);

        $this->token = $user->createToken('authToken')->accessToken;
               
    }     
     
}
    

