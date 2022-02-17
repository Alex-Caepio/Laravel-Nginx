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
   /* public function createToken(User $user, array $data){
        
       $data['token'] = $user->createToken('authToken')->accessToken;
       
       $this->token = $data['token'];

       return response(['token'=>$data['token']], 201);

    }*/

    
}
    

