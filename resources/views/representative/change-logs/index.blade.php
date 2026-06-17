@extends('layouts.representative')

@section('title', 'سجل التغييرات')

@section('content')
<div class="container main-container">
    <h4 class="mb-4 fw-bold text-center">سجل التغييرات</h4>

    <div class="table-card">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>التاريخ والوقت</th>
                    <th>المستخدم</th>
                    <th>العملية</th>
                    <th>الهدف</th>
                    <th>التفاصيل</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y') }}<br>
                        {{ \Carbon\Carbon::parse($log->created_at)->format('h:i A') }}</td>
                    <td>{{ $log->user->name ?? '---' }}</td>
                    <td>{{ $log->operation_type }}</td>
                    <td>{{ $log->target_type }} #{{ $log->target_id }}</td>
                    <td>
                        <a href="{{ route('representative.change-logs.show', $log->id) }}">
                            <i class="bi bi-eye text-primary fs-5"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">لا يوجد سجلات</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
