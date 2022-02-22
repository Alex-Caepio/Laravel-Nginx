<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\ForgotMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ResetRequest;
use App\Http\Requests\ForgotRequest;
use App\Models\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotController extends Controller
{
    public function forgot(ForgotRequest $request, ForgotMail $email)
    {
        $email = $request->input('email');

        if(User::where('email', $email)->doesntExist()){
            return response([
                'message' => "User doesn't exist"
            ], 404);
        }

        $token = Str::random(10);

        try {
            DB::table('reset_password')->insert([

                'token' => $token
            ]);

            
            Mail::to($request->email)->send(new ForgotMail($token));

            /*Mail::send('mails.forgot', ['token' => $token], function(Message $message){
                $message->to($email);
                $message->subject('Reset your password');
            });*/

            return response([
                'message' => 'Check your email!'
            ]);

        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function reset(ResetRequest $request)
    {
        $token = $request->input('token');

        if(!$passwordResets = DB::table('reset_password')->where('token', $token)->first())
        {
            return response([
                'message' => 'Invalid token!'
            ], 400);
        }

        if(!$user = User::where('id', $passwordResets->user_id)->first()){
            return response([
                'message' => 'User doesnt exist'
            ], 404);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response([
            'message' => 'success'
        ]);
    }

}
