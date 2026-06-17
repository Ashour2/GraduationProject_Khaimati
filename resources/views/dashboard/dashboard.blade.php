@extends('layouts.app')

@section('title', 'لوحة تحكم الادمن')

@section('content')
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>

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
            <a href="{{ route('dashboard') }}" class="nav-link {{ (($section ?? '') == 'dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i> لوحة التحكم
            </a>
            <a href="{{ route('camps.index') }}" class="nav-link {{ (($section ?? '') == 'camps') ? 'active' : '' }}">
                <i class="bi bi-houses"></i> المخيمات
            </a>
            <a href="{{ route('requests.index') }}"
                class="nav-link {{ (($section ?? '') == 'requests') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i> الطلبات
            </a>
            <div class="nav-link" onclick="showPage('reports', this)"><i class="bi bi-file-earmark-bar-graph"></i>
                التقارير</div>
            <a href="{{ route('supporters.index') }}" class="nav-link {{ (($section ?? '') == 'institutionsSection') ? 'active' : '' }}">
                <i class="bi bi-building"></i> المؤسسات
            </a>
            <a href="{{ route('users.index') }}" class="nav-link {{ (($section ?? '') == 'users') ? 'active' : '' }}">
                <i class="bi bi-person-check"></i> المستخدمين
            </a>
            <a href="{{ route('data-entries.create') }}" class="nav-link {{ (($subsection ?? '') == 'create-data-entry') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i> إضافة مدخل بيانات
            </a>
            <a href="{{ route('communications.edit') }}" class="nav-link {{ (($section ?? '') == 'contact') ? 'active' : '' }}">
                <i class="bi bi-person-check"></i> التواصل
            </a>
            <a href="{{ route('messages.index') }}" class="nav-link {{ (($section ?? '') == 'messages' || ($section ?? '') == 'message-details') ? 'active' : '' }}">
                <i class="bi bi-chat-dots"></i> الرسائل
            </a>
        </nav>
    </div>


    <div class="main-wrapper">

        <div class="top-bar">
            <div class="user-name small fw-bold">
                {{ auth()->user()->name ?? 'مستخدم' }} :
                @if(auth()->user()?->role === 'admin')
                Administrator
                @elseif(auth()->user()?->role === 'representative')
                Representative
                @elseif(auth()->user()?->role === 'data_entry')
                Data Entry
                @else
                User

                @endif
            </div>
            <div class="d-flex align-items-center">

                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="logout-link small border-0">
                        تسجيل الخروج
                    </button>
                </form>
                <a href="{{ route('users.password.form', auth()->id()) }}">
                    <i class="fa-solid fa-gear text-muted" style="cursor:pointer"></i>
                </a>
            </div>
        </div>


        <div class="content-body">

            <div id="dashboard" class="page-section {{ (($section ?? '') == 'dashboard') ? 'active' : '' }}">
                <h4 class="text-center mb-5 fw-bold">لوحة التحكم</h4>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3>{{ $campsCount ?? 0 }}</h3>
                            <p>مخيم</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3>{{ $adminsCount ?? 0 }}</h3>
                            <p>مشرفين</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3>{{ $representativesCount ?? 0 }}</h3>
                            <p>الممثلين</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3>{{ $dataEntriesCount ?? 0 }}</h3>
                            <p>إدخال بيانات</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3>{{ $supportersCount ?? 0 }}</h3>
                            <p>المؤسسات</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3>{{ $messagesCount ?? 0 }}</h3>
                            <p>الرسائل</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="camps" class="page-section {{ (($section ?? '') == 'camps') ? 'active' : '' }}">
                <h4 class="text-center mb-4 fw-bold">المخيمات</h4>
                <div class="custom-table table-responsive">
                    <table class="table text-center align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المخيم</th>
                                <th>اسم المندوب</th>
                                <th>العنوان</th>
                                <th>المحافظة</th>
                                <th>عدد العائلات</th>
                                <th>الحالة</th>
                                <th>العملية</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($camps as $camp)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $camp->name }}</td>
                                <td>{{ $camp->representative?->name ?? 'لا يوجد مندوب' }}</td>
                                <td>{{ $camp->location }}</td>
                                <td>{{ $camp->governorate }}</td>
                                <td>{{ $camp->families_count }}</td>
                                <td>{{ $camp->status }}</td>
                                <td>
                                    <a href="{{ route('camps.show', $camp->id) }}">
                                        <i class="bi bi-eye text-primary mx-1" style="cursor:pointer"></i>
                                    </a>

                                    <a href="{{ route('camps.edit', $camp->id) }}">
                                        <i class="bi bi-pencil-square text-secondary mx-1" style="cursor:pointer"></i>
                                    </a>

                                    <a href="{{ route('representatives.replace.form', $camp->id) }}">
                                        <i class="bi bi-person-arms-up text-dark mx-1" style="cursor:pointer" title="تبديل مندوب المخيم"></i>
                                    </a>

                                    <!-- <i class="bi bi-shield-lock text-dark mx-1" style="cursor:pointer"
                                        data-bs-toggle="modal" data-bs-target="#authModal"></i> -->

                                    <a href="{{ route('representatives.showByCamp', $camp->id) }}">
                                        <i class="bi bi-bar-chart text-info mx-1" style="cursor:pointer"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">لا توجد مخيمات</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="camp-info" class="page-section {{ (($subsection ?? '') == 'show-camp') ? 'active' : '' }}">
                <h4 class="text-center mb-5 fw-bold">معلومات المخيم</h4>
                @if(isset($selectedCamp))
                <div class="mx-auto" style="max-width: 600px;">
                    <div class="row align-items-center mb-3">
                        <div class="col-3 text-start"><label>اسم المخيم</label></div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-custom"
                                value="{{ $selectedCamp->name }}" readonly>
                        </div>
                    </div>

                    <div class="row align-items-center mb-3">
                        <div class="col-3 text-start"><label>اسم المندوب</label></div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-custom"
                                value="{{ $selectedCamp->representative?->name ?? 'لا يوجد مندوب' }}" readonly>
                        </div>
                    </div>

                    <div class="row align-items-center mb-3">
                        <div class="col-3 text-start"><label>العنوان</label></div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-custom"
                                value="{{ $selectedCamp->location }}" readonly>
                        </div>
                    </div>

                    <div class="row align-items-center mb-3">
                        <div class="col-3 text-start"><label>المحافظة</label></div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-custom"
                                value="{{ $selectedCamp->governorate }}" readonly>
                        </div>
                    </div>

                    <div class="row align-items-center mb-3">
                        <div class="col-3 text-start"><label>عدد العائلات</label></div>
                        <div class="col-9">
                            <input type="number" class="form-control form-control-custom"
                                value="{{ $selectedCamp->families_count }}" readonly>
                        </div>
                    </div>

                    <div class="row align-items-center mb-3">
                        <div class="col-3 text-start"><label>الحالة</label></div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-custom"
                                value="{{ $selectedCamp->status }}" readonly>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('camps.index') }}" class="btn btn-save">رجوع</a>
                    </div>
                </div>
                @endif
            </div>

            <div id="delegate-form" class="page-section {{ (($subsection ?? '') == 'edit-camp') ? 'active' : '' }}">
                <h4 class="text-center mb-5 fw-bold">تعديل المخيم</h4>
                @if(isset($selectedCamp))
                <form action="{{ route('camps.update', $selectedCamp->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3 mx-auto" style="max-width: 800px;">
                        <div class="col-md-6">
                            <label class="mb-2">اسم المخيم</label>
                            <input type="text" name="name" class="form-control form-control-custom"
                                value="{{ $selectedCamp->name }}">
                        </div>

                        <div class="col-md-6">
                            <label class="mb-2">اسم المندوب</label>
                            <input type="text" class="form-control form-control-custom"
                                value="{{ $selectedCamp->representative?->name ?? 'لا يوجد مندوب' }}" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="mb-2">المحافظة</label>
                            <input type="text" name="governorate" class="form-control form-control-custom"
                                value="{{ $selectedCamp->governorate }}">
                        </div>

                        <div class="col-md-6">
                            <label class="mb-2">العنوان</label>
                            <input type="text" name="location" class="form-control form-control-custom"
                                value="{{ $selectedCamp->location }}">
                        </div>

                        <div class="col-md-6">
                            <label class="mb-2">عدد العائلات</label>
                            <input type="number" name="families_count" class="form-control form-control-custom"
                                value="{{ $selectedCamp->families_count }}">
                        </div>

                        <div class="col-md-6">
                            <label class="mb-2">الحالة</label>
                            <select name="status" class="form-select form-control-custom">
                                <option value="active" {{ $selectedCamp->status == 'active' ? 'selected' : '' }}>active
                                </option>
                                <option value="inactive" {{ $selectedCamp->status == 'inactive' ? 'selected' : '' }}>
                                    inactive</option>
                            </select>
                        </div>

                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-save w-50 m-auto">حفظ</button>
                        </div>
                    </div>
                </form>
                @endif
            </div>

            <div id="replace-representative" class="page-section {{ (($subsection ?? '') == 'replace-representative') ? 'active' : '' }}">
                <h4 class="text-center mb-5 fw-bold">تبديل مندوب المخيم</h4>

                @if(isset($selectedCamp))
                <div class="mx-auto" style="max-width: 800px;">
                    <div class="alert alert-info text-center">
                        المخيم: {{ $selectedCamp->name }}
                        <br>
                        المندوب الحالي: {{ $selectedCamp->representative?->name ?? 'لا يوجد مندوب' }}
                    </div>

                    <form action="{{ route('representatives.replace', $selectedCamp->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>اسم المندوب الجديد</label>
                                <input type="text" name="name" class="form-control form-control-custom" value="{{ old('name') }}">
                            </div>

                            <div class="col-md-6">
                                <label>البريد الإلكتروني</label>
                                <input type="email" name="email" class="form-control form-control-custom" value="{{ old('email') }}">
                            </div>

                            <div class="col-md-6">
                                <label>كلمة المرور</label>
                                <input type="password" name="password" class="form-control form-control-custom">
                            </div>

                            <div class="col-md-6">
                                <label>الهاتف</label>
                                <input type="text" name="phone" class="form-control form-control-custom" value="{{ old('phone') }}">
                            </div>

                            <div class="col-md-6">
                                <label>الجنس</label>
                                <select name="gender" class="form-select form-control-custom">
                                    <option value="">اختر</option>
                                    <option value="male">ذكر</option>
                                    <option value="female">أنثى</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label>رقم الهوية</label>
                                <input type="text" name="national_id_no" class="form-control form-control-custom" value="{{ old('national_id_no') }}">
                            </div>

                            <div class="col-md-6">
                                <label>المحافظة</label>
                                <input type="text" name="governorate" class="form-control form-control-custom" value="{{ old('governorate') }}">
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-save">تبديل المندوب</button>
                            <a href="{{ route('camps.index') }}" class="btn btn-secondary">رجوع</a>
                        </div>
                    </form>
                </div>
                @endif
            </div>

            <div id="delegate-upload"
                class="page-section {{ (($subsection ?? '') == 'delegate-upload') ? 'active' : '' }}">
                @if(isset($representative))
                @if(!$representative)
                <div class="alert alert-warning text-center">
                    لا يوجد مندوب لهذا المخيم
                </div>
                @endif

                <div class="form-container">
                    <h4 class="form-title">بيانات مندوب المخيم</h4>

                    @if(session('success'))
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
                    @endif

                    @if($representative)
                    <form action="{{ route('representatives.update', $representative->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label>الاسم</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $representative->name ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label>الجنس</label>
                                    <!-- <select class="form-select">
                                        <option selected disabled>اختر</option>
                                        <option value="male">ذكر</option>
                                        <option value="female">أنثى</option>
                                    </select> -->
                                    <select name="gender" class="form-select">
                                        <option value="male" {{ ($representative->gender ?? '') == 'male' ? 'selected' : '' }}>ذكر</option>
                                        <option value="female" {{ ($representative->gender ?? '') == 'female' ? 'selected' : '' }}>أنثى</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label>رقم الهوية</label>
                                    <input type="text" name="national_id_no" class="form-control" value="{{ old('national_id_no', $representative->national_id_no ?? '') }}">
                                    <!-- <input type="text" class="form-control"> -->
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label>الهاتف</label>
                                    <div class="input-group">
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $representative->phone ?? '') }}">
                                        <!-- <input type="number" class="form-control"> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label>البريد الالكتروني</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $representative->email ?? '') }}">
                                    <!-- <input type="email" class="form-control"> -->
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label>المحافظة</label>
                                    <input type="text" name="governorate" class="form-control" value="{{ old('governorate', $representative->governorate ?? '') }}">
                                    <!-- <input type="email" class="form-control"> -->
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <h5 class="mb-3">المرفقات</h5>

                                <div class="row g-3">
                                    <div class="col-md-4 text-center">
                                        <p><strong>صورة الهوية</strong></p>
                                        @if($representative->national_id_img_path)
                                        <img src="{{ asset('storage/' . $representative->national_id_img_path) }}"
                                            class="img-fluid rounded shadow-sm"
                                            style="max-height: 180px; object-fit: contain;">
                                        @else
                                        <span class="text-muted">لا يوجد ملف</span>
                                        @endif
                                    </div>

                                    <div class="col-md-4 text-center">
                                        <p><strong>الصورة الشخصية</strong></p>
                                        @if($representative->personal_img_path)
                                        <img src="{{ asset('storage/' . $representative->personal_img_path) }}"
                                            class="img-fluid rounded shadow-sm"
                                            style="max-height: 180px; object-fit: contain;">
                                        @else
                                        <span class="text-muted">لا يوجد ملف</span>
                                        @endif
                                    </div>

                                    <div class="col-md-4 text-center">
                                        <p><strong>ورقة الاعتماد</strong></p>
                                        @if($representative->verification_img_path)
                                        <img src="{{ asset('storage/' . $representative->verification_img_path) }}"
                                            class="img-fluid rounded shadow-sm"
                                            style="max-height: 180px; object-fit: contain;">
                                        @else
                                        <span class="text-muted">لا يوجد ملف</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            @if($representative)
                            <button type="submit" class="btn btn-save">حفظ التعديلات</button>
                            @endif

                            <a href="{{ route('camps.index') }}" class="btn btn-secondary">رجوع</a>
                        </div>
                    </form>
                </div>
                @endif
            </div>

            <div id="requests"
                class="page-section {{ (($section ?? '') == 'requests' && ($subsection ?? '') != 'show-request') ? 'active' : '' }}">
                <h4 class="text-center mb-4 fw-bold">طلبات الانضمام</h4>
                <div class="custom-table table-responsive">
                    <table class="table text-center align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المخيم</th>
                                <th>اسم مندوب المخيم</th>
                                <th>تاريخ الطلب</th>
                                <th>الحالة</th>
                                <th>العملية</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $request)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $request->camp_name }}</td>
                                <td>{{ $request->rep_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($request->created_at)->format('Y-m-d') }}</td>
                                <td>{{ $request->status }}</td>
                                <td>
                                    <a href="{{ route('requests.show', $request->id) }}">
                                        <i class="bi bi-eye text-primary fs-5" style="cursor:pointer"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">لا توجد طلبات</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="delegate1-form" class="page-section {{ (($subsection ?? '') == 'show-request') ? 'active' : '' }}">
                @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
                @endif
                @if(isset($selectedRequest))
                <div id="request" class="page">
                    <div class="card-box">
                        <h3 class="text-center mb-4">تفاصيل الطلب</h3>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label>اسم المخيم</label>
                                <input type="text" class="form-control" value="{{ $selectedRequest->camp_name }}"
                                    readonly style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-md-6">
                                <label>العنوان</label>
                                <input type="text" class="form-control" value="{{ $selectedRequest->location }}"
                                    readonly style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-md-6">
                                <label>المحافظة</label>
                                <input type="text" class="form-control" value="{{ $selectedRequest->governorate }}"
                                    readonly style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-md-6">
                                <label>عدد العائلات</label>
                                <input type="number" class="form-control" value="{{ $selectedRequest->families_count }}"
                                    readonly style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div>
                                <h4>مقدم المعلومات</h4>
                            </div>

                            <div class="col-md-6">
                                <label>الاسم</label>
                                <input type="text" class="form-control" value="{{ $selectedRequest->rep_name }}"
                                    readonly style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-md-6">
                                <label>الجنس</label>
                                <input type="text" class="form-control" value="{{ $selectedRequest->gender }}" readonly
                                    style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-md-6">
                                <label>الهاتف</label>
                                <input type="text" class="form-control" value="{{ $selectedRequest->phone }}" readonly
                                    style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-md-6">
                                <label>رقم الهوية</label>
                                <input type="text" class="form-control" value="{{ $selectedRequest->national_id_no }}"
                                    readonly style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-md-6">
                                <label>البريد الإلكتروني</label>
                                <input type="email" class="form-control" value="{{ $selectedRequest->email }}" readonly
                                    style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-md-6">
                                <label>الحالة</label>
                                <input type="text" class="form-control" value="{{ $selectedRequest->status }}" readonly
                                    style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-12 mt-4">
                                <h5 class="mb-3">المرفقات</h5>

                                <div class="row g-3">
                                    @if($selectedRequest->verification_img_path)
                                    <div class="col-md-4 text-center">
                                        <p><strong>ملف التحقق</strong></p>
                                        <img src="{{ asset('storage/' . $selectedRequest->verification_img_path) }}"
                                            class="img-fluid rounded shadow-sm"
                                            style="max-height: 180px; object-fit: contain;">
                                    </div>
                                    @endif

                                    @if($selectedRequest->national_id_img_path)
                                    <div class="col-md-4 text-center">
                                        <p><strong>صورة الهوية</strong></p>
                                        <img src="{{ asset('storage/' . $selectedRequest->national_id_img_path) }}"
                                            class="img-fluid rounded shadow-sm"
                                            style="max-height: 180px; object-fit: contain;">
                                    </div>
                                    @endif

                                    @if($selectedRequest->personal_img_path)
                                    <div class="col-md-4 text-center">
                                        <p><strong>الصورة الشخصية</strong></p>
                                        <img src="{{ asset('storage/' . $selectedRequest->personal_img_path) }}"
                                            class="img-fluid rounded shadow-sm"
                                            style="max-height: 180px; object-fit: contain;">
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4 d-flex justify-content-center gap-2 flex-wrap">
                            @if($selectedRequest->status == 'pending')
                            <form method="POST" action="{{ route('requests.reject', $selectedRequest->id) }}">
                                @csrf
                                <button type="submit" class="btn rounded-pill px-5 me-2"
                                    style="border-radius: 19px; margin-top: 10px; background-color: #3a2d87; padding: 5px 10px; color: white;">
                                    رفض
                                </button>
                            </form>

                            <form method="POST" action="{{ route('requests.approve', $selectedRequest->id) }}">
                                @csrf
                                <button type="submit" class="btn rounded-pill px-5 me-2"
                                    style="border-radius: 19px; margin-top: 10px; background-color: #3a2d87; padding: 5px 10px; color: white;">
                                    قبول
                                </button>
                            </form>
                            @endif

                            <a href="{{ route('requests.index') }}" class="btn rounded-pill px-5 me-2"
                                style="border-radius: 19px; margin-top: 10px; background-color: #ddd; padding: 5px 10px; color: black;">
                                رجوع
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div id="institutionsSection" class="page-section">
                <h4 class="text-center mb-4 fw-bold">المؤسسات</h4>

                @if(session('success'))
                <div class="alert alert-success text-center mx-auto" style="max-width: 800px;">
                    {{ session('success') }}
                </div>
                @endif

                <div class="text-center mb-4">
                    <a href="{{ route('supporters.create') }}" class="btn btn-save">
                        إضافة مؤسسة
                    </a>
                </div>

                <div class="custom-table table-responsive">
                    <table class="table text-center align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>رقم الهاتف</th>
                                <th>البريد الالكتروني</th>
                                <th>مجال الدعم</th>
                                <th>العملية</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($supporters ?? [] as $supporter)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $supporter->name }}</td>
                                <td>{{ $supporter->phone ?? '---' }}</td>
                                <td>{{ $supporter->email ?? '---' }}</td>
                                <td>{{ $supporter->aid_sector ?? '---' }}</td>
                                <td>
                                    <a href="{{ route('supporters.show', $supporter->id) }}">
                                        <i class="fa-solid fa-eye mx-2" style="color: #3a2d87; cursor:pointer;"></i>
                                    </a>
                                    <a href="{{ route('supporters.edit', $supporter->id) }}">
                                        <i class="fa-solid fa-pen-to-square mx-2" style="color: #3a2d87; cursor:pointer;"></i>
                                    </a>

                                    <form action="{{ route('supporters.destroy', $supporter->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('هل أنت متأكد من حذف هذه المؤسسة؟')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="border-0 bg-transparent p-0">
                                            <i class="fa-solid fa-trash mx-2" style="color: #3a2d87; cursor:pointer;"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">لا توجد مؤسسات</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="supporter-details" class="page-section {{ (($subsection ?? '') == 'show-supporter') ? 'active' : '' }}">
                <h4 class="text-center mb-5 fw-bold">تفاصيل المؤسسة</h4>

                @if(isset($selectedSupporter))
                <div class="bg-white p-5 rounded-4 shadow-sm mx-auto text-start"
                    style="max-width: 800px; line-height: 2;">

                    <p><strong>الاسم:</strong> {{ $selectedSupporter->name }}</p>
                    <p><strong>رقم الهاتف:</strong> {{ $selectedSupporter->phone ?? '---' }}</p>
                    <p><strong>البريد الإلكتروني:</strong> {{ $selectedSupporter->email ?? '---' }}</p>
                    <p><strong>رابط الموقع:</strong> {{ $selectedSupporter->website_link ?? '---' }}</p>
                    <p><strong>مجال الدعم:</strong> {{ $selectedSupporter->aid_sector ?? '---' }}</p>
                    <p><strong>الشروط:</strong></p>
                    <p class="text-muted">{{ $selectedSupporter->terms ?? '---' }}</p>
                    <p><strong>عن المؤسسة:</strong></p>
                    <p class="text-muted">{{ $selectedSupporter->about ?? '---' }}</p>

                    @if($selectedSupporter->logo_path)
                    <div class="text-center my-4">
                        <img src="{{ asset('storage/' . $selectedSupporter->logo_path) }}"
                            alt="logo"
                            style="max-width: 180px; max-height: 180px; object-fit: contain;">
                    </div>
                    @endif

                    <div class="text-center mt-5">
                        <a href="{{ route('supporters.index') }}" class="btn btn-purple px-5"
                            style="background-color: #3a2d87; border-radius: 19px; color:white;">
                            إغلاق
                        </a>
                    </div>
                </div>
                @endif
            </div>
            <div id="addSection" class="page-section {{ (($subsection ?? '') == 'add-supporter') ? 'active' : '' }}">
                <div class="content">
                    <div class="form-card mx-auto" style="max-width: 1000px;">
                        <h4 class="text-center fw-bold mb-5">إضافة مؤسسة</h4>

                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('supporters.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-7">
                                    <div class="field-group">
                                        <label>الإسم</label>
                                        <input type="text" name="name" class="input-style" value="{{ old('name') }}">
                                    </div>

                                    <div class="field-group">
                                        <label>البريد الالكتروني</label>
                                        <input type="email" name="email" class="input-style" value="{{ old('email') }}">
                                    </div>

                                    <div class="field-group">
                                        <label>مجال الدعم</label>
                                        <input type="text" name="aid_sector" class="input-style" value="{{ old('aid_sector') }}">
                                    </div>

                                    <div class="field-group">
                                        <label>رابط الموقع</label>
                                        <input type="url" name="website_link" class="input-style" value="{{ old('website_link') }}">
                                    </div>

                                    <div class="field-group align-items-start">
                                        <label class="pt-2">الشروط</label>
                                        <textarea name="terms" class="textarea-style">{{ old('terms') }}</textarea>
                                    </div>

                                    <div class="field-group align-items-start mt-3">
                                        <label class="pt-2">عن المؤسسة</label>
                                        <textarea name="about" class="textarea-style">{{ old('about') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="field-group">
                                        <label>رقم الهاتف</label>
                                        <input type="text" name="phone" class="input-style" value="{{ old('phone') }}">
                                    </div>

                                    <div class="field-group align-items-start">
                                        <label class="pt-2">الشعار</label>
                                        <div class="logo1-box">
                                            <i class="bi bi-file-earmark-arrow-up"></i>
                                            <p>إرفاق</p>
                                            <input type="file" name="logo" id="upload-logo">
                                            <img id="preview"
                                                style="display:none; width:100%; height:100%; object-fit:contain; border-radius:20px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn-save">حفظ</button>
                                <a href="{{ route('supporters.index') }}" class="btn btn-secondary">رجوع</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="editSupporterSection" class="page-section {{ (($subsection ?? '') == 'edit-supporter') ? 'active' : '' }}">
                <div class="content">
                    <div class="form-card mx-auto" style="max-width: 1000px;">
                        <h4 class="text-center fw-bold mb-5">تعديل مؤسسة</h4>

                        @if(isset($selectedSupporter))
                        <form action="{{ route('supporters.update', $selectedSupporter->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-7">
                                    <div class="field-group">
                                        <label>الإسم</label>
                                        <input type="text" name="name" class="input-style" value="{{ old('name', $selectedSupporter->name) }}">
                                    </div>

                                    <div class="field-group">
                                        <label>البريد الالكتروني</label>
                                        <input type="email" name="email" class="input-style" value="{{ old('email', $selectedSupporter->email) }}">
                                    </div>

                                    <div class="field-group">
                                        <label>مجال الدعم</label>
                                        <input type="text" name="aid_sector" class="input-style" value="{{ old('aid_sector', $selectedSupporter->aid_sector) }}">
                                    </div>

                                    <div class="field-group">
                                        <label>رابط الموقع</label>
                                        <input type="url" name="website_link" class="input-style" value="{{ old('website_link', $selectedSupporter->website_link) }}">
                                    </div>

                                    <div class="field-group align-items-start">
                                        <label class="pt-2">الشروط</label>
                                        <textarea name="terms" class="textarea-style">{{ old('terms', $selectedSupporter->terms) }}</textarea>
                                    </div>

                                    <div class="field-group align-items-start mt-3">
                                        <label class="pt-2">عن المؤسسة</label>
                                        <textarea name="about" class="textarea-style">{{ old('about', $selectedSupporter->about) }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="field-group">
                                        <label>رقم الهاتف</label>
                                        <input type="text" name="phone" class="input-style" value="{{ old('phone', $selectedSupporter->phone) }}">
                                    </div>

                                    <div class="field-group align-items-start">
                                        <label class="pt-2">الشعار</label>
                                        <input type="file" name="logo" class="form-control">

                                        @if($selectedSupporter->logo_path)
                                        <img src="{{ asset('storage/' . $selectedSupporter->logo_path) }}"
                                            style="max-width:150px; margin-top:15px;">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn-save">حفظ التعديلات</button>
                                <a href="{{ route('supporters.index') }}" class="btn btn-secondary">رجوع</a>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>


            <div id="users" class="page-section {{ (($section ?? '') == 'users') ? 'active' : '' }}">
                <h4 class="text-center mb-4 fw-bold">المستخدمين</h4>

                <div class="d-flex justify-content-center mb-4">
                    <div class="input-group" style="max-width: 500px;">
                        <input type="text" id="idSearch" class="form-control shadow-none" placeholder="ادخل رقم الهوية"
                            style="border-radius: 0 25px 25px 0;">
                        <button onclick="searchById()" class="btn btn-white border"
                            style="border-radius: 25px 0 0 25px;">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>

                <div class="custom-table table-responsive">
                    <table class="table text-center align-middle mb-0" id="userTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الإسم</th>
                                <th>اسم المخيم</th>
                                <th>الدور</th>
                                <th>الحالة</th>
                                <th>العملية</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users ?? [] as $user)
                            <tr data-id="
                            @if($user->role === 'representative')
                                {{ $user->representative?->national_id_no }}
                            @elseif($user->role === 'data_entry')
                                {{ $user->dataEntry?->national_id_no }}
                            @elseif($user->role === 'admin')
                                {{ $user->adminProfile?->national_id_no }}
                            @else
                                ''
                            @endif
                        ">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @if($user->role === 'representative')
                                    {{ $user->representative?->camp?->name ?? '---' }}
                                    @elseif($user->role === 'data_entry')
                                    {{ $user->dataEntry?->camp?->name ?? '---' }}
                                    @else
                                    ---
                                    @endif
                                </td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <form action="{{ route('users.toggle-status', $user->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PATCH')

                                        <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input" type="checkbox"
                                                {{ $user->is_active ? 'checked' : '' }} onchange="this.form.submit()">
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('users.password.form', $user->id) }}">
                                        <i class="bi bi-shield-lock text-dark mx-1 fs-5" style="cursor:pointer"></i>
                                    </a>

                                    <!-- <form action="{{ route('users.toggle-status', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="border-0 bg-transparent p-0">
                                            <i class="bi bi-trash text-danger mx-1 fs-5" style="cursor:pointer"></i>
                                        </button>
                                    </form> -->
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">لا يوجد مستخدمون</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="change-user-password"
                class="page-section {{ (($subsection ?? '') == 'change-user-password') ? 'active' : '' }}">
                <h4 class="text-center mb-5 fw-bold">تغيير كلمة السر</h4>

                @if(isset($selectedUser))
                <div class="mx-auto" style="max-width: 600px;">
                    <form action="{{ route('users.password.update', $selectedUser->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="mb-2">اسم المستخدم</label>
                            <input type="text" class="form-control form-control-custom"
                                value="{{ $selectedUser->name }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="mb-2">كلمة السر الجديدة</label>
                            <input type="password" name="password" class="form-control form-control-custom">
                        </div>

                        <div class="mb-3">
                            <label class="mb-2">تأكيد كلمة السر</label>
                            <input type="password" name="password_confirmation"
                                class="form-control form-control-custom">
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-save px-5">حفظ</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary px-5">رجوع</a>
                        </div>
                    </form>
                </div>
                @endif
            </div>


            <div id="contact" class="page-section">
                <h4 class="text-center mb-5 fw-bold">التواصل</h4>

                @if(session('success'))
                <div class="alert alert-success text-center mx-auto" style="max-width: 800px;">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('communications.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-4 mx-auto" style="max-width: 800px;">
                        <div class="col-md-6">
                            <label>البريد الالكتروني</label>
                            <input type="text" name="email" class="form-control form-control-custom m-t-4"
                                value="{{ old('email', $communications['email'] ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label>واتساب</label>
                            <input type="text" name="whatsapp" class="form-control form-control-custom m-t-4"
                                value="{{ old('whatsapp', $communications['whatsapp'] ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label>لينكدإن</label>
                            <input type="text" name="linkedin" class="form-control form-control-custom m-t-4"
                                value="{{ old('linkedin', $communications['linkedin'] ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label>الهاتف</label>
                            <input type="text" name="phone" class="form-control form-control-custom m-t-4"
                                value="{{ old('phone', $communications['phone'] ?? '') }}">
                        </div>

                        <div class="col-md-12 text-center">
                            <div style="max-width: 385px; margin: auto;">
                                <label>فيسبوك</label>
                                <input type="text" name="facebook" class="form-control form-control-custom m-t-4"
                                    value="{{ old('facebook', $communications['facebook'] ?? '') }}">
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-save">حفظ</button>
                    </div>
                </form>
            </div>

            <div id="reports" class="page-section text-center">
                <h4 class="mb-5 fw-bold">التقارير</h4>
                <div class="mx-auto" style="max-width: 400px;">
                    <select class="form-select form-control-custom" style="background-color: #bdb7e5;">
                        <option>إنشاء تقرير عام لكل المخيمات</option>
                    </select>
                    <select class="form-select form-control-custom" onclick="showPage('report-view')"
                        style="background-color: #bdb7e5;">
                        <option>إنشاء تقرير حالة لمخيم محدد</option>
                    </select>
                    <button class="btn  rounded-pill px-5 mt-3"
                        style="color: #3a2d87;background-color: white;padding:  5px 19px; border: 1px solid #bdb7e5;">إنشاء</button>
                </div>
            </div>

            <div id="report-view" class="page-section text-center ">
                <h4 class="mb-4 fw-bold">تقرير حالة مخيم الشجاعية - مارس 2025</h4>
                <p class="mx-auto" style="max-width: 700px; color: #555;">تقرير حالة مخيم الشجاعية - مارس 2025
                    يستعرض هذا التقرير الوضع الحالي لمخيم [اسم المخيم] من حيث عدد المستفيدين المسجلين، الأنشطة المنفذة،
                    والمساعدات المقدمة
                    خلال الفترة المحددة.
                    يهدف التقرير إلى توفير صورة شاملة تساعد إدارة المخيم على تقييم الأداء، متابعة الاحتياجات، واتخاذ
                    القرارات المناسبة
                    لتحسين مستوى الخدمات المقدمة للمستفيدين.
                </p>
                <button class="btn btn-save mt-4"><i class="bi bi-download me-2"></i> تنزيل التقرير</button>
            </div>


            <div id="messages" class="page-section">
                <h4 class="text-center mb-5 fw-bold">الرسائل</h4>

                <div class="mx-auto" style="max-width: 800px;">
                    @forelse($messages as $message)
                    <div
                        class="message-item shadow-sm mb-3 p-3 bg-white rounded-4 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3 text-end">
                            <div class="user-avatar">
                                <i class="bi bi-person-fill fs-3 text-white"></i>
                            </div>
                            <div>
                                <div class="fw-bold">اسم المستخدم : {{ $message->name }}</div>
                                <div class="small text-muted">الموضوع : {{ $message->subject }}</div>
                                <div class="small text-muted">
                                    الحالة :
                                    @if($message->status === 'new')
                                    <span class="text-danger">جديدة</span>
                                    @else
                                    <span class="text-success">مقروءة</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-3 align-items-center">
                            <form action="{{ route('dashboard.messages.delete', $message->id) }}" method="POST"
                                onsubmit="return confirm('هل أنت متأكد من حذف الرسالة؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="border-0 bg-transparent p-0">
                                    <i class="bi bi-trash text-primary fs-5" style="cursor:pointer"></i>
                                </button>
                            </form>

                            <a href="{{ route('dashboard.messages.show', $message->id) }}">
                                <i class="bi bi-box-arrow-up-right text-primary fs-5" style="cursor:pointer"></i>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-info text-center">
                        لا توجد رسائل حتى الآن
                    </div>
                    @endforelse
                </div>
            </div>

            <div id="message-details" class="page-section">
                <h4 class="text-center mb-5 fw-bold">تفاصيل الرسالة</h4>

                @if(isset($selectedMessage))
                <div class="bg-white p-5 rounded-4 shadow-sm mx-auto text-start"
                    style="max-width: 800px; line-height: 2;">
                    <p><strong>الإسم:</strong> {{ $selectedMessage->name }}</p>
                    <p><strong>البريد الالكتروني:</strong> {{ $selectedMessage->email }}</p>
                    <p><strong>الموضوع:</strong> {{ $selectedMessage->subject }}</p>
                    <p><strong>الرسالة:</strong></p>
                    <p class="text-muted">{{ $selectedMessage->message }}</p>

                    <div class="text-center mt-5">
                        <a href="{{ route('messages.index') }}" class="btn btn-purple px-5"
                            style="background-color: #3a2d87; border-radius: 19px; color:white;">
                            إغلاق
                        </a>
                    </div>
                </div>
                @else
                <div class="alert alert-secondary text-center mx-auto" style="max-width: 800px;">
                    اختر رسالة لعرض تفاصيلها
                </div>
                @endif
            </div>

            <div id="create-data-entry" class="page-section {{ (($subsection ?? '') == 'create-data-entry') ? 'active' : '' }}">
                <h4 class="text-center mb-5 fw-bold">إضافة مدخل بيانات</h4>

                @if(session('success'))
                <div class="alert alert-success text-center mx-auto" style="max-width: 600px;">
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger mx-auto" style="max-width: 600px;">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="mx-auto" style="max-width: 600px;">
                    <form action="{{ route('data-entries.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="mb-2">المخيم</label>
                            <select name="camp_id" class="form-select form-control-custom" required>
                                <option value="">اختر المخيم</option>
                                @foreach($camps as $camp)
                                <option value="{{ $camp->id }}">{{ $camp->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">الاسم</label>
                            <input type="text" name="name" class="form-control form-control-custom" required>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control form-control-custom" required>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">رقم الهاتف</label>
                            <input type="text" name="phone" class="form-control form-control-custom">
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">كلمة المرور</label>
                            <input type="password" name="password" class="form-control form-control-custom" required minlength="8">
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-save px-5">حفظ</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary px-5">رجوع</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>


        <!-- <footer class="pt-4 pb-3 " style="background: rgba(58, 45, 135, 0.11); border-radius: 19px;">
            <div class="container-fluid">

                <a class="navbar-brand d-flex align-items-center gap-2" href="الصفحة الرئيسية.html">
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
    </footer> -->
    </div>

    <div class="modal fade" id="authModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4 shadow-lg text-center">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    <h6 class="fw-bold mb-0">إعداد المصادقة</h6>
                </div>
                <p class="fw-bold mt-2">تغيير كلمة السر</p>
                <input type="password" class="form-control form-control-custom" placeholder="كلمة السر الجديدة">
                <input type="password" class="form-control form-control-custom" placeholder="تأكيد كلمة السر">
                <button class="btn btn-save w-100 mt-2">حفظ</button>
            </div>
        </div>
    </div>

    @if(isset($selectedMessage))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showPage('message-details');
        });
    </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showPage(pageId) {
            document.querySelectorAll('.page-section').forEach(section => {
                section.style.display = 'none';
            });

            const page = document.getElementById(pageId);
            if (page) {
                page.style.display = 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if(isset($subsection) && $subsection == 'show-camp')
            showPage('camp-info');
            @elseif(isset($subsection) && $subsection == 'edit-camp')
            showPage('delegate-form');
            @elseif(isset($subsection) && $subsection == 'show-request')
            showPage('delegate1-form');
            @elseif(isset($subsection) && $subsection == 'delegate-upload')
            showPage('delegate-upload');
            @elseif(isset($subsection) && $subsection == 'replace-representative')
            showPage('replace-representative');
            @elseif(isset($subsection) && $subsection == 'change-user-password')
            showPage('change-user-password');
            @elseif(isset($subsection) && $subsection == 'show-supporter')
            showPage('supporter-details');
            @elseif(isset($subsection) && $subsection == 'edit-supporter')
            showPage('editSupporterSection');
            @elseif(isset($subsection) && $subsection == 'add-supporter')
            showPage('addSection');
            @elseif(isset($subsection) && $subsection == 'create-data-entry')
            showPage('create-data-entry');
            @elseif(isset($section))
            showPage('{{ $section }}');
            @else
            showPage('dashboard');
            @endif
        });
    </script>
    <script>
        function searchById() {
            let input = document.getElementById('idSearch').value.trim();
            let rows = document.querySelectorAll('#userTable tbody tr');

            rows.forEach(row => {
                let id = row.getAttribute('data-id');

                if (!input) {
                    row.style.display = '';
                } else if (id && id.includes(input)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>
@endsection