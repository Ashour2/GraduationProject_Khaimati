<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        * { font-family: 'DejaVu Sans', sans-serif; }
        body { direction: rtl; color: #222; font-size: 12px; }
        .header {
            text-align: center;
            border-bottom: 3px solid #3b2f8f;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 { color: #3b2f8f; margin: 0; font-size: 22px; }
        .header p { margin: 4px 0; color: #555; font-size: 12px; }
        .report-title {
            background: #3b2f8f;
            color: #fff;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 15px;
            margin-bottom: 16px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            text-align: right;
            font-size: 11px;
        }
        th { background: rgba(58, 45, 135, 0.12); color: #3b2f8f; }
        tr:nth-child(even) td { background: #f7f7fb; }
        .info-row { margin: 6px 0; }
        .info-label { font-weight: bold; color: #3b2f8f; }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #888;
            border-top: 1px solid #ddd;
            padding-top: 8px;
        }
        .section-title {
            font-size: 14px;
            color: #3b2f8f;
            font-weight: bold;
            margin: 16px 0 8px;
            border-right: 4px solid #3b2f8f;
            padding-right: 8px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>خيمتي</h1>
        <p>نظام إدارة مخيمات اللاجئين</p>
        <p>المخيم: {{ $camp->name ?? '---' }} — المحافظة: {{ $camp->governorate ?? '---' }}</p>
    </div>

    <div class="report-title">@yield('report_title')</div>

    @yield('report_content')

    <div class="footer">
        تم إنشاء هذا التقرير بتاريخ {{ now()->format('Y-m-d H:i') }} — خيمتي
    </div>
</body>
</html>
