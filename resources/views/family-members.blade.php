@extends('layouts.app')

@section('title', 'الرئيسية')

@section('content')
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> أفراد  </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        :root {
            --main-purple: #432daa;
        
        }

    
        .header-bar {
            background-color: rgba(58, 45, 135, 0.11);;
            padding: 12px 30px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        
.logout-link {
            color: var(--main-purple);
            text-decoration: none;
            font-weight: bold;
            font-size: 13px;
            background: transparent;
            padding: 6px 20px;
            border-radius: 20px;
            transition: 0.3s;
            border: 1px solid rgba(58,45,153,0.38);
            margin-left: 5px;
        }
        
        .family-info-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 25px;
            padding: 25px;
            max-width: 700px;
            margin: 30px auto;
            position: relative;
        }

        .info-item {
            margin-bottom: 10px;
            display: flex;
            gap: 10px;
            font-weight: 600;
        }

        .info-label {
            color: #111;
        }

        .info-value {
            color: #666;
        }

        
        .btn-add-member {
            background-color: var(--main-purple);
            color: white;
            border-radius: 12px;
            padding: 10px 40px;
            border: none;
            font-weight: 600;
            margin-bottom: 20px;
            transition: 0.3s;
        }

        .btn-add-member:hover {
            background-color: lab(33.02% 36.01 -58.58);
            color: white;
        }

        
        .table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 50px;
        }

        

        .table th {
            border: none;
            padding: 15px;
            font-size: 19px;
            color: #444;
            background-color: rgba(58, 45, 135, 0.11);;
        }

        .table td {
            vertical-align: middle;
            padding: 12px;
            border-bottom: 1px solid #f1f1f1;
        }

        
        .table input {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 4px 8px;
            width: 100%;
            font-size: 13px;
        }

        .action-icons i {
            margin: 0 8px;
            cursor: pointer;
            font-size: 18px;
        }

        .fa-eye {
            color: var(--main-purple);
        }

        .fa-trash-can {
            color: #ef4444;
        }

        .fa-circle-check {
            color: #10b981;
        }
           .modal-content {
            border-radius: 20px;
            border: none;
            padding: 20px;
        }
    
        footer {
            background-color: #e5e7eb;
            padding: 40px 20px;
            border-radius: 50px 50px 0 0;
            margin-top: 50px;
            text-align: center;
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

    <div class="container text-center mt-4">
        <h4 class="fw-bold mb-4">أفراد العائلة</h4>

        <div class="family-info-card shadow-sm text-start">
            <div class="row">
                <div class="col-md-8">
                    <div class="info-item"><span class="info-label">رب العائلة:</span> <span class="info-value">تسنيم
                            علام ابراهيم ضاهر</span></div>
                    <div class="info-item"><span class="info-label">رقم الهوية:</span> <span
                            class="info-value">555555555</span></div>
                </div>
                <div class="col-md-4">
                    <div class="info-item"><span class="info-label">رقم العائلة:</span> <span
                            class="info-value">F-111</span></div>
                    <div class="info-item"><span class="info-label">عدد الأفراد:</span> <span
                            class="info-value">5</span></div>
                </div>
            </div>
        </div>

        <button class="btn btn-add-member" onclick="addNewMemberRow()">إضافة فرد جديد</button>

        <div class="table-container">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>رقم الهوية</th>
                        <th>العمر</th>
                        <th>العملية</th>
                    </tr>
                </thead>
                <tbody id="membersTableBody">
                    <tr>
                        <td>1</td>
                        <td>تسنيم</td>
                        <td>555555555</td>
                        <td>22</td>
                        <td class="action-icons">
                            <i class="fa-solid fa-eye"></i>
                            <i class="fa-solid fa-trash-can" onclick="this.parentElement.parentElement.remove()"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
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
<div class="modal fade" id="pwModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold m-0">تغيير كلمة المرور</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <input type="password" class="form-control mb-3" placeholder="كلمة السر القديمة">
                <input type="password" class="form-control mb-3" placeholder="كلمة السر الجديدة">
                <input type="password" class="form-control mb-3" placeholder="تأكيد كلمة السر">
                <button class="btn-save-main w-100"
                    style="margin:0;background-color: #342daa; color: white;border: none;border-radius: 19px;padding:5px 19px;"
                    onclick="savePassword()">حفظ</button>
            </div>
        </div>
    </div>


    <script>
        let memberCount = 1;

    
        function addNewMemberRow() {
            memberCount++;
            const tbody = document.getElementById('membersTableBody');
            const row = tbody.insertRow();

            row.innerHTML = `
                <td>${memberCount}</td>
                <td><input type="text" id="name_${memberCount}" placeholder="الاسم"></td>
                <td><input type="text" id="id_${memberCount}" placeholder="رقم الهوية"></td>
                <td><input type="number" id="age_${memberCount}" placeholder="العمر"></td>
                <td class="action-icons">
                    <i class="fa-solid fa-circle-check" onclick="saveMember(this)"></i>
                    <i class="fa-solid fa-trash-can" onclick="this.parentElement.parentElement.remove()"></i>
                </td>
            `;
        }

        
        function saveMember(btn) {
            const row = btn.parentElement.parentElement;
            const name = row.querySelector('input[id^="name_"]').value;
            const idNum = row.querySelector('input[id^="id_"]').value;
            const age = row.querySelector('input[id^="age_"]').value;

            if (!name || !idNum) {
                alert("يرجى تعبئة البيانات الأساسية");
                return;
            }

            row.innerHTML = `
                <td>${row.cells[0].innerText}</td>
                <td>${name}</td>
                <td>${idNum}</td>
                <td>${age}</td>
                <td class="action-icons">
                    <i class="fa-solid fa-eye"></i>
                    <i class="fa-solid fa-trash-can" onclick="this.parentElement.parentElement.remove()"></i>
                </td>
            `;
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
@endsection