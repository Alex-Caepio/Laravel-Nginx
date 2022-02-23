<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Reset;
use App\Models\ResetPassword;
use App\Models\User;
use App\Mail\SendMailreset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PasswordResetRequestController extends Controller
{
    public function sendEmail(UpdatePasswordRequest $request)
    {
        $email = $request['email'];
        $user = User::where('email', $email)->get();
        if (!$request->email) {
            return $this->failedResponse();
        }
        $this->send($request->email);
        return $this->successResponse();
    }

    public function send($email)
    {
        $token = $this->createToken($email);
        Mail::to($email)->send(new SendMailreset($token, $email));
    }

    public function createToken($email, UpdatePasswordRequest $request)
    {
        $email = $request['email'];
        $reset = Reset::where('email', $email)->first();

        if ($reset) {
            return $reset['token'];
        }

        $token = Str::random(40);
        $reset['token'] = $token;
        $reset['mail'] = $email;

        return $token;
    }


   /* public function saveToken($token, $email)
    {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    }*/

   /* public function validateEmail($email)
    {
        return User::where('email', $email)->first();
    }*/

    public function failedResponse()
    {
        return response()->json([
            'error' => 'Email doesnt found on our database'
        ], Response::HTTP_NOT_FOUND);
    }

    public function successResponse()
    {
        return response()->json([
            'data' => 'Reset Email is send successfully, please check your inbox.'
        ], Response::HTTP_OK);
    }
}
