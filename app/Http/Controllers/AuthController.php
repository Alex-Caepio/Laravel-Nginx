<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userService;

    public function login(AuthRequest $request)
    {
        $data = [];
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        
        if(Auth::attempt($data))
        {
            $user = Auth::user();
            $token = $user->createToken('token')->accessToken;
            return response()->json(['token' => $token], 200);
            
        } else{
            return response()->json([
                'message' => 'Page Not Found'], 404);
        }
    }
}
