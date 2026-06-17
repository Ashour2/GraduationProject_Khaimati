@extends('layouts.representative')

@section('title', 'لوحة التحكم')
@section('active', 'dashboard')

@section('content')
<h4 class="text-center mb-5 fw-bold">لوحة التحكم</h4>

<div class="row g-4">
    <div class="col-md-6">
        <div class="stat-card">
            <h3>{{ $membersCount }}</h3>
            <h5>المستفيدين</h5>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card">
            <h3>{{ $familiesCount }}</h3>
            <h5>العائلات</h5>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card">
            <h3>{{ $dataEntriesCount }}</h3>
            <h5>مدخلي البيانات</h5>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card">
            <h3>{{ $supportersCount }}</h3>
            <h5>الداعمين</h5>
        </div>
    </div>
</div>
@endsection
