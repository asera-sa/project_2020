<?php

namespace App\Http\Requests\License;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        // تأكد أن المستخدم مسموح له ينفذ الطلب
        // إذا ما في تحقق خاص خليها true
        return true;
    }

    public function rules()
    {
        return [
            'license_request_id' => ['required', 'exists:license_requests,id'],
            'issued_at' => ['required', 'date'],
            'expires_at' => ['nullable', 'date', 'after_or_equal:issued_at'],
            'notes' => ['nullable', 'string'],
            'license' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png'], // الملف إجباري
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->filled('issued_at') && !$this->filled('expires_at')) {
            $this->merge([
                'expires_at' => \Carbon\Carbon::parse($this->input('issued_at'))->addMonths(6)->toDateString(),
            ]);
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'يرجى إدخال اسم الترخيص.',
            'institution_id.exists' => 'المصلحة المختارة غير موجودة.',
            'issued_at.date' => 'يرجى إدخال تاريخ إصدار صحيح.',
            'expires_at.date' => 'يرجى إدخال تاريخ انتهاء صحيح.',
            'expires_at.after_or_equal' => 'تاريخ الانتهاء يجب أن يكون مساويًا أو بعد تاريخ الإصدار.',
        ];
    }
}
