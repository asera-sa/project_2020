<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum UserScope: string
{
    case ADMINISTRATOR = 'administrator'; // مدير النظام
    case INSPECTION_OFFICE_MANAGER = 'inspection_office_manager'; // مدير مكتب التفتيش
    case INSPECTOR = 'inspector'; // مفتش
    case SETTLEMENT_UNIT_EMPLOYEE = 'settlement_unit_employee'; // موظف وحدة الاستيفاء
    case INSTITUTION_OWNER = 'institution_owner'; // مالك المؤسسة
    public function getName()
    {
        return __('app.enums.user_scopes.' . $this->value);
    }

    public static function values(): Collection
    {
        return collect(self::cases())->filter(fn ($case) => $case !== self::ADMINISTRATOR);
    }
}
