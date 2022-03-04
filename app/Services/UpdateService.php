<?php

namespace App\Services;

use App\Models\User;

class UpdateService
{
    public function updateAuth(array $data)
    {
        User::update($data);

    }
}
