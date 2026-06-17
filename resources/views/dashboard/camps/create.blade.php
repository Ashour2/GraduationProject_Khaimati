@extends('layouts.app')

@section('content')
<div class="container">
    <h3>إضافة مخيم</h3>
    <form action="{{ route('camps.store') }}" method="POST">
        @csrf

        <input type="text" name="name" class="form-control mb-2" placeholder="اسم المخيم">
        <input type="text" name="governorate" class="form-control mb-2" placeholder="المحافظة">
        <input type="text" name="location" class="form-control mb-2" placeholder="الموقع">
        <input type="number" name="families_count" class="form-control mb-2" placeholder="عدد العائلات">

        <select name="status" class="form-control mb-2">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>

        <button class="btn btn-primary">حفظ</button>
    </form>
</div>
@endsection