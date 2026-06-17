@extends('layouts.dashboard')

@section('title', 'أفراد العائلة')
@section('role-label', 'مدخل بيانات')

@section('sidebar-links')
    <a class="nav-link active" href="{{ route('data-entry.dashboard') }}">
        <i class="bi bi-people"></i> العائلات
    </a>
@endsection

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
                <div class="mt-3">
                    <a href="{{ route('data-entry.families.show', $family->id) }}" class="btn btn-add" style="padding: 8px 20px;">
                        <i class="fa-solid fa-eye"></i> عرض التفاصيل
                    </a>
                </div>
            </div>
        </div>
    </div>

    <a class="btn btn-add-member mb-4" href="{{ route('data-entry.families.members.create', $family->id) }}">
        إضافة فرد جديد
    </a>

    <div class="table-container">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>رقم الهوية</th>
                    <th>العمر</th>
                    <th>العملية</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $index => $member)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->national_id_no ?? '---' }}</td>
                    <td>{{ $member->birthday ? \Carbon\Carbon::parse($member->birthday)->age : '---' }}</td>
                    <td class="action-icons">
                        <a href="{{ route('data-entry.families.members.show', [$family->id, $member->id]) }}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <form action="{{ route('data-entry.families.members.destroy', [$family->id, $member->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <i class="fa-solid fa-trash-can" onclick="if(confirm('هل أنت متأكد من حذف هذا الفرد؟')) this.closest('form').submit()"></i>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">لا يوجد أفراد مسجلين</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
