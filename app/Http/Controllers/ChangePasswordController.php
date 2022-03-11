<?php

namespace App\Http\Controllers;

use App\Models\Reset;
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
        $reset = Reset::where('token', $token)->first();
        $password = Hash::make($request->input('password'));
        User::where('email', $reset->email)
            ->update(['password' => $password]);

        echo('updated');
    }
}






