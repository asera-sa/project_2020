<?php

namespace App\Http\Requests\User;

use App\Enums\UserScope;

use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_name' => ['required', 'string', 'max:255','unique:users','regex:/^(?=.*[a-zA-Z])[a-zA-Z0-9._-]+$/'],
            'image_profile' => ['nullable', 'file', 'image', 'mimes:jpeg,jpg,png,gif'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required','string','regex:/^0(9[1-6]\d{7})$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'scope' => ['required', new Enum(UserScope::class)],
            // 'last_login' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'حقل البريد الإلكتروني مطلوب.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صالح.',
            'email.unique' => 'هذا البريد الإلكتروني موجود بالفعل.',
            'name.regex' => 'الاسم يكون بالحروف الانجليزية وبدون مسافات',
        ];
    }
}
