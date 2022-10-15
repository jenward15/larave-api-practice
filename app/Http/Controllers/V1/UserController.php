<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\ListUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(ListUserRequest $request)
    {
        try {
            $users = User::paginate($request->per_page ?? 10);

            return UserResource::collection($users);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

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

    public function show(User $user)
    {
        return response()->json([
            'data' => new UserResource($user),
            'message' => 'User retrieved successfully.',
        ], Response::HTTP_OK);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->update($request->validated());

            return response()->json([
                'data' => new UserResource($user),
                'message' => 'User updated successfully.',
            ], Response::HTTP_ACCEPTED);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();

            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
