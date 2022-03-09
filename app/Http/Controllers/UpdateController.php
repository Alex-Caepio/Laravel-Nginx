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
        if(Gate::allows('auth-user', $user))
        {
            $this->service->updateAuth($request);

            return response()->json([
                'message' => 'Success'], 202);
        }
            return response()->json([
            'message' => 'Page Not Found'], 422);

    }
}
