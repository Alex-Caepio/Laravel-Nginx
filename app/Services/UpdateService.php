<?php

namespace App\Services;

use App\Http\Requests\UpdateRequest;
use App\Models\User;

class UpdateService
{
    public function updateAuth(UpdateRequest $request)
    {
        //$updated = User::where('id', $request->id)->first();
        $user = User::where('id', $request->route('user.id'))->first();

        $user->update([
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();
    }
}
