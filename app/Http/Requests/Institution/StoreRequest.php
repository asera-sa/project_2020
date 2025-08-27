<?php

namespace App\Http\Requests\Institution;

use App\Enums\UserScope;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // اسمح دائماً بالطلب
    }

        public function rules(): array
        {
            // dd($this->all());
            $rules = [
                'user_name' => ['required', 'string', 'max:255','unique:users','regex:/^(?=.*[a-zA-Z])[a-zA-Z0-9._-]+$/'],
                'image_profile' => ['nullable', 'file', 'image', 'mimes:jpeg,jpg,png,gif'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],

                #............................................................................................

                'name' => 'required|string|max:255',
                'type' => 'required|in:public,private',

            ];

           

    return $rules;
}

}
