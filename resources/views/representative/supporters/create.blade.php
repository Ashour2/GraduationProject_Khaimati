@extends('layouts.representative')

@section('title', 'إضافة داعم')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <h5 class="fw-bold text-center mb-4">إضافة داعم جديد</h5>

        @if($errors->any())
            <div class="alert alert-danger text-center rounded-pill">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('representative.supporters.store') }}" method="POST">
            @csrf
            <div class="form-container">
                <div class="form-group-custom">
                    <label>الاسم</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group-custom">
                    <label>رقم الهاتف</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <div class="form-group-custom">
                    <label>البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group-custom">
                    <label>المحافظة</label>
                    <input type="text" name="website_link" class="form-control">
                </div>
                <div class="form-group-custom">
                    <label>نوع المساعدة</label>
                    <input type="text" name="aid_sector" class="form-control">
                </div>
                <div class="form-group-custom">
                    <label>نبذة</label>
                    <textarea name="about" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group-custom">
                    <label>الشروط</label>
                    <textarea name="terms" class="form-control" rows="4"></textarea>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn-save">حفظ</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
