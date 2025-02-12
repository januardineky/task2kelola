<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login - DarkPan</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    @include('sweetalert::alert')
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Login Form Start -->
        <div class="container-fluid d-flex align-items-center justify-content-center vh-100">
            <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <h3>Login</h3>
                </div>
                <form id="loginForm" action="/auth" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="name@example.com">
                        <label for="email">Email address</label>
                        <div class="text-danger" id="emailError"></div>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Password">
                        <label for="password">Password</label>
                        <div class="text-danger" id="passwordError"></div>
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword"
                            style="cursor: pointer;">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                    <div class="mt-3 text-center">
                        <p>Dont have an account? <a href="/register" class="text-primary">Register</a></p>
                    </div>
                    <input type="submit" class="btn btn-primary w-100 py-3" value="Login"></input>
                </form>


            </div>
        </div>
        <!-- Login Form End -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    {{--  <script src="js/main.js"></script>  --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();

                // Clear previous error messages
                $('#emailError').text('');
                $('#passwordError').text('');

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.message) {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                text: response.welcomeMessage,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                background: "linear-gradient(135deg, #2C2C2C, #1A1A1A)",
                                color: "#fff",
                                timer: 5000
                            })
                        }
                        // Handle success (e.g., redirect to another page)
                        window.location.href = response.redirect;
                    },
                    error: function(xhr) {
                        // Parse JSON response
                        var response = xhr.responseJSON;

                        if (response.inactive) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                showConfirmButton: false,
                                timer: 2000,
                                text: response
                                    .message
                            });
                        }

                        // Check if there's an error in the response
                        else if (response.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                showConfirmButton: false,
                                timer: 2000,
                                text: response
                                    .message
                            });
                        }

                        // Display validation errors under the corresponding inputs
                        if (response.errors) {
                            if (response.errors.email) {
                                $('#emailError').text(response.errors.email[0]);
                            }
                            if (response.errors.password) {
                                $('#passwordError').text(response.errors.password[0]);
                            }
                        }
                    }
                });
            });
        });
    </script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>

</body>

</html>
