<x-admin-layout>
    <x-slot name="slot">
        <div class="grid grid-cols-12 gap-4">

            <!-- Main Content -->
            <section class="order-last col-span-full md:col-span-9 md:order-first">
                <x-panel>
                    <x-slot name="heading">
                        <h2 class="text-base font-medium">{{ __('تقرير إحصائي') }}</h2>
                    </x-slot>

                    <x-slot name="slot">
                        <div class="space-y-4">
                            <!-- الإحصائيات -->
                            <div class="grid grid-cols-2 gap-4 text-center md:grid-cols-3">
                                <div class="p-4 bg-white rounded shadow">
                                    <div class="text-sm text-gray-500">إجمالي الطلبات</div>
                                    <div class="text-lg font-bold">{{ $total }}</div>
                                </div>
                                <div class="p-4 bg-green-100 rounded shadow">
                                    <div class="text-sm text-gray-500">الطلبات الفعالة</div>
                                    <div class="text-lg font-bold">{{ $active }}</div>
                                </div>
                                <div class="p-4 bg-red-100 rounded shadow">
                                    <div class="text-sm text-gray-500">الطلبات المرفوضة</div>
                                    <div class="text-lg font-bold">{{ $expired }}</div>
                                </div>
                                <div class="p-4 bg-yellow-100 rounded shadow">
                                    <div class="text-sm text-gray-500">الطلبات المعلقة</div>
                                    <div class="text-lg font-bold">{{ $suspended }}</div>
                                </div>
                            </div>

                            <!-- جدول آخر الطلبات -->
                            <div class="overflow-auto" id="print-area">
                                <table class="w-full border-collapse table-auto">
                                    <thead>
                                        <tr class="text-right bg-gray-100">
                                            <th class="px-3 py-2">#</th>
                                            <th class="px-3 py-2">المصلحة</th>
                                            <th class="px-3 py-2">الحالة</th>
                                            <th class="px-3 py-2">السبب</th>
                                            <th class="px-3 py-2">تاريخ الإنشاء</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($latestRequests as $request)
                                            <tr class="border-b">
                                                <td class="px-3 py-2 font-mono">{{ $loop->iteration }}</td>
                                                <td class="px-3 py-2">{{ $request->institution->name }}</td>
                                                <td class="px-3 py-2">{{ $request->state->getName() }}</td>
                                                <td class="px-3 py-2">{{ $request->reason ?? '---' }}</td>
                                                <td class="px-3 py-2">{{ $request->created_at->format('Y-m-d') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="py-4 text-center">لا توجد طلبات حالية.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </x-slot>
                </x-panel>
            </section>

            <!-- الشريط الجانبي -->
            <aside class="space-y-4 col-span-full md:col-span-3">

                <!-- زر طباعة الجدول باستخدام جافاسكريبت -->
                <button onclick="printTable()" class="justify-center w-full px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                    <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 9V2h12v7m0 4h2a2 2 0 012 2v5h-6v-4H8v4H2v-5a2 2 0 012-2h2m0 0v4h12v-4"></path>
                    </svg>
                    طباعة  التقرير
                </button>
            </aside>

        </div>

       <!-- سكربت الطباعة -->
        <script>
            function printTable() {
                const tableContent = document.querySelector('#print-area').innerHTML;

                const printWindow = window.open('', '', 'width=800,height=600');

                printWindow.document.write(`
                    <html dir="rtl" lang="ar">
                    <head>
                        <x-dashboard-logo side="" />
                        <title>تقرير الطلبات</title>
                        <style>
                            body { font-family: 'Arial', sans-serif; padding: 20px; }
                            .header { text-align: center; margin-bottom: 30px; }
                            .header img { height: 80px; margin-bottom: 10px; }
                            h1 { margin: 0; font-size: 22px; }
                            table { width: 100%; border-collapse: collapse; direction: rtl; text-align: right; }
                            th, td { border: 1px solid #ddd; padding: 8px; }
                            th { background-color: #f3f3f3; }
                            tr:nth-child(even) { background-color: #f9f9f9; }
                        </style>
                    </head>
                    <body>
                        <div class="header">
                            <x-dashboard-logo side="" />
                            <h1>تقرير الطلبات</h1>
                        </div>
                        ${tableContent}
                    </body>
                    </html>
                `);

                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();
            }
        </script>

    </x-slot>
</x-admin-layout>
