<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'خيمتي')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
</head>
<body>

    <div class="sidebar">
        <div class="logo-box">
            <img src="{{ asset('assets/images/img1__5_-removebg-preview (1).png') }}" alt="Logo">
        </div>
        <nav class="mt-4">
            @yield('sidebar-links')
        </nav>
    </div>

    <div class="main-wrapper">
        <div class="top-bar">
            <div class="user-name small fw-bold">{{ Auth::user()->name }} : @yield('role-label')</div>
            <div class="d-flex align-items-center gap-3">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="logout-link small">تسجيل الخروج</button>
                </form>
                <i class="fa-solid fa-gear text-muted" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#pwModal"></i>
            </div>
        </div>

        <div class="content-body">
            @if(session('success'))
                <div class="alert alert-success text-center rounded-pill mt-3">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger text-center rounded-pill mt-3">{{ session('error') }}</div>
            @endif
            @yield('content')
        </div>

    </div>

    {{-- Modal تغيير كلمة المرور --}}
    <div class="modal fade" id="pwModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0">تغيير كلمة المرور</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <input type="password" class="form-control mb-3" placeholder="كلمة السر الجديدة">
                <input type="password" class="form-control mb-3" placeholder="تأكيد كلمة السر">
                <button class="btn-save w-100" style="margin:0">حفظ</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
