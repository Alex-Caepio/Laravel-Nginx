<?php

namespace App\Services;

use App\Http\Requests\UpdateRequest;
use App\Models\User;

class UpdateService
{
    public function updateAuth(array $data)
    {
        User::update($data);

        $request = new UpdateRequest();

        if (empty($request->input('email')))
        {
            dd('Email is empty');
        }

        if (empty($request->input(bcrypt('password'))))
        {
            dd('Password is empty');
        }



    }
}
