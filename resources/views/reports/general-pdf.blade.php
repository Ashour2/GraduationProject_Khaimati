<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: dejavusans;
            direction: rtl;
            font-size: 13px;
            color: #222;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #3a2d87;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .system-name {
            font-size: 24px;
            font-weight: bold;
            color: #3a2d87;
        }

        .report-title {
            font-size: 20px;
            font-weight: bold;
            margin-top: 10px;
        }

        .date {
            font-size: 12px;
            color: #666;
            margin-top: 8px;
        }

        .stats {
            width: 100%;
            margin-bottom: 25px;
        }

        .stat-box {
            border: 1px solid #ddd;
            background-color: #f3f1fb;
            padding: 14px;
            text-align: center;
            border-radius: 8px;
        }

        .stat-number {
            font-size: 22px;
            font-weight: bold;
            color: #3a2d87;
        }

        .stat-label {
            font-size: 12px;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background-color: #3a2d87;
            color: white;
            padding: 10px;
            font-size: 12px;
        }

        td {
            border: 1px solid #ddd;
            padding: 9px;
            text-align: center;
            font-size: 12px;
        }

        tr:nth-child(even) td {
            background-color: #f8f8fb;
        }

        .footer {
            margin-top: 35px;
            padding-top: 12px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #777;
            font-size: 11px;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="system-name">خيمتي</div>
    <div class="report-title">التقرير العام للمخيمات</div>
    <div class="date">تاريخ إنشاء التقرير: {{ now()->format('Y-m-d') }}</div>
</div>

<table class="stats">
    <tr>
        <td class="stat-box">
            <div class="stat-number">{{ $camps->count() }}</div>
            <div class="stat-label">عدد المخيمات</div>
        </td>
        <td class="stat-box">
            <div class="stat-number">{{ $camps->sum('families_count') }}</div>
            <div class="stat-label">مجموع العائلات</div>
        </td>
        <td class="stat-box">
            <div class="stat-number">{{ $camps->whereNotNull('representative')->count() }}</div>
            <div class="stat-label">عدد المندوبين</div>
        </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>اسم المخيم</th>
            <th>المندوب</th>
            <th>المحافظة</th>
            <th>عدد العائلات</th>
            <th>الحالة</th>
        </tr>
    </thead>
    <tbody>
        @foreach($camps as $camp)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $camp->name }}</td>
                <td>{{ $camp->representative?->name ?? '-' }}</td>
                <td>{{ $camp->governorate }}</td>
                <td>{{ $camp->families_count }}</td>
                <td>{{ $camp->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    تم إنشاء هذا التقرير بواسطة منصة خيمتي لإدارة المخيمات
</div>

</body>
</html>