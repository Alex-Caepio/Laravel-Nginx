<?php

namespace App\Services;

use App\Http\Requests\UpdateRequest;
use App\Models\User;

class UpdateService
{
    public function updateAuth($user, array $data)
    {
        $update = [];

        if (!empty($data['email']))
        {
            $update['email'] = $data['email'];
        }
        if (!empty($data['password']))
        {
            $update['password'] = $data['password'];
        }

        $user->fill($update);

        $user->save();
    }
}
