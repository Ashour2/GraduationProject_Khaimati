@extends('layouts.representative')

@section('title', 'المستفيدين')

@section('content')
<div class="container main-container">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('representative.distributions.index') }}" class="btn btn-add me-3" style="padding:8px 20px;">
            <i class="fa-solid fa-arrow-right"></i>
        </a>
        <h4 class="fw-bold mb-0">معاينة المستفيدين</h4>
    </div>

    <div class="family-info-card shadow-sm text-start mb-4">
        <div class="info-item">
            <span class="info-label">اسم الطرد:</span>
            <span class="info-value">{{ $distribution->inventory->package_name ?? '---' }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">الكمية:</span>
            <span class="info-value">{{ $distribution->quantity }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">الحالة:</span>
            <span class="info-value">
                @if($distribution->status == 'confirmed')
                    <span class="badge bg-success">مكتمل</span>
                @else
                    <span class="badge bg-warning text-dark">قيد الانتظار</span>
                @endif
            </span>
        </div>
    </div>

    <div class="table-card">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>رقم العائلة</th>
                    <th>الاسم</th>
                    <th>العمر</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
                @forelse($beneficiaries as $index => $ben)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>F-{{ $ben->family->id ?? '---' }}</td>
                    <td>{{ $ben->member->name ?? $ben->family->guardian_name ?? '---' }}</td>
                    <td>{{ $ben->member && $ben->member->birthday ? \Carbon\Carbon::parse($ben->member->birthday)->age : '---' }}</td>
                    <td>
                        @if($ben->status == 'received')
                            <span class="badge bg-success">تم الاستلام</span>
                        @else
                            <span class="badge bg-warning text-dark">قيد الانتظار</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">لا يوجد مستفيدين</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
