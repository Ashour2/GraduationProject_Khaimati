@extends('layouts.representative')

@section('title', 'مدخلي البيانات')

@section('content')
<div class="container main-container">
    <h4 class="mb-4 fw-bold text-center">مدخلين بيانات</h4>

    <div class="text-center mb-4">
        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addModal">
            إضافة بيانات جديدة
        </button>
    </div>

    <div class="table-card">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>رقم الهاتف</th>
                    <th>البريد الإلكتروني</th>
                    <th>الحالة</th>
                    <th>العملية</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataEntries as $index => $entry)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $entry->name }}</td>
                    <td>{{ $entry->phone ?? '---' }}</td>
                    <td>{{ $entry->email }}</td>
                    <td>
                        @if($entry->status == 'active')
                            <span class="badge bg-success">متاح</span>
                        @else
                            <span class="badge bg-danger">موقوف</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-icons d-flex align-items-center justify-content-center gap-3">
                            <i class="bi bi-lock text-primary fs-5" style="cursor:pointer"
                                data-bs-toggle="modal"
                                data-bs-target="#passwordModal"
                                onclick="setPasswordEntry({{ $entry->id }})"></i>
                            <i class="bi bi-pencil-square text-secondary fs-5" style="cursor:pointer"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal"
                                onclick="setEditEntry({{ $entry->id }}, '{{ $entry->name }}', '{{ $entry->phone }}')"></i>
                            <form action="{{ route('representative.data-entries.toggle', $entry->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input" type="checkbox"
                                        {{ $entry->status == 'active' ? 'checked' : '' }}
                                        onchange="this.closest('form').submit()">
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">لا يوجد مدخلي بيانات</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal إضافة --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold m-0">إضافة مدخل بيانات</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('representative.data-entries.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">الاسم</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">رقم الهاتف</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">كلمة المرور</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn-save w-100" style="margin:0; padding:10px;">حفظ</button>
            </form>
        </div>
    </div>
</div>

{{-- Modal تعديل --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold m-0">تعديل البيانات</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">الاسم</label>
                    <input type="text" id="editName" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">رقم الهاتف</label>
                    <input type="text" id="editPhone" name="phone" class="form-control">
                </div>
                <button type="submit" class="btn-save w-100" style="margin:0; padding:10px;">حفظ التغييرات</button>
            </form>
        </div>
    </div>
</div>

{{-- Modal كلمة المرور --}}
<div class="modal fade" id="passwordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold m-0">تغيير كلمة السر</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="passwordForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label class="form-label">كلمة السر الجديدة</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">تأكيد كلمة السر</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn-save w-100" style="margin:0; padding:10px;">حفظ</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function setEditEntry(id, name, phone) {
        document.getElementById('editForm').action = `/representative/data-entries/${id}`;
        document.getElementById('editName').value = name;
        document.getElementById('editPhone').value = phone;
    }

    function setPasswordEntry(id) {
        document.getElementById('passwordForm').action = `/representative/data-entries/${id}/password`;
    }
</script>
@endsection
