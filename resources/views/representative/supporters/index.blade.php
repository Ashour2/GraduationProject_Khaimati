@extends('layouts.representative')

@section('title', 'الداعمون')

@section('content')
<div class="container main-container">
    <h4 class="mb-4 fw-bold text-center">داعمين المخيم</h4>

    <div class="text-center mb-4">
        <a href="{{ route('representative.supporters.create') }}" class="btn btn-add">
            إضافة داعم جديد
        </a>
    </div>

    <div class="table-card mb-5">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>نوع المساعدة</th>
                    <th>رقم الهاتف</th>
                    <th>البريد الإلكتروني</th>
                    <th>المصدر</th>
                    <th>العملية</th>
                </tr>
            </thead>
            <tbody>
                @forelse($campSupporters as $supporter)
                <tr>
                    <td>{{ $supporter->name }}</td>
                    <td>{{ $supporter->aid_sector ?? '---' }}</td>
                    <td>{{ $supporter->phone ?? '---' }}</td>
                    <td>{{ $supporter->email ?? '---' }}</td>
                    <td>{{ $supporter->added_by ?? 'المشرف' }}</td>
                    <td class="action-btns">
                        <a href="{{ route('representative.supporters.show', $supporter->id) }}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('representative.supporters.edit', $supporter->id) }}">
                            <i class="fa-solid fa-pen text-secondary"></i>
                        </a>
                        <form action="{{ route('representative.supporters.destroy', $supporter->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <i class="fa-solid fa-trash-can" onclick="if(confirm('هل أنت متأكد؟')) this.closest('form').submit()"></i>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">لا يوجد داعمون</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h5 class="fw-bold mb-3">داعمون آخرين</h5>

    <div class="table-card">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>نوع المساعدة</th>
                    <th>رقم الهاتف</th>
                    <th>البريد الإلكتروني</th>
                    <th>العملية</th>
                </tr>
            </thead>
            <tbody>
                @forelse($otherSupporters as $supporter)
                <tr>
                    <td>{{ $supporter->name }}</td>
                    <td>{{ $supporter->aid_sector ?? '---' }}</td>
                    <td>{{ $supporter->phone ?? '---' }}</td>
                    <td>{{ $supporter->email ?? '---' }}</td>
                    <td class="action-btns">
                        <a href="{{ route('representative.supporters.show', $supporter->id) }}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <form action="{{ route('representative.supporters.add-to-camp', $supporter->id) }}" method="POST" class="d-inline">
                            @csrf
                            <i class="bi bi-plus-circle text-success fs-5" style="cursor:pointer"
                                onclick="if(confirm('إضافة هذا الداعم للمخيم؟')) this.closest('form').submit()"></i>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">لا يوجد داعمون آخرون</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
