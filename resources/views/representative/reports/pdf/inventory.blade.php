@extends('representative.reports.pdf.layout')

@section('report_title', 'تقرير المخزون')

@section('report_content')
    <div class="info-row">
        <span class="info-label">عدد الأصناف:</span> {{ $inventory->count() }}
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <span class="info-label">إجمالي المستلم:</span> {{ $inventory->sum('recived_q') }}
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <span class="info-label">إجمالي الموزّع:</span> {{ $inventory->sum('distributed_q') }}
    </div>

    <table>
        <tr>
            <th>#</th>
            <th>اسم الطرد</th>
            <th>الوصف</th>
            <th>الكمية المستلمة</th>
            <th>الكمية الموزّعة</th>
            <th>المتبقي</th>
        </tr>
        @forelse($inventory as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->package_name }}</td>
                <td>{{ $item->description ?? '---' }}</td>
                <td>{{ $item->recived_q }}</td>
                <td>{{ $item->distributed_q }}</td>
                <td>{{ $item->recived_q - $item->distributed_q }}</td>
            </tr>
        @empty
            <tr><td colspan="6" style="text-align:center;">لا يوجد مخزون مسجّل</td></tr>
        @endforelse
    </table>
@endsection
