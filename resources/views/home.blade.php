@extends('template.navbar')

@section('content')

    <!-- Breadcrumb Start -->
    <nav aria-label="breadcrumb" class="ms-4 fw-bolder">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <!-- Breadcrumb End -->

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4 mb-5">
    <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
        <div class="col-md-6 text-center">
            <h3>Welcome, {{ $user->username }}</h3>
        </div>
    </div>
</div>
<!-- Blank End -->

@endsection