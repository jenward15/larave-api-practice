<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function store(CreateUserRequest $request)
    {
        try {
            $user = User::create($request->validated());

            return response()->json([
                'data' => new UserResource($user),
                'message' => 'User created successfully.',
            ], Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
