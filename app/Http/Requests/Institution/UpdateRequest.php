<?php

namespace App\Http\Requests\Institution;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'type' => 'required|in:public,private',

            'site_map' => 'nullable|file|mimes:pdf|max:10240',
            'site_safety_plan' => 'nullable|file|mimes:pdf|max:10240',
        ];

        if ($this->input('type') === 'public') {
            $rules['safety_request'] = 'nullable|file|mimes:pdf|max:10240';
            $rules['committee_decision'] = 'nullable|file|mimes:pdf|max:10240';
        }

        if ($this->input('type') === 'private') {
            $rules += [
                'specialization_request' => 'nullable|file|mimes:pdf|max:10240',
                'legal_file' => 'nullable|file|mimes:pdf|max:10240',
                'company_license' => 'nullable|file|mimes:pdf|max:10240',
                'commercial_register' => 'nullable|file|mimes:pdf|max:10240',
                'chamber_of_commerce' => 'nullable|file|mimes:pdf|max:10240',
                'company_bylaws' => 'nullable|file|mimes:pdf|max:10240',
                'payment_receipt' => 'nullable|file|mimes:pdf|max:10240',
            ];
        }

        return $rules;
    }
}
