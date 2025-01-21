<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register - DarkPan</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    @include('sweetalert::alert')
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Register Form Start -->
        <div class="container-fluid d-flex align-items-center justify-content-center vh-100">
            <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3 w-50">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <h3>Register</h3>
                </div>
                <form action="/register" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                                <label for="username">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                                <label for="email">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="phone_number" id="phoneNumber" placeholder="Phone Number">
                                <label for="phoneNumber">Phone Number</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                                <label for="address">Address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-control form-control-select" name="major" id="major">
                                    <option value="">Select Major</option>
                                    <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                    <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan</option>
                                    <option value="Teknik Elektronika Industri">Teknik Elektronika Industri</option>
                                    <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                                    <option value="Desain Pemodelan dan Informasi Bangunan">Desain Pemodelan dan Informasi Bangunan</option>
                                    <option value="Teknik Sepeda Motor">Teknik Sepeda Motor</option>
                                    <option value="Teknik Kendaraan Ringan">Teknik Kendaraan Ringan</option>
                                </select>                                
                                <label for="major">Major</label>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary w-100 py-3" value="Register"></input>
                </form>
                <div class="mt-3 text-center">
                    <p>Already have an account? <a href="/" class="text-primary">Login here</a></p>
                </div>
            </div>
        </div>
        <!-- Register Form End -->
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
