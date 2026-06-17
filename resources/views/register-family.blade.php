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
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

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
            background-color: rgba(58, 45, 135, 0.11);;
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
            border: 1px solid rgba(58, 45, 153, 0.38);;
            padding: 5px 20px;
            border-radius: 19px;
        }

    
        .main-wrapper {
            display: flex;
            min-height: 100vh;
        }

    
        .image-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            
            padding: 40px;
        }

        .image-side img {
            max-width:600px;
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

        .custom-row label {
            width: 150px;
            font-size: 14px;
            color: #4b5563;
        }

        .custom-row .form-control,
        .custom-row .form-select {
            flex: 1;
            border-radius: 12px;
            border: 1px solid #d1d5db;
            padding: 10px;
            font-size: 14px;
        }

    
        .radio-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-size: 14px;
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
        footer p,i{
            font-size: 16px;
        }
    </style>
</head>

<body>

    <header class="header-bar">
        <div class="user">محمد سلمان : مدخل بيانات</div>
        <div class="d-flex align-items-center gap-3">
            <a href="الصفحة الرئيسية.html" class="logout-link small">تسجيل الخروج</a>
            <i class="fa-solid fa-gear text-muted" style="cursor:pointer" data-bs-toggle="modal"
                data-bs-target="#pwModal"></i>
        </div>
    </header>

    <div class="main-wrapper">
        <div class=" form-side">
            <form id="familyForm">
                <h5 class="section-title">تسجيل بيانات الهوية</h5>
            
                <div class="custom-row">
                    <label>الاسم بالكامل</label>
                    <input type="text" class="form-control required-field" id="fullName">
                </div>
            
                <div class="custom-row">
                    <label>الجنس</label>
                    <select class="form-select required-field" id="gender">
                        <option value="">عرض القائمة</option>
                        <option>ذكر</option>
                        <option>أنثى</option>
                    </select>
                </div>
            
                <div class="custom-row">
                    <label>رقم الهوية</label>
                    <input type="number" class="form-control required-field" id="idNum">
                </div>
            
                <div class="custom-row">
                    <label>الحالة الاجتماعية</label>
                    <select class="form-select required-field" id="status">
                        <option value="">عرض القائمة</option>
                        <option>أعزب</option>
                        <option>متزوج</option>
                    </select>
                </div>
            
                <div class="custom-row">
                    <label>مكان السكن الأصلي</label>
                    <input type="text" class="form-control required-field" id="address">
                </div>
            
                <div class="custom-row">
                    <label>المحافظة</label>
                    <select class="form-select required-field" id="city">
                        <option value="">عرض القائمة</option>
                        <option>غزة</option>
                        <option>خانيونس</option>
                    </select>
                </div>
            
                <h5 class="section-title mt-5">تسجيل معلومات صحية</h5>
                <div class="radio-group">
                    <span>هل هي/هو مصاب أو يعاني من مرض مزمن؟</span>
                    <div class="options">
                        <label><input type="radio" name="r1"> نعم</label>
                        <label><input type="radio" name="r1" checked> لا</label>
                    </div>
                </div>
                <div class="radio-group">
                    <span>هل هي/هو معاق جسدياً؟</span>
                    <div class="options">
                        <label><input type="radio" name="r2"> نعم</label>
                        <label><input type="radio" name="r2" checked> لا</label>
                    </div>
                </div> 
                <div class="radio-group">
                    <span>هل هي/هو تحتاج إلى أي معدات طبية محددة؟</span>
                    <div class="options">
                        <label><input type="radio" name="r3"> نعم</label>
                        <label><input type="radio" name="r3" checked> لا</label>
                    </div>
                </div>
                <div class="radio-group">
                    <span>إذا "نعم" اذكر ما هي؟</span>
                    
                </div>
                <div class="radio-group">
                    <span>هل تحتاج هي/هو حفاضات؟</span>
                    <div class="options">
                        <label><input type="radio" name="r4"> نعم</label>
                        <label><input type="radio" name="r4" checked> لا</label>
                    </div>
                </div>
                <div class="radio-group">
                    <p>إذا كانت أنثى:</p>
                    <span> هل هي حامل؟</span>
                    <div class="options">
                        <label><input type="radio" name="r5"> نعم</label>
                        <label><input type="radio" name="r5" checked> لا</label>
                    </div>
                    <span>هل هي مرضعة؟</span>
                    <div class="options">
                        <label><input type="radio" name="r6"> نعم</label>
                        <label><input type="radio" name="r6" checked> لا</label>
                    </div>
                </div>
                     <h3 class="form-section-title text-start">بيانات التواصل</h3>

                <div class="row mb-3 align-items-center">
                    <label class="col-sm-3 text-end form-label-custom">رقم الهاتف</label>
                    <div class="col-sm-8"><input type="text" class="form-control" placeholder="رقم الهاتف"></div>
                </div>
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-3 text-end form-label-custom">رقم الهاتف البديل</label>
                    <div class="col-sm-8"><input type="text" class="form-control" placeholder="رقم الهاتف البديل"></div>
                </div>
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-3 text-end form-label-custom">البريد الإلكتروني</label>
                    <div class="col-sm-8"><input type="email" class="form-control" placeholder="البريد الإلكتروني">
                    </div>
                </div>

                
                 
            
                <button type="button" class="btn-save-main" onclick="validateAndSave()">حفظ</button>
            </form>
            <div class="vertical-line"></div>
        </div>

        <div class="image-side">
            <img src="{{ asset('assets/images/img1 (4).jpeg') }}" alt="UI Image"> 
            
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content text-center">
                <h6 class="fw-bold mb-3">تم حفظ العائلة بنجاح</h6>
                <i class="fa-solid fa-circle-check success-icon"></i>
                <button class="btn-save-main w-100 mt-2" style="padding:10px" onclick="resetForm()">اضافة فرد
                    جديد</button>
            </div>
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
    
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/img1__5_-removebg-preview (1).png') }}" width="60" />
                <h3>خيمتي</h3>
            </a>
    
            <div class="d-flex justify-content-between align-items-center flex-wrap">
    
                <div class="container py-4">
                    <div class="row g-4">
                        <div class="col-md-6 text-md-start">
                            <p>📍 الموقع :غزة – فلسطين</p>
                            <p>✉ البريد الالكتروني : info@campflow.org</p>
                        </div>
    
                        <div class="col-md-6 text-md-start">
                            <p>📞 رقم التواصل : +970-000-000</p>
                            <p>⏰ ساعات العمل: 4:00 – 9:00</p>
                        </div>
                    </div>
    
                    <div class="d-flex gap-5">
                        <div class="d-flex gap-3">
                            <a href="#" class="text-dark"><i class="fab fa-facebook fa-lg"></i></a>
                            <a href="#" class="text-dark"><i class="fab fa-linkedin fa-lg"></i></a>
                            <a href="#" class="text-dark"><i class="fab fa-envelope fa-lg"></i></a>
                            <a href="#" class="text-dark"><i class="fab fa-instagram fa-lg"></i></a>
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
        
        function validateAndSave() {
            const fields = document.querySelectorAll('.required-field');
            let allFilled = true;

            fields.forEach(field => {
                if (field.value.trim() === "") {
                    allFilled = false;
                    field.style.borderColor = "red";
                } else {
                    field.style.borderColor = "#d1d5db";
                }
            });

            if (allFilled) {
                
                var myModal = new bootstrap.Modal(document.getElementById('successModal'));
                myModal.show();
            } else {
                alert("الرجاء تعبئة كافة الحقول المطلوبة قبل الحفظ.");
            }
        }

        
        function resetForm() {
            document.getElementById('familyForm').reset();
            const modalElement = document.getElementById('successModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            modalInstance.hide();
            window.scrollTo(0, 0);
        }

    
        function savePassword() {
            alert("تم تغيير كلمة المرور بنجاح");
            location.reload(); 
        }
    </script>
</body>

</html>
@endsection