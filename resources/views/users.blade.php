@extends('template.navbar')

@section('content')
    <!-- Breadcrumb Start -->
    <nav aria-label="breadcrumb" class="ms-4 fw-bolder">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Data</li>
        </ol>
    </nav>
    <!-- Breadcrumb End -->

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="mt-4 text-start">Users Data</h1>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <form action="/admin/users" method="get" class="d-flex">

                    <select name="sort_major" class="form-control me-4" onchange="this.form.submit()">
                        <option value="">Sort by Major</option>
                        <option value="Rekayasa Perangkat Lunak"
                            {{ request('sort_major') == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>Rekayasa Perangkat
                            Lunak</option>
                        <option value="Teknik Komputer Jaringan"
                            {{ request('sort_major') == 'Teknik Komputer Jaringan' ? 'selected' : '' }}>Teknik Komputer
                            Jaringan</option>
                        <option value="Teknik Elektronika Industri"
                            {{ request('sort_major') == 'Teknik Elektronika Industri' ? 'selected' : '' }}>Teknik
                            Elektronika Industri</option>
                        <option value="Desain Komunikasi Visual"
                            {{ request('sort_major') == 'Desain Komunikasi Visual' ? 'selected' : '' }}>Desain Komunikasi
                            Visual</option>
                        <option value="Desain Pemodelan dan Informasi Bangunan"
                            {{ request('sort_major') == 'Desain Pemodelan dan Informasi Bangunan' ? 'selected' : '' }}>
                            Desain Pemodelan dan Informasi Bangunan</option>
                        <option value="Teknik Sepeda Motor"
                            {{ request('sort_major') == 'Teknik Sepeda Motor' ? 'selected' : '' }}>Teknik Sepeda Motor
                        </option>
                        <option value="Teknik Kendaraan Ringan"
                            {{ request('sort_major') == 'Teknik Kendaraan Ringan' ? 'selected' : '' }}>Teknik Kendaraan
                            Ringan</option>
                    </select>

                    <input type="text" name="search" class="form-control" placeholder="Search">

                </form>
            </div>
        </div>
        <table id="usersTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Major</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tabel as $index => $table)
                    <tr>
                        <td>{{ $table->username }}</td>
                        <td>{{ $table->email }}</td>
                        <td>{{ $table->phone_number }}</td>
                        <td>{{ $table->address }}</td>
                        <td>{{ $table->major }}</td>
                        <td>{{ $table->status ? 'Active' : 'Not Active' }}</td>
                        <td>
                            <a href="#" class="btn btn-primary text-white p-2" title="Edit"
                                onclick="openEditModal('{{ $table->id }}')">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <div class="d-flex justify-content-center mt-3">
            <ul class="pagination">
                <li class="page-item {{ $tabel->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $tabel->previousPageUrl() }}" aria-label="Previous">
                        << Previous</a>
                </li>
                <li class="page-item {{ $tabel->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $tabel->nextPageUrl() }}" aria-label="Next">Next >></a>
                </li>
            </ul>
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
                                    <div class="text-danger" id="usernameError"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email">
                                    <div class="text-danger" id="emailError"></div>

                                </div>
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="phone_number" id="phone_number">
                                    <div class="text-danger" id="phonenumberError"></div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" name="address" id="address" rows="4" placeholder="Address"></textarea>
                                    <div class="text-danger" id="addressError"></div>

                                </div>
                                <div class="mb-3 mt-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="1">Active</option>
                                        <option value="0">Not Active</option>
                                    </select>
                                    <div class="text-danger" id="usernameError"></div>
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
                                    <div class="text-danger" id="majorError"></div>
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
                            $('#usernameError').text(response.errors.username.join(' '));
                        }
                        if (response.errors.email) {
                            $('#emailError').text(response.errors.email.join(' '));
                        }
                        if (response.errors.phone_number) {
                            $('#phonenumberError').text(response.errors.phone_number.join(' '));
                        }
                        if (response.errors.address) {
                            $('#addressError').text(response.errors.address.join(' '));
                        }
                        if (response.errors.major) {
                            $('#majorError').text(response.errors.major.join(' '));
                        }
                    }
                }
            });
        });

        document.getElementById('phone_number').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
@endsection
