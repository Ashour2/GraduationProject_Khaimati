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
            <a class="nav-link {{ Request::routeIs('representative.dashboard') ? 'active' : '' }}"
                href="{{ route('representative.dashboard') }}">
                <i class="bi bi-speedometer2"></i> لوحة التحكم
            </a>
            <a class="nav-link {{ Request::routeIs('representative.families.*') ? 'active' : '' }}"
                href="{{ route('representative.families.index') }}">
                <i class="bi bi-people"></i> النازحون
            </a>
            <a class="nav-link {{ Request::routeIs('representative.distributions.*') ? 'active' : '' }}"
                href="{{ route('representative.distributions.index') }}">
                <i class="bi bi-box-seam"></i> توزيع المساعدات
            </a>
            <a class="nav-link {{ Request::routeIs('representative.inventory.*') ? 'active' : '' }}"
                href="{{ route('representative.inventory.index') }}">
                <i class="bi bi-archive"></i> المخزون
            </a>
            <a class="nav-link {{ Request::routeIs('representative.supporters.*') ? 'active' : '' }}"
                href="{{ route('representative.supporters.index') }}">
                <i class="bi bi-heart"></i> الداعمون
            </a>
            <a class="nav-link {{ Request::routeIs('representative.reports.*') ? 'active' : '' }}"
                href="{{ route('representative.reports.index') }}">
                <i class="bi bi-file-earmark-text"></i> التقارير
            </a>
            <a class="nav-link {{ Request::routeIs('representative.data-entries.*') ? 'active' : '' }}"
                href="{{ route('representative.data-entries.index') }}">
                <i class="bi bi-person-badge"></i> مدخلي البيانات
            </a>
            <a class="nav-link {{ Request::routeIs('representative.change-logs.*') ? 'active' : '' }}"
                href="{{ route('representative.change-logs.index') }}">
                <i class="bi bi-clock-history"></i> سجل التغييرات
            </a>
        </nav>
    </div>

    <div class="main-wrapper">
        <div class="top-bar">
            <div class="user-name small fw-bold">{{ Auth::user()->name }} : المشرف</div>
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
            @yield('content')
        </div>

        <footer class="pt-4 pb-3" style="background: rgba(58, 45, 135, 0.11); border-radius: 19px;">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/img1__5_-removebg-preview (1).png') }}" width="60" />
                    <h3>خيمتي</h3>
                </a>
                <div class="container py-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <p>📍 الموقع: غزة – فلسطين</p>
                            <p>✉ البريد الالكتروني: info@campflow.org</p>
                        </div>
                        <div class="col-md-6 text-md-start">
                            <p>📞 رقم التواصل: +970-000-000</p>
                            <p>⏰ ساعات العمل: 4:00 – 9:00</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-dark"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-dark"><i class="fab fa-envelope fa-lg"></i></a>
                        <a href="#" class="text-dark"><i class="fab fa-linkedin fa-lg"></i></a>
                        <a href="#" class="text-dark"><i class="fab fa-facebook fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </footer>
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
