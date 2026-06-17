@extends('layouts.representative')

@section('title', 'توزيع المساعدات')

@section('content')
<div class="container main-container">
    <h4 class="mb-4 fw-bold text-center">توزيع المساعدات</h4>

    <div class="text-center mb-4">
        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addDistModal">
            توزيع مساعدات
        </button>
    </div>

    <div class="table-card">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>اسم الطرد</th>
                    <th>الكمية</th>
                    <th>حالة التوزيع</th>
                    <th>العملية</th>
                </tr>
            </thead>
            <tbody>
                @forelse($distributions as $dist)
                <tr>
                    <td>{{ $dist->inventory->package_name ?? '---' }}</td>
                    <td>{{ $dist->quantity }}</td>
                    <td>
                        @if($dist->status == 'confirmed')
                            <span class="badge bg-success">مكتمل</span>
                        @else
                            <span class="badge bg-warning text-dark">قيد الانتظار</span>
                        @endif
                    </td>
                    <td class="action-btns">
                        <a href="{{ route('representative.distributions.beneficiaries', $dist->id) }}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        @if($dist->status == 'pending')
                        <form action="{{ route('representative.distributions.confirm', $dist->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <i class="bi bi-check-circle text-success fs-5" style="cursor:pointer"
                                onclick="if(confirm('تأكيد التوزيع؟')) this.closest('form').submit()"></i>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">لا يوجد توزيعات</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal إنشاء توزيع --}}
<div class="modal fade" id="addDistModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold m-0">إنشاء توزيع جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('representative.distributions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">نوع الطرد</label>
                    <select name="inventory_id" class="form-select" required>
                        <option value="">اختر</option>
                        @foreach($inventory as $item)
                            <option value="{{ $item->id }}">{{ $item->package_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">الكمية</label>
                    <input type="number" name="quantity" class="form-control" min="1" required>
                </div>
                <button type="submit" class="btn-save w-100" style="margin:0; padding:10px;">إنشاء</button>
            </form>
        </div>
    </div>
</div>
@endsection
