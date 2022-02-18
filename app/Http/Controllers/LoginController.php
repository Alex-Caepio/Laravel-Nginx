<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateRegistration;

class LoginController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function store(ValidateRegistration $request)
    {
        $data = [];
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
                
        $this->userService->createUser($data);
        
        return response(['token'=>$this->userService->token], 201);
    }
         
}


    

