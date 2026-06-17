@extends('layouts.representative')

@section('title', 'النازحون')
@section('active', 'families')

@section('content')
<div class="container main-container">
    <h4 class="mb-4 fw-bold text-center">إدخال البيانات</h4>

    <div class="search-container">
        <input type="text" id="searchInput" class="form-control" placeholder="بحث...">
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
                        <a href="{{ route('representative.families.members', $family->id) }}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
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
