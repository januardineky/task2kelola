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
                <form action="/users" method="get" class="d-flex">

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
                <form id="editUserForm" method="POST" action="/users/update">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="user_id">

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" id="phone_number" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="address" required>
                        </div>

                        <div class="mb-3">
                            <label for="major" class="form-label">Major</label>
                            <select class="form-control form-control-select" name="major" id="major" required>
                                <option value="">Select Major</option>
                                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan</option>
                                <option value="Teknik Elektronika Industri">Teknik Elektronika Industri</option>
                                <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                                <option value="Desain Pemodelan dan Informasi Bangunan">Desain Pemodelan dan Informasi
                                    Bangunan</option>
                                <option value="Teknik Sepeda Motor">Teknik Sepeda Motor</option>
                                <option value="Teknik Kendaraan Ringan">Teknik Kendaraan Ringan</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
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

<script>
    // Open the edit modal and populate the fields
    function openEditModal(userId) {
        // Make an AJAX request to get the user details
        $.ajax({
            url: '/users/' + userId + '/edit',
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
                {{--  $('#rolename').val(data.rolename);  --}}

                // Show the modal
                $('#editUserModal').modal('show');
            }
        });
    }
</script>
