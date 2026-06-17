@extends('layouts.dashboard')

@section('title', 'لوحة إدخال البيانات')
@section('role-label', 'مدخل بيانات')

@section('sidebar-links')
    <a class="nav-link {{ request()->routeIs('data-entry.dashboard') ? 'active' : '' }}"
        href="{{ route('data-entry.dashboard') }}">
        <i class="bi bi-people"></i> العائلات
    </a>
@endsection

@section('content')
<div class="container main-container">
    <h4 class="mb-4 fw-bold">لوحة إدخال البيانات</h4>

    <a href="{{ route('data-entry.families.create') }}" class="btn btn-add">إضافة عائلة جديدة</a>

    <div class="search-container">
        <input type="text" id="searchInput" class="form-control" placeholder="بحث باسم العائلة...">
        <i class="fa-solid fa-magnifying-glass"></i>
    </div>

    <div class="table-card">

        <table class="table mb-0" id="familyTable">
    <thead>
        <tr>
            <th>رقم العائلة</th>
            <th>الاسم</th>
            <th>عدد الأفراد</th>
            <th>عدد الذكور</th>
            <th>عدد الإناث</th>
            <th>العملية</th>
        </tr>
    </thead>
    <tbody id="tableBody">
        @forelse($families as $family)
        <tr>
            <td>F-{{ $family->id }}</td>
            <td>{{ $family->guardian_name }}</td>
            <td>{{ $family->members->count() }}</td>
            <td>{{ $family->members->where('gender', 'male')->count() }}</td>
            <td>{{ $family->members->where('gender', 'female')->count() }}</td>
            <td class="action-btns">
                <a href="{{ route('data-entry.families.members', $family->id) }}">
                    <i class="fa-solid fa-eye"></i>
                </a>
                <form action="{{ route('data-entry.families.destroy', $family->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <i class="fa-solid fa-trash-can" style="cursor:pointer" onclick="if(confirm('هل أنت متأكد من حذف هذه العائلة؟')) this.closest('form').submit()"></i>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-muted">لا توجد عائلات مسجلة</td>
        </tr>
        @endforelse
    </tbody>
</table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        document.querySelectorAll("#tableBody tr").forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(filter) ? "" : "none";
        });
    });
</script>
@endsection
