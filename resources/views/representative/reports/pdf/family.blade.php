@extends('representative.reports.pdf.layout')

@section('report_title', 'تقرير عائلة')

@section('report_content')
    <div class="section-title">معلومات ولي الأمر</div>
    <table>
        <tr><th>الاسم</th><td>{{ $family->guardian_name }}</td>
            <th>رقم الهوية</th><td>{{ $family->national_id_no ?? '---' }}</td></tr>
        <tr><th>الجنس</th><td>{{ $family->gender == 'male' ? 'ذكر' : ($family->gender == 'female' ? 'أنثى' : '---') }}</td>
            <th>الحالة الاجتماعية</th><td>{{ $family->marital_status ?? '---' }}</td></tr>
        <tr><th>المحافظة</th><td>{{ $family->governorate ?? '---' }}</td>
            <th>مكان السكن</th><td>{{ $family->place_of_residence ?? '---' }}</td></tr>
        <tr><th>الهاتف</th><td>{{ $family->phone ?? '---' }}</td>
            <th>البريد الإلكتروني</th><td>{{ $family->email ?? '---' }}</td></tr>
    </table>

    <div class="section-title">المعلومات الصحية</div>
    <table>
        <tr><th>مصاب/مريض مزمن</th><td>{{ $family->is_injured ? 'نعم' : 'لا' }}</td>
            <th>إعاقة جسدية</th><td>{{ $family->have_physical_disbility ? 'نعم' : 'لا' }}</td></tr>
        <tr><th>يحتاج حفاضات</th><td>{{ $family->need_diapers ? 'نعم' : 'لا' }}</td>
            <th>معدات طبية</th><td>{{ $family->medical_eq_needed ?? '---' }}</td></tr>
        <tr><th>حامل</th><td>{{ $family->is_pregnant ? 'نعم' : 'لا' }}</td>
            <th>مرضع</th><td>{{ $family->is_lacting ? 'نعم' : 'لا' }}</td></tr>
    </table>

    <div class="section-title">أفراد العائلة ({{ $family->members->count() }})</div>
    <table>
        <tr>
            <th>#</th>
            <th>الاسم</th>
            <th>رقم الهوية</th>
            <th>الجنس</th>
            <th>الصلة بولي الأمر</th>
            <th>مصاب</th>
            <th>إعاقة</th>
        </tr>
        @forelse($family->members as $i => $member)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->national_id_no ?? '---' }}</td>
                <td>{{ $member->gender == 'male' ? 'ذكر' : ($member->gender == 'female' ? 'أنثى' : '---') }}</td>
                <td>{{ $member->relation_to_guardian ?? '---' }}</td>
                <td>{{ $member->is_injured ? 'نعم' : 'لا' }}</td>
                <td>{{ $member->have_physical_diability ? 'نعم' : 'لا' }}</td>
            </tr>
        @empty
            <tr><td colspan="7" style="text-align:center;">لا يوجد أفراد مسجّلين</td></tr>
        @endforelse
    </table>
@endsection
