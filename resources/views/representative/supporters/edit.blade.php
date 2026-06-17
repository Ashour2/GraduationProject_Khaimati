@extends('layouts.representative')

@section('title', 'تعديل الداعم')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <h5 class="fw-bold text-center mb-4">تعديل بيانات الداعم</h5>

        @if($errors->any())
            <div class="alert alert-danger text-center rounded-pill">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('representative.supporters.update', $supporter->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-container">
                <div class="form-group-custom">
                    <label>الاسم</label>
                    <input type="text" name="name" class="form-control" value="{{ $supporter->name }}" required>
                </div>
                <div class="form-group-custom">
                    <label>رقم الهاتف</label>
                    <input type="text" name="phone" class="form-control" value="{{ $supporter->phone }}">
                </div>
                <div class="form-group-custom">
                    <label>البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" value="{{ $supporter->email }}">
                </div>
                <div class="form-group-custom">
                    <label>المحافظة</label>
                    <input type="text" name="website_link" class="form-control" value="{{ $supporter->website_link }}">
                </div>
                <div class="form-group-custom">
                    <label>نوع المساعدة</label>
                    <input type="text" name="aid_sector" class="form-control" value="{{ $supporter->aid_sector }}">
                </div>
                <div class="form-group-custom">
                    <label>نبذة</label>
                    <textarea name="about" class="form-control" rows="4">{{ $supporter->about }}</textarea>
                </div>
                <div class="form-group-custom">
                    <label>الشروط</label>
                    <textarea name="terms" class="form-control" rows="4">{{ $supporter->terms }}</textarea>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn-save">حفظ التعديلات</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
