@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #12121c;
        }

        .content-wrapper {
            padding-top: 90px !important;
        }

        .card {
            background-color: #1e1e2d !important;
            border: none;
            border-radius: 12px;
            color: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .btn-tambah {
            background-color: #6c63ff;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            padding: 10px 25px;
            box-shadow: 0 0 10px rgba(108, 99, 255, 0.5);
        }

        .btn-tambah:hover {
            background-color: #5a52e0;
        }

        .table tbody tr {
            background-color: #26263b !important;
            transition: background 0.2s ease;
        }

        .table-hover tbody tr:hover {
            background-color: #343453 !important;
        }

        .btn-edit {
            background-color: #f5b400;
            color: #1e1e2d;
            font-weight: 600;
            border: none;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: #fff;
            font-weight: 600;
            border: none;
        }

        .btn-detail {
            background-color: #2ecc71;
            color: #fff;
            font-weight: 600;
            border: none;
        }

        .text-success {
            color: #2ecc71 !important;
        }

        .text-danger {
            color: #e74c3c !important;
        }

        .search-bar input,
        .filter-select select {
            background-color: #26263b;
            color: #fff;
            border: 1px solid #444;
            border-radius: 8px;
            padding: 8px 12px;
        }

        .spinner {
            display: none;
            color: #6c63ff;
        }
    </style>

    <div class="container-fluid grid-margin stretch-card content-wrapper">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                    <h4 class="card-title mb-0 text-white">Table User</h4>
                    <a href="{{ route('users.create') }}" class="btn btn-tambah mt-2 mt-md-0">
                        <i class="mdi mdi-plus-circle-outline me-1"></i> Tambah User
                    </a>
                </div>

                <!-- 🔍 Search & Filter -->
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                    <div class="search-bar mb-2 mb-md-0">
                        <input type="text" id="search" placeholder="Cari nama/email..." />
                        <span class="spinner ms-2"><i class="mdi mdi-loading mdi-spin"></i></span>
                    </div>
                    <div class="filter-select mb-2 mb-md-0">
                        <select id="roleFilter">
                            <option value="all">Semua Role</option>
                            <option value="admin">Admin</option>
                            <option value="technician">Technician</option>
                            <option value="customer">Customer</option>
                        </select>
                    </div>
                </div>

                <div id="userTable">
                    @include('pages.maindata.user.table', ['users' => $users])
                </div>

            </div>
        </div>
    </div>

    <!-- SweetAlert untuk notifikasi -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- ⚡ AJAX Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() { // ✅ diperbaiki dari readay → ready
            let timer = null;

            function fetchUsers(page = 1) {
                let search = $('#search').val();
                let role = $('#roleFilter').val();

                $('.spinner').show();

                $.ajax({
                    url: "{{ route('users.index') }}",
                    type: "GET",
                    data: {
                        search: search,
                        role: role,
                        page: page
                    },
                    success: function(data) {
                        $('#userTable').html($(data).find('#userTable').html());
                        $('.spinner').hide();
                    },
                    error: function() {
                        $('.spinner').hide();
                        alert('Gagal memuat data.');
                    }
                });
            }

            // Live search (delay 300ms)
            $('#search').on('keyup', function() {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    fetchUsers();
                }, 300);
            });

            // Filter role
            $('#roleFilter').on('change', function() {
                fetchUsers();
            });

            // Pagination dinamis
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                fetchUsers(page);
            });

            // Toggle status via AJAX
            $(document).on('click', '.status-toggle', function() {
                let id = $(this).data('id');
                let span = $(this);

                $.ajax({
                    url: "{{ url('users') }}/" + id + "/toggle-status",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        span.text(res.is_active.charAt(0).toUpperCase() + res.is_active.slice(
                            1));
                        span.removeClass('text-success text-danger').addClass(res.color);

                        Swal.fire({
                            icon: 'success',
                            title: 'Status Berhasil Diubah!',
                            text: 'User kini berstatus ' + res.is_active,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Tidak dapat mengubah status user.'
                        });
                    }
                });
            });
        });
    </script>

    <!-- 🔔 Tampilkan notifikasi create/edit/delete -->
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: '{{ session('error') }}'
            });
        @endif
    </script>
@endsection
