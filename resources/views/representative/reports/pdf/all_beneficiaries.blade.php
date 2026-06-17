@extends('representative.reports.pdf.layout')

@section('report_title', 'تقرير كل بيانات المستفيدين')

@section('report_content')
    <div class="info-row">
        <span class="info-label">عدد العائلات:</span> {{ $families->count() }}
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <span class="info-label">إجمالي الأفراد:</span> {{ $families->sum(fn($f) => $f->members->count()) }}
    </div>

    @forelse($families as $family)
        <div class="section-title">عائلة: {{ $family->guardian_name }} (هوية: {{ $family->national_id_no ?? '---' }})</div>
        <table>
            <tr>
                <th>المحافظة</th>
                <th>مكان السكن</th>
                <th>الهاتف</th>
                <th>الحالة الاجتماعية</th>
                <th>عدد الأفراد</th>
            </tr>
            <tr>
                <td>{{ $family->governorate ?? '---' }}</td>
                <td>{{ $family->place_of_residence ?? '---' }}</td>
                <td>{{ $family->phone ?? '---' }}</td>
                <td>{{ $family->marital_status ?? '---' }}</td>
                <td>{{ $family->members->count() }}</td>
            </tr>
        </table>

        @if($family->members->count() > 0)
            <table>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>رقم الهوية</th>
                    <th>الجنس</th>
                    <th>الصلة</th>
                    <th>مصاب</th>
                    <th>إعاقة</th>
                </tr>
                @foreach($family->members as $i => $member)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->national_id_no ?? '---' }}</td>
                        <td>{{ $member->gender == 'male' ? 'ذكر' : ($member->gender == 'female' ? 'أنثى' : '---') }}</td>
                        <td>{{ $member->relation_to_guardian ?? '---' }}</td>
                        <td>{{ $member->is_injured ? 'نعم' : 'لا' }}</td>
                        <td>{{ $member->have_physical_diability ? 'نعم' : 'لا' }}</td>
                    </tr>
                @endforeach
            </table>
        @endif
    @empty
        <p style="text-align:center;">لا توجد عائلات مسجلة في هذا المخيم</p>
    @endforelse
@endsection
