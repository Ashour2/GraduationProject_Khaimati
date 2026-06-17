@extends('layouts.app')

@section('title', 'المخيمات')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">المخيمات</h2>

    <a href="{{ route('camps.create') }}" class="btn btn-primary mb-3">إضافة مخيم</a>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>المحافظة</th>
                <th>الموقع</th>
                <th>الحالة</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($camps as $camp)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $camp->name }}</td>
                    <td>{{ $camp->governorate }}</td>
                    <td>{{ $camp->location }}</td>
                    <td>{{ $camp->status }}</td>
                    <td>
                        <a href="{{ route('camps.show', $camp->id) }}" class="btn btn-sm btn-info">عرض</a>
                        <a href="{{ route('camps.edit', $camp->id) }}" class="btn btn-sm btn-warning">تعديل</a>

                        <form action="{{ route('camps.destroy', $camp->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">لا توجد مخيمات</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection