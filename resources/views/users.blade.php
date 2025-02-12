@extends('template.navbar')

@section('content')
    <!-- Breadcrumb Start -->
    <nav aria-label="breadcrumb" class="ms-4 fw-bolder">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/index">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Data</li>
        </ol>
    </nav>
    <!-- Breadcrumb End -->

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-6">
                <a href="/admin/users">
                    <h1 id="usersTitle" class="mt-4">Users Data</h1>
                </a>
            </div>
            <div class="col-md-12 d-flex justify-content-start mt-2">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
                    <i class="fas fa-user-plus"></i> Create
                </button>
            </div>
        </div>

        <table id="usersTable" class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Major</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>


    <!-- Create User Modal -->
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Create New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createUserForm" action="/admin/users/store" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="new_username" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" id="new_username">
                                    <div class="text-danger" id="usernameError"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="new_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="new_email">
                                    <div class="text-danger" id="emailError"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="new_phone_number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="phone_number" id="new_phone_number">
                                    <div class="text-danger" id="phone_numberError"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="new_address" class="form-label">Address</label>
                                    <textarea class="form-control" name="address" id="new_address" rows="4"></textarea>
                                    <div class="text-danger" id="addressError"></div>
                                </div>
                                <div class="mb-3 mt-4">
                                    <label for="new_status" class="form-label">Status</label>
                                    <select class="form-control" name="status" id="new_status">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Not Active</option>
                                    </select>
                                    <div class="text-danger" id="statusError"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="new_major" class="form-label">Major</label>
                                    <select class="form-control" name="major" id="new_major">
                                        <option value="">Select Major</option>
                                        <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                        <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan</option>
                                        <option value="Teknik Elektronika Industri">Teknik Elektronika Industri</option>
                                        <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                                        <option value="Desain Pemodelan dan Informasi Bangunan">Desain Pemodelan dan
                                            Informasi Bangunan</option>
                                        <option value="Teknik Sepeda Motor">Teknik Sepeda Motor</option>
                                        <option value="Teknik Kendaraan Ringan">Teknik Kendaraan Ringan</option>
                                    </select>
                                    <div class="text-danger" id="majorError"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="new_rolename" class="form-label">Role</label>
                                    <select class="form-control" name="rolename" id="new_rolename">
                                        <option value="">Select Role</option>
                                        <option value="User">User</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                                    <div class="text-danger" id="rolenameError"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Password -->
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label for="new_password" class="form-label">Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control pe-5" name="password"
                                            id="new_password">
                                        <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                                            id="togglePassword1" style="cursor: pointer;">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                    <div class="text-danger" id="passwordError"></div>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control pe-5" name="confirm_password"
                                            id="confirm_password">
                                        <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                                            id="togglePassword2" style="cursor: pointer;">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                    <div class="text-danger" id="confirmPasswordError"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm" action="/users/update">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="user_id">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" id="username">
                                    <div class="text-danger" id="usernameErrorr"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email">
                                    <div class="text-danger" id="emailErrorr"></div>

                                </div>
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="phone_number" id="phone_number">
                                    <div class="text-danger" id="phonenumberErrorr"></div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" name="address" id="address" rows="4" placeholder="Address"></textarea>
                                    <div class="text-danger" id="addressErrorr"></div>

                                </div>
                                <div class="mb-3 mt-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Not Active</option>
                                    </select>
                                    <div class="text-danger" id="statusErrorr"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="major" class="form-label">Major</label>
                                    <select class="form-control form-control-select" name="major" id="major">
                                        <option value="">Select Major</option>
                                        <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                        <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan</option>
                                        <option value="Teknik Elektronika Industri">Teknik Elektronika Industri</option>
                                        <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                                        <option value="Desain Pemodelan dan Informasi Bangunan">Desain Pemodelan dan
                                            Informasi Bangunan
                                        </option>
                                        <option value="Teknik Sepeda Motor">Teknik Sepeda Motor</option>
                                        <option value="Teknik Kendaraan Ringan">Teknik Kendaraan Ringan</option>
                                    </select>
                                    <div class="text-danger" id="majorErrorr"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const titleElement = document.getElementById("usersTitle");

            $(document).ready(function() {
                const table = $('#usersTable').DataTable({
                    serverSide: true,
                    ajax: {
                        url: "/admin/users/data",
                        type: 'GET'
                    },
                    columns: [{
                            data: 'username',
                            name: 'username'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'phone_number',
                            name: 'phone_number'
                        },
                        {
                            data: 'address',
                            name: 'address'
                        },
                        {
                            data: 'major',
                            name: 'major'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            render: data => data ? 'Active' : 'Not Active'
                        },
                        {
                            data: 'rolename',
                            name: 'rolename'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    dom: '<"top d-flex justify-content-between"l<"search-box"f>>rtip',
                    responsive: true,
                    language: {
                        search: "Search: ",
                        lengthMenu: "Show _MENU_ entries"
                    }
                });

                // Fungsi untuk memperbarui judul berdasarkan input pencarian
                function updateTitle() {
                    const searchInput = document.querySelector("input[type='search']");
                    const searchValue = searchInput.value.trim();

                    if (searchValue) {
                        titleElement.textContent = `Search Results for "${searchValue}"`;
                    } else {
                        titleElement.textContent = "Users Data";
                    }
                }

                // Memperbarui judul saat pengguna mengetik di input pencarian
                table.on('search.dt', function() {
                    updateTitle();
                });

                // Inisialisasi pertama kali
                updateTitle();
            });
        });


        document.getElementById('togglePassword1').addEventListener('click', function() {
            const passwordField = document.getElementById('new_password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });

        document.getElementById('togglePassword2').addEventListener('click', function() {
            const passwordField = document.getElementById('confirm_password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });


        $('#createUserForm').submit(function(e) {
            e.preventDefault();

            let formData = {
                _token: $('input[name=_token]').val(),
                username: $('#new_username').val(),
                email: $('#new_email').val(),
                phone_number: $('#new_phone_number').val(),
                address: $('#new_address').val(),
                major: $('#new_major').val(),
                status: $('#new_status').val(),
                rolename: $('#new_rolename').val(),
                password: $('#new_password').val(),
                password_confirmation: $('#confirm_password').val(),
            };

            console.log("Form Data Sent:", formData); // Debugging

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/users/store",
                type: "POST",
                data: formData,
                success: function(response) {
                    console.log("Server Response:", response); // Debugging
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            background: "linear-gradient(135deg, #2C2C2C, #1A1A1A)",
                            color: "#fff",
                            timer: 3000
                        })
                        {{--  alert(response.message);  --}}
                        $('#createUserModal').modal('hide');
                        location.reload();
                    }
                },
                error: function(xhr) {
                    console.log("Error Response:", xhr.responseJSON); // Debugging
                    let errors = xhr.responseJSON.errors;
                    $('.text-danger').text('');
                    $.each(errors, function(key, value) {
                        $('#' + key + 'Error').text(value[0]);
                    });
                }
            });
        });


        // Open the edit modal and populate the fields
        function openEditModal(userId) {
            $('.text-danger').text('');

            // Make an AJAX request to get the user details
            $.ajax({
                url: '/admin/users/' + userId + '/edit',
                method: 'GET',
                success: function(data) {
                    // Populate the modal fields with the user data
                    $('#user_id').val(data.id);
                    $('#username').val(data.username);
                    $('#email').val(data.email);
                    $('#phone_number').val(data.phone_number);
                    $('#address').val(data.address);
                    $('#major').val(data.major);
                    $('#status').val(data.status);

                    // Show the modal
                    $('#editUserModal').modal('show');
                }
            });
        }

        $('#editUserForm').on('submit', function(e) {
            e.preventDefault();

            console.log($(this).attr('action') + $("#user_id").val());
            $('.text-danger').text('');

            console.log("Action URL:", $(this).attr('action') + "/" + $("#user_id").val());
            console.log("User ID:", $("#user_id").val());
            console.log("Status:", $("#status").val());


            // Proceed with AJAX if all fields are valid
            $.ajax({
                url: '/admin/users/update/' + $("#user_id").val(),
                type: 'PUT',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            background: "linear-gradient(135deg, #2C2C2C, #1A1A1A)",
                            color: "#fff",
                            timer: 5000
                        })
                    }
                    window.location.href = response.redirect;
                },
                error: function(xhr) {
                    // Parse response errors
                    var response = xhr.responseJSON;
                    if (response.errors) {
                        console.log(response);
                        if (response.errors.username) {
                            $('#usernameErrorr').text(response.errors.username.join(' '));
                        }
                        if (response.errors.email) {
                            $('#emailErrorr').text(response.errors.email.join(' '));
                        }
                        if (response.errors.phone_number) {
                            $('#phonenumberErrorr').text(response.errors.phone_number.join(' '));
                        }
                        if (response.errors.address) {
                            $('#addressErrorr').text(response.errors.address.join(' '));
                        }
                        if (response.errors.major) {
                            $('#majorErrorr').text(response.errors.major.join(' '));
                        }
                        if (response.errors.status) {
                            $('#statusErrorr').text(response.errors.status.join(' '));
                        }
                    }
                }
            });
        });

        document.getElementById('phone_number').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        function deleteUser(userId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                background: "linear-gradient(135deg, #2C2C2C, #1A1A1A)",
                color: "#fff",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/users/delete/' + userId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                background: "linear-gradient(135deg, #2C2C2C, #1A1A1A)",
                                color: "#fff",
                                timer: 3000
                            })
                            location.reload();
                        },
                        error: function(xhr) {
                            Swal.fire("Error!", "Something went wrong.", "error");
                        }
                    });
                }
            });
        }
    </script>
@endsection
