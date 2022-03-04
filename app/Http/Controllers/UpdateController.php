<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use App\Models\User;
use App\Services\UpdateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UpdateController extends Controller
{
    protected $service;

    public function __construct(UpdateService $service)
    {
        $this->service = $service;
    }

    public function update(UpdateRequest $request, User $user)
    {
        $data = [];
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);

        if(Gate::allows('auth-user', $user))
        {
            $this->service->updateAuth($data);
        }
        return response()->json([
            'message' => 'Page Not Found'], 422);
    }
}
