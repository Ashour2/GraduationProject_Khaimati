@extends('layouts.dashboard')

@section('title', 'تفاصيل العائلة')
@section('role-label', 'مدخل بيانات')

@section('sidebar-links')
    <a class="nav-link active" href="{{ route('data-entry.dashboard') }}">
        <i class="bi bi-people"></i> العائلات
    </a>
@endsection

@section('content')
<div class="container mt-4">
    <h4 class="fw-bold text-center mb-4">تفاصيل العائلة</h4>

    @if(session('success'))
        <div class="alert alert-success text-center rounded-pill">{{ session('success') }}</div>
    @endif

    <div class="family-info-card shadow-sm text-start">
        <h5 class="fw-bold mb-3">معلومات ولي الأمر</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="info-item">
                    <span class="info-label">الاسم:</span>
                    <span class="info-value">{{ $family->guardian_name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">رقم الهوية:</span>
                    <span class="info-value">{{ $family->national_id_no ?? '---' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">الجنس:</span>
                    <span class="info-value">{{ $family->gender == 'male' ? 'ذكر' : 'أنثى' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">الحالة الاجتماعية:</span>
                    <span class="info-value">{{ $family->marital_status ?? '---' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">المحافظة:</span>
                    <span class="info-value">{{ $family->governorate ?? '---' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">مكان السكن:</span>
                    <span class="info-value">{{ $family->place_of_residence ?? '---' }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-item">
                    <span class="info-label">رقم الهاتف:</span>
                    <span class="info-value">{{ $family->phone ?? '---' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">رقم بديل:</span>
                    <span class="info-value">{{ $family->alt_phone ?? '---' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">البريد الإلكتروني:</span>
                    <span class="info-value">{{ $family->email ?? '---' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">عدد الأفراد:</span>
                    <span class="info-value">{{ $members->count() }}</span>
                </div>
            </div>
        </div>

        <hr>
        <h5 class="fw-bold mb-3">المعلومات الصحية</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="info-item">
                    <span class="info-label">مصاب/مريض مزمن:</span>
                    <span class="info-value">{{ $family->is_injured ? 'نعم' : 'لا' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">إعاقة جسدية:</span>
                    <span class="info-value">{{ $family->have_physical_disbility ? 'نعم' : 'لا' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">يحتاج حفاضات:</span>
                    <span class="info-value">{{ $family->need_diapers ? 'نعم' : 'لا' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">معدات طبية:</span>
                    <span class="info-value">{{ $family->medical_eq_needed ?? '---' }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-item">
                    <span class="info-label">حامل:</span>
                    <span class="info-value">{{ $family->is_pregnant ? 'نعم' : 'لا' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">مرضع:</span>
                    <span class="info-value">{{ $family->is_lacting ? 'نعم' : 'لا' }}</span>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('data-entry.families.edit', $family->id) }}" class="btn btn-add">
                <i class="fa-solid fa-pen"></i> تعديل البيانات
            </a>
        </div>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('data-entry.families.members', $family->id) }}" class="btn btn-add">
            <i class="fa-solid fa-arrow-right"></i> رجوع لأفراد العائلة
        </a>
    </div>
</div>
@endsection
