@extends('layouts.app')

@section('title', 'الرئيسية')

@section('content')
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <title>تسجيل الدخول</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css"
    rel="stylesheet" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
    rel="stylesheet" />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap"
    rel="stylesheet" />
  <style>
    .nav-link {
      margin: 0 19px;
    }

    .why img {
      width: 290px;
      height: 290px;
      object-fit: cover;
    }

    footer {
      background: #f1f1f7;
    }

    body {
      font-family: "Cairo", sans-serif;
    }


    .login-form .form-control {
      border-radius: 20px;
      padding: 12px;
    }

    .input-group-text {
      border-radius: 20px;
    }


    .btn-login {
      background-color: #3b2f8f;
      color: #fff;
      padding: 12px;
    }

    .btn-login:hover {
      background-color: #2f2472;
    }

    .line {
      border-left: 3px solid #eee;
      height: 410px;
    }
  </style>

</head>

<body>
  <nav
    class="navbar navbar-expand-lg rounded-bottom px-4 mx-auto"
    style="background: rgba(58, 45, 135, 0.11)">
    <div class="container-fluid">
      <a
        class="navbar-brand d-flex align-items-center gap-2"
        href="{{ route('home') }}">
        <img src="{{ asset('assets/images/img1__5_-removebg-preview (1).png') }}" width="40" />
        <strong>خيمتي</strong>
      </a>

      <button
        class="navbar-toggler"
        data-bs-toggle="collapse"
        data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a
              class="nav-link "
              href="{{ route('home') }}">الرئيسية</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">نبذة</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">لماذا</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('contact') }}">تواصل معنا</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('join') }}" style="color: #342daa">الانضمام</a>
          </li>
        </ul>

        <a
          href="{{ route('signin') }}"
          class="btn btn-outline-secondary rounded-pill px-4"
          style="color: #342daa; border-color: rgba(58, 45, 153, 0.38)">
          تسجيل الدخول
        </a>
      </div>
    </div>
  </nav>
  <section class="py-5">
    <div class="container">
      <div class="row align-items-center g-5 d-flex justify-content-between">
        <div class="col-lg-6 line">
          <h4 class="fw-bold mb-4 text-center">تسجيل الدخول</h4>

          @if($errors->any())
          <div class="alert alert-danger text-center">
            {{ $errors->first() }}
          </div>
          @endif

          <form class="login-form" action="{{ route('signin.post') }}" method="POST">
            @csrf
            <div class="input-group mb-3 mt-4">
              <span class="input-group-text bg-white mt-4"><i class="bi bi-person"></i></span>
              <input
                type="email"
                name="email"
                class="form-control mt-4"
                placeholder="البريد الإلكتروني"
                value="{{ old('email') }}"
                required />
            </div>

            <div class="input-group mb-4 mt-4">
              <span class="input-group-text bg-white mt-4"><i class="bi bi-lock"></i></span>
              <input
                type="password"
                name="password"
                class="form-control mt-4"
                placeholder="كلمة المرور"
                required />
            </div>

            <button type="submit" class="btn btn-login w-100 rounded-pill mt-4">
              تسجيل الدخول
            </button>
          </form>
        </div>

        <div class="col-lg-6 text-center">
          <img
            src="{{ asset('assets/images/img1__2_-removebg-preview.png') }}"
            class="img-fluid"
            alt="login" />
        </div>
      </div>
    </div>
  </section>


  <footer class="pt-4 pb-3 " style="background: rgba(58, 45, 135, 0.11); border-radius: 19px;">
    <div class="container-fluid">

      <a
        class="navbar-brand d-flex align-items-center gap-2"
        href="{{ route('home') }}">
        <img src="{{ asset('assets/images/img1__5_-removebg-preview (1).png') }}" width="60" />
        <h3>خيمتي</h3>
      </a>

      <div
        class="d-flex justify-content-between align-items-center flex-wrap">

        <div class="container py-4">
          <div class="row g-4">
            <div class="col-md-6">
              <p>📍 الموقع : غزة – فلسطين</p>
              <p>✉ البريد الالكتروني : {{ $communications['email'] ?? 'info@campflow.org' }}</p>
            </div>

            <div class="col-md-6 text-md-start">
              <p>📞 رقم التواصل : {{ $communications['phone'] ?? '+970-000-000' }}</p>
              <p>⏰ ساعات العمل: 4:00 – 9:00</p>
            </div>
          </div>

          <div
            class="d-flex gap-5">
            <div class="d-flex gap-3">
              @php use Illuminate\Support\Str; @endphp

              <a href="{{ Str::startsWith($communications['facebook'] ?? '', ['http://', 'https://']) 
                ? $communications['facebook'] 
                : 'https://' . ($communications['facebook'] ?? '#') }}"
                class="text-dark"
                target="_blank">

                <i class="fab fa-facebook fa-lg"></i>
              </a>


              <a href="{{ Str::startsWith($communications['linkedin'] ?? '', ['http://', 'https://']) ? $communications['linkedin'] : 'https://' . ($communications['linkedin'] ?? '#') }}"
                class="text-dark"
                target="_blank">
                <i class="fab fa-linkedin fa-lg"></i>
              </a>

              <a href="mailto:{{ $communications['email'] ?? 'info@campflow.org' }}" class="text-dark">
                <i class="fab fa-envelope fa-lg"></i>
              </a>

              <a href="{{ Str::startsWith($communications['whatsapp'] ?? '', ['http://', 'https://']) 
                ? $communications['whatsapp'] 
                : 'https://' . ($communications['whatsapp'] ?? '#') }}"
                class="text-dark"
                target="_blank">

                <i class="fab fa-whatsapp fa-lg"></i>
              </a>
            </div>
            <span class="mb-2 mb-md-0" style=text-align:center> 2025All Rights Reserved ©</span>

          </div>
        </div>
      </div>
    </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

@endsection