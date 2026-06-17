@extends('layouts.representative')

@section('title', 'تفاصيل الداعم')

@section('content')
<div class="container mt-4">
    <h4 class="fw-bold text-center mb-4">تفاصيل الداعم</h4>

    <div class="family-info-card shadow-sm text-start">
        <div class="row">
            <div class="col-md-6">
                <div class="info-item">
                    <span class="info-label">الاسم:</span>
                    <span class="info-value">{{ $supporter->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">رقم الهاتف:</span>
                    <span class="info-value">{{ $supporter->phone ?? '---' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">البريد الإلكتروني:</span>
                    <span class="info-value">{{ $supporter->email ?? '---' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">نوع المساعدة:</span>
                    <span class="info-value">{{ $supporter->aid_sector ?? '---' }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-item">
                    <span class="info-label">المحافظة:</span>
                    <span class="info-value">{{ $supporter->website_link ?? '---' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">نبذة:</span>
                    <span class="info-value">{{ $supporter->about ?? '---' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">الشروط:</span>
                    <span class="info-value">{{ $supporter->terms ?? '---' }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4 d-flex justify-content-center gap-3">
        <a href="{{ route('representative.supporters.edit', $supporter->id) }}" class="btn btn-add">
            <i class="fa-solid fa-pen"></i> تعديل
        </a>
        <a href="{{ route('representative.supporters.index') }}" class="btn btn-add" style="background:#6c757d;">
            <i class="fa-solid fa-arrow-right"></i> رجوع
        </a>
    </div>
</div>
@endsection
