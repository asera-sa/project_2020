<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تقرير التراخيص</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url("{{ storage_path('fonts/DejaVuSans.ttf') }}") format('truetype');
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            direction: rtl;
            text-align: right;
            margin: 20px;
            background: #f9f9f9;
        }

        h1, h3 {
            text-align: center;
        }

        .stats {
            margin: 20px 0;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 10px;
        }

        .stat-box {
            background: #e2e8f0;
            padding: 15px;
            border-radius: 6px;
            width: 22%;
            min-width: 150px;
            text-align: center;
        }

        .stat-title {
            font-size: 13px;
            color: #555;
            margin-bottom: 6px;
        }

        .stat-value {
            font-size: 18px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 13px;
        }

        th {
            background-color: #f1f1f1;
        }

        .print-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            background-color: #2563eb;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white;
            }
        }
    </style>
</head>

<body>

    <!-- زر الطباعة -->
    <div class="no-print">
        <button onclick="printReport()" class="print-button">🖨️ طباعة التقرير</button>
    </div>

    <!-- محتوى التقرير -->
    <div id="printableArea">
        <h1>📄 تقرير إحصائي لطلبات التراخيص</h1>

        <div class="stats">
            <div class="stat-box">
                <div class="stat-title">إجمالي الطلبات</div>
                <div class="stat-value">{{ $total }}</div>
            </div>
            <div class="stat-box" style="background-color: #d1fae5;">
                <div class="stat-title">الطلبات الفعالة</div>
                <div class="stat-value">{{ $active }}</div>
            </div>
            <div class="stat-box" style="background-color: #fee2e2;">
                <div class="stat-title">الطلبات المرفوضة</div>
                <div class="stat-value">{{ $expired }}</div>
            </div>
            <div class="stat-box" style="background-color: #fef9c3;">
                <div class="stat-title">الطلبات المعلقة</div>
                <div class="stat-value">{{ $suspended }}</div>
            </div>
        </div>

        <h3>🕓 أحدث الطلبات</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>الحالة</th>
                    <th>السبب</th>
                    <th>تاريخ الإنشاء</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($latestRequests as $request)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $request->state->getName() }}</td>
                        <td>{{ $request->reason ?? '---' }}</td>
                        <td>{{ $request->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- سكربت الطباعة -->
    <script>
        function printReport() {
            var printContents = document.getElementById('printableArea').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload(); // لإرجاع الصفحة لحالتها بعد الطباعة
        }
    </script>

</body>
</html>
