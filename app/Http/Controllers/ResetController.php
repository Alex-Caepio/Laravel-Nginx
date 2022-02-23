<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Mail\SendMailreset;
use App\Models\Reset;
use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetController extends Controller
{
    public function sendEmail(ResetPassword $request)
    {
        $email = $request['email'];
        $user = User::where('email', $email);
        $reset = Reset::where('email', $email)->first();

        if ($reset && $reset->created_at->copy()->addHours(2)->isPast()) {
            $reset->delete();
            $reset = false;
        }

        if (!$reset) {
            $token = Str::random(40);
            $reset->token = $token;
            $reset->email = $email;
            //$reset->save();

            Mail::to($email)->send(new SendMailreset($reset->token, $email));

            return $this->successResponse();
        }
    }
        public function successResponse()
    {
        return response()->json([
            'data' => 'Reset Email is send successfully, please check your inbox.'
        ], Response::HTTP_OK);
    }


}
