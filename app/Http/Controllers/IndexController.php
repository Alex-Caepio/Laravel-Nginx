<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Http\Resources\PersonResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class IndexController extends Controller
{
    public function index()
    {
        $collection = collect(User::all());

        $plucked = $collection->pluck('email');

        return $plucked->all();
    }

    public function person(User $user)
    {
        if(Gate::allows('auth-user', $user))
        {
            return new PersonResource($user);
        }
            return response()->json([
            'message' => 'Something went wrong!'], 403);
    }
}
