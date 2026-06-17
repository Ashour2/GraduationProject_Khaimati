@extends('layouts.app')

@section('title', 'الرئيسية')

@section('content')
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل بيانات الهوية - خيمتي</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #fff;
            overflow-x: hidden;

        }

        :root {
            --main-purple: #342daa;

        }


        .header-bar {
            background-color: rgba(58, 45, 135, 0.11);
            ;
            padding: 10px 30px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logout-link {
            color: var(--main-purple);
            text-decoration: none;
            font-size: 14px;
            background: transparent;
            border: 1px solid rgba(58, 45, 153, 0.38);
            ;
            padding: 5px 20px;
            border-radius: 19px;
        }


        .main-wrapper {
            display: flex;
            min-height: 100vh;
            padding: 20px 40px;
        }


        .image-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;

            padding: 40px;
        }

        .image-side img {
            max-width: 600px;
            height: auto;
        }


        .vertical-line {
            position: absolute;
            left: 0;

            top: 10%;
            bottom: 10%;
            width: 1.5px;
            background-color: rgba(0, 0, 0, 0.05);
        }


        .form-side {
            flex: 1.5;
            position: relative;
            padding: 40px 60px 40px 20px;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 25px;
            color: #111;
        }

        .custom-row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }



        .options {
            display: flex;
            gap: 20px;
        }


        .btn-save-main {
            background-color: var(--main-purple);
            color: white;
            border-radius: 15px;
            padding: 12px 80px;
            border: none;
            font-weight: 600;
            display: block;
            margin: 40px auto 0;
        }


        .modal-content {
            border-radius: 20px;
            border: none;
            padding: 20px;
        }

        .success-icon {
            color: #10b981;
            font-size: 50px;
            margin-bottom: 15px;
        }


        footer {
            background-color: #e5e7eb;
            padding: 40px;
            border-radius: 60px 60px 0 0;
            margin-top: 50px;
            text-align: center;
            font-size: 14px;
        }

        footer p,
        i {
            font-size: 16px;
        }

        .content-section {
            padding: 40px 0;
        }

        .section-header {
            text-align: center;
            font-weight: 700;
            margin-bottom: 30px;
            color: #222;
        }


        .form-group-custom {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-group-custom label {
            width: 140px;

            font-size: 14px;
            font-weight: 500;
            color: #444;
            margin-bottom: 0;
        }

        .input-wrapper {
            flex: 1;
            position: relative;
        }

        .form-control,
        .form-select {
            border-radius: 10px !important;
            border: 1px solid #e2e2e2;
            padding: 8px 15px;
            font-size: 14px;
            background-color: #fff;
        }


        .input-wrapper i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #b0b0b0;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <header class="header-bar">

        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('home') }}" class="logout-link small">الرجوع</a>
        </div>
    </header>

    <div class="main-wrapper">


        <div class=" form-side">
            @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form id="familyForm" action="{{ route('join.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h5 class="section-header">تسجيل بيانات المخيم</h5>

                <div class="form-group-custom">
                    <label>اسم المخيم</label>
                    <div class="input-wrapper">
                        <input type="text" name="camp_name" class="form-control">
                    </div>
                </div>

                <div class="form-group-custom">
                    <label>المحافظة</label>
                    <div class="input-wrapper">
                        <select name="governorate" class="form-select">
                            <option value="">عرض القائمة</option>
                            <option>رفح</option>
                            <option>غزة</option>

                        </select>
                    </div>
                </div>

                <div class="form-group-custom">
                    <label>العنوان</label>
                    <div class="input-wrapper">
                        <input type="text" name="location" class="form-control">
                    </div>
                </div>

                <div class="form-group-custom">
                    <label>عدد العائلات</label>
                    <div class="input-wrapper"><input type="number" name="families_count" class="form-control"></div>
                </div>

                <h5 class="section-header mt-5">معلومات المسؤول</h5>

                <div class="form-group-custom">
                    <label>الاسم بالكامل</label>
                    <div class="input-wrapper"><input type="text" name="rep_name" class="form-control"></div>
                </div>

                <div class="form-group-custom">
                    <label>الجنس</label>
                    <div class="input-wrapper">
                        <select name="gender" class="form-select">
                            <option value="">عرض القائمة</option>
                            <option value="male">ذكر</option>
                            <option value="female">أنثى</option>
                        </select>
                    </div>
                </div>

                <div class="form-group-custom">
                    <label>رقم الهوية</label>
                    <div class="input-wrapper"><input type="text" name="national_id_no" class="form-control"></div>
                </div>

                <div class="form-group-custom">
                    <label>المحافظة</label>
                    <div class="input-wrapper"><input type="text" name="rep_governorate" class="form-control"></div>
                </div>

                <div class="form-group-custom">
                    <label>صورة الهوية</label>
                    <div class="input-wrapper">
                        <input type="file" name="national_id_img" id="file1" hidden onchange="updateText(this)">
                        <i class="fa-solid fa-paperclip" onclick="triggerFile('file1')"></i>
                        <input type="file" id="file1" hidden onchange="updateText(this)">
                    </div>
                </div>

                <div class="form-group-custom">
                    <label>صورة شخصية</label>
                    <div class="input-wrapper">
                        <input type="file" name="personal_img" id="file2" hidden onchange="updateText(this)">
                        <i class="fa-solid fa-paperclip" onclick="triggerFile('file2')"></i>
                        <input type="file" id="file2" hidden onchange="updateText(this)">
                    </div>
                </div>

                <div class="form-group-custom">
                    <label>البريد الإلكتروني</label>
                    <div class="input-wrapper"><input type="email" name="email" class="form-control"></div>
                </div>

                <div class="form-group-custom">
                    <label>رقم الهاتف</label>
                    <div class="input-wrapper"><input type="tel" name="phone" class="form-control"></div>
                </div>

                <div class="form-group-custom">
                    <label>ورقة اعتماد مندوب المخيم</label>
                    <div class="input-wrapper">
                        <input type="file" name="verification_img" id="file3" hidden onchange="updateText(this)">
                        <i class="fa-solid fa-paperclip" onclick="triggerFile('file3')"></i>
                        <input type="file" id="file3" hidden onchange="updateText(this)">
                    </div>
                </div>

                <button type="submit" class="btn btn-save-main shadow">إرسال</button>
            </form>
            <div class="vertical-line"></div>
        </div>

        <div class="image-side ">
            <img src="{{ asset('assets/images/img1 (4).jpeg') }}" alt="UI Image">
            <!-- IMAGE/img1 (4).jpeg -->
        </div>
    </div>



    <div class="modal fade" id="pwModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0">تغيير كلمة المرور</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <input type="password" class="form-control mb-3" placeholder="كلمة السر القديمة">
                <input type="password" class="form-control mb-3" placeholder="كلمة السر الجديدة">
                <input type="password" class="form-control mb-3" placeholder="تأكيد كلمة السر">
                <button class="btn-save-main w-100" style="margin:0" onclick="savePassword()">حفظ</button>
            </div>
        </div>
    </div>


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

    <div class="mt-4"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function savePassword() {
            alert("تم تغيير كلمة المرور بنجاح");
            location.reload();
        }

        function triggerFile(id) {
            document.getElementById(id).click();
        }

        function updateText(input) {
            if (input.files && input.files.length > 0) {
                input.parentElement.querySelector('input[type="text"]').value = input.files[0].name;
            }
        }
    </script>
</body>

</html>
@endsection