<?php

namespace App\Http\Controllers;

use App\Models\Reset;
use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
   public function resetPassword(UpdatePasswordRequest $request)
    {
        $token = $request->input('token');

        $user = new User();
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response([
            'message' => 'Success!'
        ], 200);
    }
}



