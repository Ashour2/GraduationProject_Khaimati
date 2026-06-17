@extends('layouts.representative')

@section('title', 'تفاصيل السجل')

@section('content')
<div class="container mt-4">
    <h4 class="fw-bold text-center mb-4">تفاصيل التغيير</h4>

    <div class="family-info-card shadow-sm text-start">
        <div class="d-flex justify-content-between mb-3">
            <span class="fw-bold">العملية: {{ $changeLog->operation_type }}</span>
            <span class="text-danger fw-bold">رقم الهدف: {{ $changeLog->target_type }} #{{ $changeLog->target_id }}</span>
        </div>
        <div class="d-flex justify-content-between mb-4">
            <span>أجرى بواسطة: {{ $changeLog->user->name ?? '---' }}</span>
            <span>التاريخ: {{ \Carbon\Carbon::parse($changeLog->created_at)->format('d/m/Y h:i A') }}</span>
        </div>

        @if($changeLog->details->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>الحقل</th>
                    <th>القيمة القديمة</th>
                    <th>القيمة الجديدة</th>
                </tr>
            </thead>
            <tbody>
                @foreach($changeLog->details as $detail)
                <tr>
                    <td>{{ $detail->field_name }}</td>
                    <td>{{ $detail->old_value ?? '---' }}</td>
                    <td>{{ $detail->new_value ?? '---' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p class="text-center text-muted">لا يوجد تفاصيل للتغييرات</p>
        @endif
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('representative.change-logs.index') }}" class="btn btn-add" style="background:#6c757d;">
            <i class="fa-solid fa-arrow-right"></i> رجوع
        </a>
    </div>
</div>
@endsection
