<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:64'],
            'last_name' => ['required', 'string', 'max:64'],
            'email' => ['required', 'email:rfc,dns,spoof', Rule::unique(User::class, 'email')],
            'password' => ['required', 'string', Password::min(8)],
            'birthdate' => ['required', 'date_format:m/d/Y'],
            'address' => ['required', 'string', 'max:200'],
        ];
    }
}
