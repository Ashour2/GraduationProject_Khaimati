@extends('representative.reports.pdf.layout')

@section('report_title', 'تقرير المخيم')

@section('report_content')
    <table>
        <tr>
            <th>اسم المخيم</th>
            <td>{{ $camp->name }}</td>
        </tr>
        <tr>
            <th>المحافظة</th>
            <td>{{ $camp->governorate ?? '---' }}</td>
        </tr>
        <tr>
            <th>الموقع</th>
            <td>{{ $camp->location ?? '---' }}</td>
        </tr>
        <tr>
            <th>الحالة</th>
            <td>{{ $camp->status == 'active' ? 'نشط' : 'غير نشط' }}</td>
        </tr>
        <tr>
            <th>عدد العائلات المسجّلة</th>
            <td>{{ $familiesCount }}</td>
        </tr>
        <tr>
            <th>إجمالي الأفراد</th>
            <td>{{ $membersCount }}</td>
        </tr>
    </table>
@endsection
