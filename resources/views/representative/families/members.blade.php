@extends('layouts.representative')

@section('title', 'أفراد العائلة')

@section('content')
<div class="container text-center mt-4">
    <h4 class="fw-bold mb-4">أفراد العائلة</h4>

    <div class="family-info-card shadow-sm text-start">
        <div class="row">
            <div class="col-md-8">
                <div class="info-item">
                    <span class="info-label">رب العائلة:</span>
                    <span class="info-value">{{ $family->guardian_name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">رقم الهوية:</span>
                    <span class="info-value">{{ $family->national_id_no ?? '---' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">عدد الأفراد:</span>
                    <span class="info-value">{{ $members->count() }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-item">
                    <span class="info-label">رقم العائلة:</span>
                    <span class="info-value">F{{ $family->id }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="table-container">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>رقم الهوية</th>
                    <th>العمر</th>
                    <th>الجنس</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $index => $member)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->national_id_no ?? '---' }}</td>
                    <td>{{ $member->birthday ? \Carbon\Carbon::parse($member->birthday)->age : '---' }}</td>
                    <td>{{ $member->gender == 'male' ? 'ذكر' : ($member->gender == 'female' ? 'أنثى' : '---') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">لا يوجد أفراد مسجلين</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('representative.families.index') }}" class="btn btn-add" style="background:#6c757d;">
            <i class="fa-solid fa-arrow-right"></i> رجوع للعائلات
        </a>
    </div>
</div>
@endsection
