<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: dejavusans; direction: rtl; font-size: 13px; color: #222; }
        .header { text-align: center; border-bottom: 3px solid #3a2d87; padding-bottom: 15px; margin-bottom: 25px; }
        .system-name { font-size: 24px; font-weight: bold; color: #3a2d87; }
        .report-title { font-size: 20px; font-weight: bold; margin-top: 10px; }
        .section { margin-top: 25px; }
        .section-title { background: #3a2d87; color: white; padding: 10px; font-weight: bold; }
        .info-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .info-table td { border: 1px solid #ddd; padding: 10px; }
        .label { background: #f3f1fb; font-weight: bold; width: 30%; }
        .footer { margin-top: 35px; padding-top: 12px; border-top: 1px solid #ddd; text-align: center; color: #777; font-size: 11px; }
    </style>
</head>
<body>

<div class="header">
    <div class="system-name">خيمتي</div>
    <div class="report-title">تقرير حالة مخيم</div>
    <div>تاريخ إنشاء التقرير: {{ now()->format('Y-m-d') }}</div>
</div>

<div class="section">
    <div class="section-title">بيانات المخيم</div>
    <table class="info-table">
        <tr><td class="label">اسم المخيم</td><td>{{ $camp->name }}</td></tr>
        <tr><td class="label">المحافظة</td><td>{{ $camp->governorate }}</td></tr>
        <tr><td class="label">العنوان</td><td>{{ $camp->location }}</td></tr>
        <tr><td class="label">عدد العائلات</td><td>{{ $camp->families_count }}</td></tr>
        <tr><td class="label">الحالة</td><td>{{ $camp->status }}</td></tr>
    </table>
</div>

<div class="section">
    <div class="section-title">مندوب المخيم</div>
    <table class="info-table">
        <tr><td class="label">الاسم</td><td>{{ $camp->representative?->name ?? 'لا يوجد' }}</td></tr>
        <tr><td class="label">الهاتف</td><td>{{ $camp->representative?->phone ?? '---' }}</td></tr>
        <tr><td class="label">البريد الإلكتروني</td><td>{{ $camp->representative?->email ?? '---' }}</td></tr>
    </table>
</div>

<div class="footer">
    تم إنشاء هذا التقرير بواسطة منصة خيمتي لإدارة المخيمات
</div>

</body>
</html>