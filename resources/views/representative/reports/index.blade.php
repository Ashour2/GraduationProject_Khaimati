@extends('layouts.representative')

@section('title', 'التقارير')

@section('content')
<div class="container main-container">
    <h4 class="mb-4 fw-bold text-center">التقارير</h4>

    <div class="mx-auto" style="max-width: 700px;">

        <a href="{{ route('representative.reports.index') }}?type=all_beneficiaries"
            class="report-btn text-decoration-none text-dark">
            <h5>كل بيانات المستفيدين</h5>
            <i class="bi bi-download text-primary fs-4"></i>
        </a>

        <a href="{{ route('representative.reports.index') }}?type=inventory"
            class="report-btn text-decoration-none text-dark">
            <h5>تقرير المخزون</h5>
            <i class="bi bi-download text-primary fs-4"></i>
        </a>

        <a href="{{ route('representative.reports.index') }}?type=camp"
            class="report-btn text-decoration-none text-dark">
            <h5>تقرير المخيم</h5>
            <i class="bi bi-download text-primary fs-4"></i>
        </a>

        <div class="report-btn">
            <h5>تقرير العائلة</h5>
            <div class="d-flex align-items-center gap-2">
                <input type="text" id="familyId"
                    style="border-radius: 19px; border:none; padding: 0px 30px; background-color: rgba(58, 45, 135, 0.11); outline: none;"
                    placeholder="ادخل رقم الهوية" />
                <i class="bi bi-download text-primary fs-4" style="cursor:pointer"></i>
            </div>
        </div>

    </div>
</div>
@endsection
