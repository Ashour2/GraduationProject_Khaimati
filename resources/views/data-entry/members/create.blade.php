@extends('layouts.dashboard')

@section('title', 'إضافة فرد جديد')
@section('role-label', 'مدخل بيانات')

@section('sidebar-links')
    <a class="nav-link active" href="{{ route('data-entry.dashboard') }}">
        <i class="bi bi-people"></i> العائلات
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-7">
        <h5 class="fw-bold text-center mb-4">إضافة فرد جديد</h5>

        @if($errors->any())
            <div class="alert alert-danger text-center rounded-pill">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('data-entry.families.members.store', $family->id) }}" method="POST">
            @csrf

            <div class="form-group-custom">
                <label>الاسم بالكامل</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group-custom">
                <label>الجنس</label>
                <select name="gender" class="form-select">
                    <option value="">عرض القائمة</option>
                    <option value="male">ذكر</option>
                    <option value="female">أنثى</option>
                </select>
            </div>

            <div class="form-group-custom">
                <label>رقم الهوية</label>
                <input type="text" name="national_id_no" class="form-control" value="{{ old('national_id_no') }}">
            </div>

            <div class="form-group-custom">
                <label>الحالة الاجتماعية</label>
                <select name="maritral_status" class="form-select">
                    <option value="">عرض القائمة</option>
                    <option value="single">أعزب</option>
                    <option value="married">متزوج</option>
                    <option value="divorced">مطلق</option>
                    <option value="widowed">أرمل</option>
                </select>
            </div>

            <div class="form-group-custom">
                <label>الصلة بولي الأمر</label>
                <input type="text" name="relation_to_guardian" class="form-control" value="{{ old('relation_to_guardian') }}">
            </div>

            <div class="form-group-custom">
                <label>تاريخ الميلاد</label>
                <input type="date" name="birthday" class="form-control" value="{{ old('birthday') }}">
            </div>

            <h5 class="fw-bold text-center my-4">تسجيل معلومات صحية</h5>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span>هل هي/هو مصاب أو يعاني من مرض مزمن؟</span>
                <div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="is_injured" value="1"><label class="form-check-label">نعم</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="is_injured" value="0" checked><label class="form-check-label">لا</label></div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span>هل هي/هو معاق جسدياً؟</span>
                <div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="have_physical_diability" value="1"><label class="form-check-label">نعم</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="have_physical_diability" value="0" checked><label class="form-check-label">لا</label></div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span>هل هي/هو تحتاج إلى أي معدات طبية محددة؟</span>
                <div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="needs_medical" value="1"><label class="form-check-label">نعم</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="needs_medical" value="0" checked><label class="form-check-label">لا</label></div>
                </div>
            </div>

            <div class="form-group-custom mb-3">
                <label>إذا "نعم" اذكر ما هي؟</label>
                <input type="text" name="medical_eq_needed" class="form-control" value="{{ old('medical_eq_needed') }}">
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span>هل تحتاج هي/هو حفاضات؟</span>
                <div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="need_diapers" value="1"><label class="form-check-label">نعم</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="need_diapers" value="0" checked><label class="form-check-label">لا</label></div>
                </div>
            </div>

            <p class="fw-bold mt-3">إذا كانت أنثى::</p>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span>هل هي حامل؟</span>
                <div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="is_pregnent" value="1"><label class="form-check-label">نعم</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="is_pregnent" value="0" checked><label class="form-check-label">لا</label></div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span>هل هي مرضع؟</span>
                <div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="is_lacting" value="1"><label class="form-check-label">نعم</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="is_lacting" value="0" checked><label class="form-check-label">لا</label></div>
                </div>
            </div>

            <h5 class="fw-bold text-center my-4">بيانات التواصل</h5>

            <div class="form-group-custom">
                <label>رقم الهاتف</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
            </div>

            <div class="form-group-custom">
                <label>رقم الهاتف البديل</label>
                <input type="text" name="alt_phone" class="form-control" value="{{ old('alt_phone') }}">
            </div>

            <div class="form-group-custom">
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn-save">حفظ</button>
            </div>
        </form>
    </div>

    <div class="col-md-5 text-center d-none d-md-block">
        <img src="{{ asset('assets/images/img1__2_-removebg-preview.png') }}" class="img-fluid" style="max-height:500px;">
    </div>
</div>
@endsection
