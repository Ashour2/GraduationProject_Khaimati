@extends('layouts.dashboard')

@section('title', 'تفاصيل الفرد')
@section('role-label', 'مدخل بيانات')

@section('sidebar-links')
    <a class="nav-link active" href="{{ route('data-entry.dashboard') }}">
        <i class="bi bi-people"></i> العائلات
    </a>
@endsection

@section('content')
<div class="container mt-4">
    <h4 class="fw-bold text-center mb-4">تفاصيل الفرد</h4>

    <div class="family-info-card shadow-sm text-start">

        <h5 class="fw-bold mb-3">المعلومات الأساسية</h5>

        <div class="row">
            <div class="col-md-6">
                <div class="info-item">
                    <span class="info-label">الاسم:</span>
                    <span class="info-value">{{ $member->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">رقم الهوية:</span>
                    <span class="info-value">{{ $member->national_id_no ?? '---' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">الجنس:</span>
                    <span class="info-value">{{ $member->gender == 'male' ? 'ذكر' : 'أنثى' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">العمر:</span>
                    <span class="info-value">{{ $member->birthday ? \Carbon\Carbon::parse($member->birthday)->age : '---' }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-item">
                    <span class="info-label">الحالة الاجتماعية:</span>
                    <span class="info-value">{{ $member->maritral_status ?? '---' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">الصلة بولي الأمر:</span>
                    <span class="info-value">{{ $member->relation_to_guardian ?? '---' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">رقم العائلة:</span>
                    <span class="info-value">F{{ $family->id }}</span>
                </div>
            </div>
        </div>

        <hr>
        <h5 class="fw-bold mb-3">بيانات التواصل</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="info-item">
                    <span class="info-label">رقم الهاتف:</span>
                    <span class="info-value">{{ $member->phone ?? '---' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">رقم بديل:</span>
                    <span class="info-value">{{ $member->alt_phone ?? '---' }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-item">
                    <span class="info-label">البريد الإلكتروني:</span>
                    <span class="info-value">{{ $member->email ?? '---' }}</span>
                </div>
            </div>
        </div>

        <hr>
        <h5 class="fw-bold mb-3">المعلومات الصحية</h5>

        <div class="row">
            <div class="col-md-6">
                <div class="info-item">
                    <span class="info-label">مصاب/مريض مزمن:</span>
                    <span class="info-value">{{ $member->is_injured ? 'نعم' : 'لا' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">إعاقة جسدية:</span>
                    <span class="info-value">{{ $member->have_physical_diability ? 'نعم' : 'لا' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">يحتاج حفاضات:</span>
                    <span class="info-value">{{ $member->need_diapers ? 'نعم' : 'لا' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">معدات طبية:</span>
                    <span class="info-value">{{ $member->medical_eq_needed ?? '---' }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-item">
                    <span class="info-label">حامل:</span>
                    <span class="info-value">{{ $member->is_pregnent ? 'نعم' : 'لا' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">مرضع:</span>
                    <span class="info-value">{{ $member->is_lacting ? 'نعم' : 'لا' }}</span>
                </div>
            </div>
        </div>

    </div>

    <div class="text-center mt-4 d-flex justify-content-center gap-3">
        <a href="{{ route('data-entry.families.members.edit', [$family->id, $member->id]) }}" class="btn btn-add">
            <i class="fa-solid fa-pen"></i> تعديل بيانات الفرد
        </a>
        <a href="{{ route('data-entry.families.members', $family->id) }}" class="btn btn-add" style="background:#6c757d;">
            <i class="fa-solid fa-arrow-right"></i> رجوع
        </a>
    </div>
</div>
@endsection
