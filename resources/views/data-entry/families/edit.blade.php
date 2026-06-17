@extends('layouts.dashboard')

@section('title', 'تعديل بيانات العائلة')
@section('role-label', 'مدخل بيانات')

@section('sidebar-links')
    <a class="nav-link active" href="{{ route('data-entry.dashboard') }}">
        <i class="bi bi-people"></i> العائلات
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-7">
        <h5 class="fw-bold text-center mb-4">تعديل بيانات ولي الأمر</h5>

        @if($errors->any())
            <div class="alert alert-danger text-center rounded-pill">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('data-entry.families.update', $family->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group-custom">
                <label>الاسم بالكامل</label>
                <input type="text" name="guardian_name" class="form-control" value="{{ $family->guardian_name }}" required>
            </div>

            <div class="form-group-custom">
                <label>الجنس</label>
                <select name="gender" class="form-select">
                    <option value="">عرض القائمة</option>
                    <option value="male" {{ $family->gender == 'male' ? 'selected' : '' }}>ذكر</option>
                    <option value="female" {{ $family->gender == 'female' ? 'selected' : '' }}>أنثى</option>
                </select>
            </div>

            <div class="form-group-custom">
                <label>رقم الهوية</label>
                <input type="text" name="national_id_no" class="form-control" value="{{ $family->national_id_no }}">
            </div>

            <div class="form-group-custom">
                <label>الحالة الاجتماعية</label>
                <select name="marital_status" class="form-select">
                    <option value="">عرض القائمة</option>
                    <option value="single" {{ $family->marital_status == 'single' ? 'selected' : '' }}>أعزب</option>
                    <option value="married" {{ $family->marital_status == 'married' ? 'selected' : '' }}>متزوج</option>
                    <option value="divorced" {{ $family->marital_status == 'divorced' ? 'selected' : '' }}>مطلق</option>
                    <option value="widowed" {{ $family->marital_status == 'widowed' ? 'selected' : '' }}>أرمل</option>
                </select>
            </div>

            <div class="form-group-custom">
                <label>مكان السكن الأصلي</label>
                <input type="text" name="place_of_residence" class="form-control" value="{{ $family->place_of_residence }}">
            </div>

            <div class="form-group-custom">
                <label>المحافظة</label>
                <select name="governorate" class="form-select">
                    <option value="">عرض القائمة</option>
                    <option value="غزة" {{ $family->governorate == 'غزة' ? 'selected' : '' }}>غزة</option>
                    <option value="رفح" {{ $family->governorate == 'رفح' ? 'selected' : '' }}>رفح</option>
                    <option value="خانيونس" {{ $family->governorate == 'خانيونس' ? 'selected' : '' }}>خانيونس</option>
                    <option value="الشمال" {{ $family->governorate == 'الشمال' ? 'selected' : '' }}>الشمال</option>
                    <option value="الوسطى" {{ $family->governorate == 'الوسطى' ? 'selected' : '' }}>الوسطى</option>
                </select>
            </div>

            <h5 class="fw-bold text-center my-4">تسجيل معلومات صحية</h5>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span>هل هي/هو مصاب أو يعاني من مرض مزمن؟</span>
                <div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="is_injured" value="1" {{ $family->is_injured ? 'checked' : '' }}><label class="form-check-label">نعم</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="is_injured" value="0" {{ !$family->is_injured ? 'checked' : '' }}><label class="form-check-label">لا</label></div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span>هل هي/هو معاق جسدياً؟</span>
                <div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="have_physical_disbility" value="1" {{ $family->have_physical_disbility ? 'checked' : '' }}><label class="form-check-label">نعم</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="have_physical_disbility" value="0" {{ !$family->have_physical_disbility ? 'checked' : '' }}><label class="form-check-label">لا</label></div>
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
                <input type="text" name="medical_eq_needed" class="form-control" value="{{ $family->medical_eq_needed }}">
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span>هل تحتاج هي/هو حفاضات؟</span>
                <div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="need_diapers" value="1" {{ $family->need_diapers ? 'checked' : '' }}><label class="form-check-label">نعم</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="need_diapers" value="0" {{ !$family->need_diapers ? 'checked' : '' }}><label class="form-check-label">لا</label></div>
                </div>
            </div>

            <p class="fw-bold mt-3">إذا كانت أنثى::</p>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span>هل هي حامل؟</span>
                <div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="is_pregnant" value="1" {{ $family->is_pregnant ? 'checked' : '' }}><label class="form-check-label">نعم</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="is_pregnant" value="0" {{ !$family->is_pregnant ? 'checked' : '' }}><label class="form-check-label">لا</label></div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span>هل هي مرضع؟</span>
                <div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="is_lacting" value="1" {{ $family->is_lacting ? 'checked' : '' }}><label class="form-check-label">نعم</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="is_lacting" value="0" {{ !$family->is_lacting ? 'checked' : '' }}><label class="form-check-label">لا</label></div>
                </div>
            </div>

            <h5 class="fw-bold text-center my-4">بيانات التواصل</h5>

            <div class="form-group-custom">
                <label>رقم الهاتف</label>
                <input type="text" name="phone" class="form-control" value="{{ $family->phone }}">
            </div>

            <div class="form-group-custom">
                <label>رقم الهاتف البديل</label>
                <input type="text" name="alt_phone" class="form-control" value="{{ $family->alt_phone }}">
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn-save">حفظ التعديلات</button>
            </div>
        </form>
    </div>

    <div class="col-md-5 text-center d-none d-md-block">
        <img src="{{ asset('assets/images/img1__2_-removebg-preview.png') }}" class="img-fluid" style="max-height:500px;">
    </div>
</div>
@endsection
