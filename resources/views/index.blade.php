@extends('template.navbar')

@section('content')

<nav aria-label="breadcrumb" class="ms-4 fw-bolder">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        <li class="breadcrumb-item"><a href="/admin/users">User Data</a></li>
    </ol>
</nav>

<div class="container">
    <h1 class="mt-4">Dashboard</h1>
</div>

<div class="container-fluid pt-4 px-4"><div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-users fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total User</p>
                    <h6 id="totalUsers" class="mb-0">0</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-user fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Admin</p>
                    <h6 id="totalAdmins" class="mb-0">0</h6>
                </div>
            </div>
        </div>
    </div>
</div>


@section('script')
<script>
    $(document).ready(function() {
        function fetchUserCount() {
            $.ajax({
                url: "/admin/get-user-count",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    $("#totalUsers").html(response.total);
                    $("#totalAdmins").html(response.totaladmin);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data: " + error);
                }
            });
        }

        // Panggil saat halaman dimuat
        fetchUserCount();

        // Refresh data setiap 30 detik
        setInterval(fetchUserCount, 30000);
    });
</script>
@endsection


@endsection
