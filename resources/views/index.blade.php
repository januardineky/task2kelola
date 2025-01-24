@extends('template.navbar')

@section('content')

<!-- Breadcrumb Start -->
<nav aria-label="breadcrumb" class="ms-4 fw-bolder">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        <li class="breadcrumb-item"><a href="/users">User Data</a></li>
    </ol>
</nav>
<!-- Breadcrumb End -->

<div class="container">
    <h1 class="mt-4">Dashboard</h1>
</div>

<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-users fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total User</p>
                    <h6 class="mb-0">{{ $total }}</h6>
                </div>
            </div>
        </div>
                <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-user fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Admin</p>
                    <h6 class="mb-0">{{ $totaladmin }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->

@endsection
