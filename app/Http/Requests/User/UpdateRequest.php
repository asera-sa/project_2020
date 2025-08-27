<?php

namespace App\Http\Requests\User;
use App\Enums\UserScope;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_name' => ['required', 'string', 'max:255',Rule::unique('users')->ignore($this->user),'regex:/^(?=.*[a-zA-Z])[a-zA-Z0-9._-]+$/'],
            'image_profile' => ['nullable', 'file', 'image', 'mimes:jpeg,jpg,png,gif'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'phone' => ['required', 'string', 'max:255'],
            'scope' => ['required', new Enum(UserScope::class)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }
}
