<?php

namespace App\Http\Controllers;

use App\Mail\DeleteMail;
use App\Mail\SendMailreset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Barryvdh\DomPDF\Facade\Pdf;


class DeleteController extends Controller
{
    public function destroy(User $user)
    {
        if(Gate::allows('auth-user', $user))
        {
            $user->update([
                'status' => User::INACTIVE
                ]);

            $email = $user->email;
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML('<h1>Testasdfsdafdsafsdafadsfasfsfdadsfadsf</h1>');

            Mail::to($email)->send(new DeleteMail($pdf));

            return response(null, Response::HTTP_NO_CONTENT);
        }
        return response()->json([
            'message' => 'Something went wrong'], 403);
    }
}
