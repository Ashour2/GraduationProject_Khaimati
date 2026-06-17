@extends('layouts.app')

@section('title', 'الرئيسية')

@section('content')
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <title>خيمتي</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css"
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
              class="nav-link active"
              href="{{ route('home') }}"
              style="color: #342daa">الرئيسية</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#us">نبذة</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#why">لماذا</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('contact') }}">تواصل معنا</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('join') }}">الانضمام</a>
          </li>
        </ul>

        <a
          class="btn btn-outline-secondary rounded-pill px-4"
          style="color: #342daa; border-color: rgba(58, 45, 153, 0.38)"
          href="{{ route('signin') }}">
          تسجيل الدخول
        </a>
      </div>
    </div>
  </nav>

  <!-- ===== Hero ===== -->
  <section class="container py-5">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <h1 class="fw-bold mb-3">
          هنا يبدأ النظام… وهنا <br />تبدأ الإنسانية
        </h1>
        <p class="mb-4">
          لأن التنظيم يصنع فرقًا في حياة النازحين، <br />
          منصة خيمتي لإدارة المخيمات والمستفيدين، <br />والمساعدات بيسر
          وأمان.
        </p>
        <a href="{{ route('join') }}"
          class="btn rounded-pill px-5"
          style="border-color: rgba(58, 45, 153, 0.38); color: #342daa">
          الانضمام
        </a>
        <!-- <button href="{{ route('join') }}" class="btn  rounded-pill px-5" style="border-color: rgba(58, 45, 153, 0.38);color: #342daa">الانضمام</button> -->
      </div>
      <div class="col-lg-6">
        <img src="{{ asset('assets/images/img1 (1).jpeg') }}" class="img-fluid rounded-4" />
      </div>
    </div>
  </section>

  <!-- ===== About ===== -->
  <section class="container py-5">
    <div class="row align-items-center g-4">
      <div class="col-lg-6">
        <img
          src="{{ asset('assets/images/img1 (6).jpeg') }}"
          class="img-fluid rounded-4 ms-10"
          width="300" />
      </div>
      <div class="col-lg-6" id="us">
        <h2 class="fw-bold mb-3">من نحن؟</h2>
        <p>
          منصة ذكية وانسانية للإدارة مخيمات النزوح،تعمل على تنظيم بيانات<br />
          المستفيدين تنسيق الانشطة،وادارة المساعدات بسهولة وسرعة وشفافية.<br />
          هدفنا خلق مساحة أكثر امانا واستقرارا داخل المخيمات من خلال نظام<br />
          مبسط يدعم الفرق العاملة ويضمن وصول الخدمات لكل من يحتاجها.
        </p>
      </div>
    </div>
  </section>


  <section class="container text-center my-5 why" id="why">
    <h4 class="fw-bold mb-5">لماذا اخترتنا؟</h4>
    <div class="row g-4">
      <div class="col-md-4">
        <img src="{{ asset('assets/images/img1 (7).jpeg') }}" class="rounded-circle mb-3" />
        <h6 class="fw-bold">تنظيم شامل ودقيق</h6>
      </div>
      <div class="col-md-4">
        <img src="{{ asset('assets/images/img(1)8.jpeg') }}" class="rounded-circle mb-3" />
        <h6 class="fw-bold">سهولة ووضوح</h6>
      </div>
      <div class="col-md-4">
        <img src=" {{ asset('assets/images/img(1)9.jpeg') }} " class="rounded-circle mb-3" />
        <h6 class="fw-bold">دعم إنساني حقيقي</h6>
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
  </div>
  <div class="mt-4"></div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

@endsection