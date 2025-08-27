<?php

return [
    'entities' => [
        'user' => 'المستخدم',
        'course' => 'الدورة التدريبية',
        'category' => 'القسم',
        'group' => 'المجموعة',
        'entity' => 'الجهة الخارجية',
        'centre' => 'مزود الخدمة',
        'employee' => 'الموظف',
        'department' => 'الإدارة',
        'section' => 'القسم',
        'specialty' => 'التخصص',
        'message' => 'المراسلة',
        'subscription' => 'قائمة اشتراك',

    ],

    'alerts' => [
        'success' => [
            'title' => 'نجحت العملية!',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="w-6 h-6 text-green-600"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
        ],
        'error' => [
            'title' => 'حدث خطأ!',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="w-6 h-6 text-red-600"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>',
        ],
        'warning' => [
            'title' => 'تحذير!',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-yellow-500"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>'
        ],
        'messages' => [
            'defaults' => [
                'create' => 'أتمت العملية بنجاح',
            ],

            'wrong' => 'حدث خطأ ما!',
            'saved' => 'تم الحفظ.',

            'create' => 'أُضيف ملف :entity <span class="font-semibold text-primary-600"> :name </span> بنجاح.',
            'update' => 'عُدل ملف :entity <span class="font-semibold text-primary-600"> :name </span> بنجاح.',
            'archive' => 'أُرشف ملف :entity <span class="font-semibold text-primary-600"> :name </span> بنجاح.',
            'delete' => 'حُذف ملف :entity <span class="font-semibold text-primary-600"> :name </span> بنجاح.',
            'restore' => 'أُسترجع ملف :entity <span class="font-semibold text-primary-600"> :name </span> بنجاح.',
            'force_delete' => 'حُذف ملف :entity <span class="font-semibold text-primary-600"> :name </span> نهائياً بنجاح.',
            'state_update' => 'عُدلت حالة ملف :entity <span class="font-semibold text-primary-600"> :name </span> بنجاح.',
            'media_delete' => 'حُذف المُرفق بنجاح.',
            'update_profile' => 'عُدلت بيانات الحساب بنجاح',
            'update_password' => 'عُدلت كلمة مرور الحساب بنجاح',
        ]
    ]
];
