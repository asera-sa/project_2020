<?php

return [

    'states' => [
            'user' => [
                'active' => 'مُفعّل',
                'inactive' => 'مُعطّل',

                'actions' => [
                    'active' => 'تفعيل',
                    'inactive' => 'تعطيل',
                ],
            ],

            
            'request_state' => [
                'pending_review' => 'بانتظار وحدة الاستيفاء',
                'under_inspection_office_review' => 'قيد إحالة مكتب التفتيش',
                'rejected' => ' تم رفض',
                'assigned_to_inspector' => 'تم تحويلها إلى مفتش',
                'reviewed_by_inspector' => 'تمت المراجعة من قبل المفتش',
                'issuing_license' => 'جاري إصدار الرخصة',
                'completed' => 'مكتملة',

                'actions' => [
                    'pending_review' => 'أرسل للاستيفاء',
                    'under_inspection_office_review' => 'تحويل لمكتب التفتيش',
                    'rejected' => ' الرفض',
                    'assigned_to_inspector' => 'عين مفتش',
                    'reviewed_by_inspector' => 'مراجعة المفتش',
                    'issuing_license' => 'إصدار الرخصة',
                    'completed' => 'إنهاء الطلب',
                ]
            ]
            

        ],


    'enums' => [

        'user_scopes' => [
            'administrator' => 'مدير النظام',
            'inspection_office_manager' => 'مدير مكتب التفتيش',
            'inspector' => 'المفتش',
            'settlement_unit_employee' => 'وحدة الاستيفاء',
            'institution_owner' => 'صاحب مصلحة',
        ],
    ],
];
