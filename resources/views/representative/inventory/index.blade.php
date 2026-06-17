@extends('layouts.representative')

@section('title', 'المخزون')

@section('content')
<div class="container main-container">
    <h4 class="mb-4 fw-bold text-center">المخزون</h4>

    <div class="text-center mb-4">
        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addInventoryModal">
            إضافة نوع جديد
        </button>
        <a href="{{ route('representative.inventory.aid-types') }}" class="btn btn-add ms-2">
            إضافة أنواع الطرود
        </a>
    </div>

    <div class="table-card">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>الوصف</th>
                    <th>الكميات المستلمة</th>
                    <th>الكميات الموزعة</th>
                    <th>المتبقي</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventory as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->package_name }}</td>
                    <td>{{ $item->description ?? '---' }}</td>
                    <td>{{ $item->recived_q }}</td>
                    <td>{{ $item->distributed_q }}</td>
                    <td>{{ $item->recived_q - $item->distributed_q }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">لا يوجد مخزون</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal إضافة مخزون --}}
<div class="modal fade" id="addInventoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold m-0">إضافة طرد جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('representative.inventory.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">اسم الطرد</label>
                    <input type="text" name="package_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">الوصف</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">الكمية المستلمة</label>
                    <input type="number" name="recived_q" class="form-control" min="0" required>
                </div>
                <button type="submit" class="btn-save w-100" style="margin:0; padding:10px;">حفظ</button>
            </form>
        </div>
    </div>
</div>
@endsection
