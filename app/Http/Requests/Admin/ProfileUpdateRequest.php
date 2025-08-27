<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_name' => ['required', 'string', 'max:255',Rule::unique('users')->ignore($this->user),'regex:/^(?=.*[a-zA-Z])[a-zA-Z0-9._-]+$/'],
            'image_profile' => ['nullable', 'file', 'image', 'mimes:jpeg,jpg,png,gif'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'phone' => ['required', 'string', 'max:255'],
            // 'scope' => ['required', new Enum(UserScope::class)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            ];
    }
}
