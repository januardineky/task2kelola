<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.css">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

</head>

<body>
    @include('sweetalert::alert')
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <div class="container-fluid d-flex flex-column min-vh-100 p-0">
            <!-- Sidebar Start -->
            <div class="sidebar pe-4 pb-3">
                <nav class="navbar bg-secondary navbar-dark">
                    <a href="" class="navbar-brand mx-4 mb-3">
                        <h3 class="text-primary"><i class="fa fa-user me-2"></i>User App</h3>
                    </a>
                    <div class="d-flex align-items-center ms-4 mb-4">
                        <div class="position-relative">
                            <img class="rounded-circle" src="{{ asset('img/pp.png') }}" alt=""
                                style="width: 40px; height: 40px;">
                            <div
                                class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                            </div>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">{{ auth()->user()->username }}</h6>
                            <span>{{ auth()->user()->rolename }}</span>
                        </div>
                    </div>
                    <div class="navbar-nav w-100">
                        @if (auth()->user()->rolename == 'Admin')
                            <a href="/admin/index"
                                class="nav-item nav-link {{ Request::is('admin/index') ? 'active' : '' }}"><i
                                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                        @else
                            <a href="/user/home"
                                class="nav-item nav-link {{ Request::is('user/home') ? 'active' : '' }}"><i
                                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                        @endif
                        @if (auth()->user()->rolename == 'Admin')
                            <a href="/admin/users"
                                class="nav-item nav-link {{ Request::is('admin/users') ? 'active' : '' }}"><i
                                    class="fa fa-table me-2"></i>User Data</a>
                        @endif
                    </div>
                </nav>
            </div>
            <!-- Sidebar End -->


            <!-- Content Start -->

            <div class="content flex-grow-1">
                <!-- Navbar Start -->
                <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                        <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                    </a>
                    <div class="navbar-nav align-items-center ms-auto">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <img class="rounded-circle me-lg-2" src="{{ asset('img/pp.png') }}" alt=""
                                    style="width: 40px; height: 40px;">
                                <span class="d-none d-lg-inline-flex">{{ auth()->user()->username }}</span>
                            </a>
                            <div
                                class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                                <a href="#" id="logoutBtn" class="dropdown-item">Log Out</a>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- Navbar End -->
                @yield('content')
            </div>

            <!-- Footer Start -->
            <div class="footer bg-secondary rounded-top p-4 mt-auto">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-start">
                        &copy; <a href="#">Task 2</a>, All Right Reserved.
                    </div>
                    <div class="col-12 col-sm-6 text-center text-sm-end">
                        Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->



    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#logoutBtn').on('click', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('logout') }}', // URL route logout
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}' // CSRF token untuk keamanan
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            background: "linear-gradient(135deg, #2C2C2C, #1A1A1A)",
                            color: "#fff"
                        });

                        // Redirect setelah logout berhasil
                        setTimeout(function() {
                            window.location.href = response.redirect;
                        }, 1000);
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal logout, coba lagi!',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            background: "linear-gradient(135deg, #2C2C2C, #1A1A1A)",
                            color: "#fff"
                        });
                    }
                });
            });
        });
    </script>

    @yield('script')
</body>

</html>
