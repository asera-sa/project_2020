<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institution;


class InstitutionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. إنشاء مؤسسة تجريبية
        $institution = Institution::create([
            'name' => 'شركة التجربة',
            'type' => 'private',
            'status' => 'under_review',
        ]);

        // 2. ملفات تجريبية من مجلد التخزين (تأكد أنها موجودة فعليًا)
        $documents = [
            ['file' => 'site_map.pdf', 'type' => 'site_map'],
            ['file' => 'company_license.pdf', 'type' => 'company_license'],
            ['file' => 'commercial_register.pdf', 'type' => 'commercial_register'],
            ['file' => 'payment_receipt.pdf', 'type' => 'payment_receipt'],
        ];

        foreach ($documents as $doc) {
            $filePath = storage_path("app/public/test-docs/{$doc['file']}");

            if (file_exists($filePath)) {
                $institution->addMedia($filePath)
                    ->withCustomProperties([
                        'type' => $doc['type'],
                        'status' => 'pending',
                        'reason' => null,
                    ])
                    ->preservingOriginal()
                    ->toMediaCollection('documents');

                echo "✅ أضيفت الوثيقة: {$doc['file']}\n";
            } else {
                echo "❌ الملف مش موجود: {$doc['file']}\n";
            }
        }
    }
}
