<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticatedController extends Controller
{    
    public function store(CreateLoginRequest $request)
    {
        try {
            // $user = User::where('email', $request->email)->first();

            // if (! $user || ! Hash::check($request->password, $user->password)) {
            //     throw new \Exception(trans('auth.failed'), Response::HTTP_UNAUTHORIZED);
            // }

            if (! auth()->attempt($request->validated())) {
                throw new \Exception(trans('auth.failed'), Response::HTTP_UNAUTHORIZED);
            }

            $user = auth()->user();
 
            return response()->json([
                'data' => new UserResource($user),
                'token_type' => 'Bearer',
                'access_token' => $user->createToken(config('app.name'))->plainTextToken,
                'message' => 'User created successfully.',
            ], Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }
    }
}
