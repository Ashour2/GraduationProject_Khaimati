@extends('layouts.app')

@section('title', 'الرئيسية')

@section('content')
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> العائلة</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
        }

        :root {
            --main-purple: #342daa;
            
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            background: rgba(58, 45, 135, 0.11);;
            border-bottom: 1px solid #eee;
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
            margin-left: 10px;
        }

        .main-container {
            padding: 40px 15px;
            text-align: center;
        }

        .btn-add {
            background-color: var(--main-purple);
            color: white;
            border-radius: 19px;
            padding: 12px 40px;
            border: none;
            font-weight: 600;
            margin-bottom: 25px;
            transition: 0.3s;
        }

        .btn-add:hover {
            background-color: #3730a3;
            transform: translateY(-2px);
            color: white;
        }

        .search-container {
            max-width: 500px;
            margin: 0 auto 30px;
            position: relative;
        }

        .search-container input {
            border-radius: 25px;
            padding: 12px 40px 12px 20px;
            border: 1px solid #ddd;
        }

        .search-container i {
            position: absolute;
            right: 15px;
            top: 15px;
            color: #999;
        }

        .table-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        
        .table th {
            border: none;
            color: #444;
            padding: 15px;
            font-size: 15px;
            background-color: rgba(58, 45, 135, 0.11);
        }

        .table td {
            vertical-align: middle;
            padding: 12px;
            color: #666;
            border-bottom: 1px solid #f1f1f1;
        }

        
        .table input {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 5px 10px;
            width: 100%;
            font-size: 13px;
        }

        .table input:focus {
            outline: none;
            border-color: var(--main-purple);
            box-shadow: 0 0 5px rgba(67, 56, 202, 0.2);
        }

        .action-btns i {
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

        .fa-check-circle {
            color: #10b981;
            font-size: 22px;
        }
        .modal-content {
            border-radius: 20px;
            border: none;
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="top-bar">
        <div class="user-name small fw-bold">محمد سلمان : مدخل بيانات</div>
        <div class="d-flex align-items-center">
            
            <a href="الصفحة الرئيسية.html" class="logout-link small">تسجيل الخروج</a>
            <i class="fa-solid fa-gear text-muted" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#pwModal"></i>
        </div>
    </div>

    <div class="container main-container">
        <h4 class="mb-4 fw-bold">لوحة إدخال البيانات</h4>

        <button class="btn btn-add" onclick="addNewRow()">
            إضافة عائلة جديدة 
        </button>

        <div class="search-container">
            <input type="text" id="searchInput" class="form-control" placeholder="بحث باسم العائلة أو الرقم...">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>

        <div class="table-card">
            <table class="table mb-0" id="familyTable">
                <thead>
                    <tr>
                        <th style="width: 15%;">رقم العائلة</th>
                        <th style="width: 35%;">الاسم</th>
                        <th style="width: 12%;">عدد الأفراد</th>
                        <th style="width: 12%;">عدد الذكور</th>
                        <th style="width: 12%;">عدد الإناث</th>
                        <th style="width: 14%;">العملية</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr>
                        <td>F-111</td>
                        <td>تسنيم علام ابراهيم ضاهر</td>
                        <td>5</td>
                        <td>3</td>
                        <td>2</td>
                        <td class="action-btns">
                            <i class="fa-solid fa-eye"></i>
                            <i class="fa-solid fa-trash-can" onclick="this.parentElement.parentElement.remove()"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
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
    <footer class="pt-4 pb-3 " style="background: rgba(58, 45, 135, 0.11); border-radius: 19px;">
        <div class="container-fluid">
    
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/img1__5_-removebg-preview (1).png') }}" width="60" />
                <h3>خيمتي</h3>
            </a>
    
            <div class="d-flex justify-content-between align-items-center flex-wrap">
    
                <div class="container py-4">
                    <div class="row g-4">
                        <div class="col-md-6">
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

    <script>
        
        document.getElementById('searchInput').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#tableBody tr");
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? "" : "none";
            });
        });

        function addNewRow() {
            let table = document.getElementById('tableBody');
            let row = table.insertRow(0); 
            row.classList.add('editing-row');

            row.innerHTML = `
                <td><input type="text" placeholder="F-000" id="newId"></td>
                <td><input type="text" placeholder="الاسم بالكامل" id="newName"></td>
                <td><input type="number" placeholder="0" id="newTotal"></td>
                <td><input type="number" placeholder="0" id="newMale"></td>
                <td><input type="number" placeholder="0" id="newFemale"></td>
                <td class="action-btns text-center">
                    <i class="fa-solid fa-check-circle" title="تأكيد الحفظ" onclick="saveRow(this)"></i>
                    <i class="fa-solid fa-trash-can" title="إلغاء" onclick="this.parentElement.parentElement.remove()"></i>
                </td>
            `;

            
            document.getElementById('newId').focus();
        }

    
        function saveRow(btn) {
            let row = btn.parentElement.parentElement;
            let id = document.getElementById('newId').value;
            let name = document.getElementById('newName').value;
            let total = document.getElementById('newTotal').value;
            let male = document.getElementById('newMale').value;
            let female = document.getElementById('newFemale').value;

        
            if (id === "" || name === "") {
                alert("يرجى إدخال رقم العائلة والاسم");
                return;
            }

        
            row.innerHTML = `
                <td>${id}</td>
                <td>${name}</td>
                <td>${total}</td>
                <td>${male}</td>
                <td>${female}</td>
                <td class="action-btns">
                    <i class="fa-solid fa-eye"></i>
                    <i class="fa-solid fa-trash-can" onclick="this.parentElement.parentElement.remove()"></i>
                </td>
            `;
            row.classList.remove('editing-row');
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