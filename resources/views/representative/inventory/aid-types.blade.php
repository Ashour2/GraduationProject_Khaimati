@extends('layouts.representative')

@section('title', 'أنواع الطرود')

@section('content')
<div class="container main-container">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('representative.inventory.index') }}" class="btn btn-add me-3" style="padding:8px 20px;">
            <i class="fa-solid fa-arrow-right"></i>
        </a>
        <h4 class="fw-bold mb-0">إضافة أنواع طرود جديدة</h4>
    </div>

    <div class="text-center mb-4">
        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addAidTypeModal">
            إضافة نوع جديد
        </button>
    </div>

    <div class="table-card">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>لمن؟</th>
                    <th>الجنس</th>
                    <th>الفئة العمرية</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aidTypes as $index => $type)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $type->name }}</td>
                    <td>{{ $type->for == 'family' ? 'العائلة' : 'فرد' }}</td>
                    <td>{{ $type->gender == 'male' ? 'ذكر' : ($type->gender == 'female' ? 'أنثى' : 'الكل') }}</td>
                    <td>{{ $type->min_age ?? '---' }} - {{ $type->max_age ?? '---' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">لا يوجد أنواع مسجلة</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal إضافة نوع --}}
<div class="modal fade" id="addAidTypeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold m-0">إضافة نوع طرد جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('representative.inventory.aid-types.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">اسم الطرد</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">المخزون المرتبط</label>
                    <select name="inventory_id" class="form-select">
                        <option value="">اختر</option>
                        @foreach($inventory as $item)
                            <option value="{{ $item->id }}">{{ $item->package_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">لمن؟</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="for" value="family">
                            <label class="form-check-label">العائلة</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="for" value="individual">
                            <label class="form-check-label">فرد</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">الجنس</label>
                    <select name="gender" class="form-select">
                        <option value="">الكل</option>
                        <option value="male">ذكر</option>
                        <option value="female">أنثى</option>
                    </select>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">العمر الأدنى</label>
                        <input type="number" name="min_age" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">العمر الأقصى</label>
                        <input type="number" name="max_age" class="form-control">
                    </div>
                </div>
                <h6 class="fw-bold mb-3">الحالة الصحية:</h6>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="isForInjured" value="1">
                            <label class="form-check-label">مصاب</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="isForPhysicalDisability" value="1">
                            <label class="form-check-label">إعاقة جسدية</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="isForWhoNeedDiapers" value="1">
                            <label class="form-check-label">يحتاج حفاضات</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="isForLacting" value="1">
                            <label class="form-check-label">مرضع</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="isForPregnent" value="1">
                            <label class="form-check-label">حامل</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-save w-100" style="margin:0; padding:10px;">حفظ</button>
            </form>
        </div>
    </div>
</div>
@endsection
