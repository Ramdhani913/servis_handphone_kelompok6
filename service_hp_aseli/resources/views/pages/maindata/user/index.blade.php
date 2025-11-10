@extends('layouts.app')

@section('content')
    {{-- === STYLE UTAMA (Konsisten dengan halaman CREATE USER) === --}}
    <style>
        body {
            background-color: #12121c;
        }

        .container-new {
            width: 100%;
            margin: 40px auto;
            padding: 50px 24px;
            box-sizing: border-box;
        }

        .card-fullscreen {
            background-color: #1e1e2d;
            color: #fff;
            border-radius: 12px;
            padding: 50px 50px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .card-fullscreen h4 {
            font-weight: 600;
            margin-bottom: 30px;
            font-size: 1.5rem;
        }

        input#search,
        select#roleFilter {
            background-color: #26263b;
            border: 1px solid #444;
            color: #fff;
            border-radius: 8px;
            padding: 8px 12px;
            width: 250px;
        }

        select#roleFilter {
            width: 180px;
        }

        .spinner {
            display: none;
            color: #6c63ff;
        }

        .btn-tambah {
            background-color: #6c63ff;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            padding: 10px 25px;
            box-shadow: 0 0 10px rgba(108, 99, 255, 0.5);
            transition: 0.3s;
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

        /* === Pagination (sama kayak service item) === */
        .pagination-wrapper {
            margin-top: 25px;
            display: flex;
            justify-content: flex-start;
        }

        @media (max-width: 768px) {
            .pagination-wrapper {
                justify-content: center;
            }
        }

        .pagination {
            margin-bottom: 0;
            gap: 6px;
        }

        .pagination .page-item {
            margin: 0 3px;
        }

        .pagination .page-link {
            background-color: #1f1f2f;
            color: #cfcfff;
            border: 1px solid #33334d;
            border-radius: 10px;
            padding: 8px 14px;
            transition: all 0.25s ease;
            font-weight: 500;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .pagination .page-link:hover {
            background-color: #6c63ff;
            color: #fff;
            border-color: #6c63ff;
            box-shadow: 0 0 10px rgba(108, 99, 255, 0.6);
        }

        .pagination .page-item.active .page-link {
            background-color: #7b74ff;
            color: #fff;
            border-color: #7b74ff;
            font-weight: 600;
            box-shadow: 0 0 12px rgba(123, 116, 255, 0.8);
        }

        .pagination .page-item.disabled .page-link {
            background-color: #2b2b3f;
            color: #7777aa;
            border-color: #2b2b3f;
            opacity: 0.6;
        }

        /* === Notif Warning sejajar dengan Success === */
        .swal2-icon.swal2-warning {
            transform: translateY(3px) !important;
        }
    </style>

    {{-- === CONTENT === --}}
    <div class="container-new">
        <div class="card-fullscreen">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <h4 class="mb-0">Table User</h4>
                <a href="{{ route('users.create') }}" class="btn btn-tambah mt-2 mt-md-0">
                    <i class="mdi mdi-plus-circle-outline me-1"></i> Tambah User
                </a>
            </div>

            {{-- 🔍 Search & Filter --}}
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

            {{-- Table User --}}
            <div id="userTable">
                @include('pages.maindata.user.table', ['users' => $users])

                {{-- Pagination --}}
                <div class="pagination-wrapper">
                    {{ $users->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    {{-- === SweetAlert Flash Message === --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    {{-- === AJAX (tidak diubah) === --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
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
                        Swal.fire('Error', 'Gagal memuat data.', 'error');
                    }
                });
            }

            $('#search').on('keyup', function() {
                clearTimeout(timer);
                timer = setTimeout(fetchUsers, 300);
            });

            $('#roleFilter').on('change', function() {
                fetchUsers();
            });

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                fetchUsers(page);
            });

            // Toggle Status
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
                        Swal.fire('Berhasil', 'Status user diubah menjadi ' + res.is_active,
                            'success');
                    },
                    error: function() {
                        Swal.fire('Gagal', 'Tidak dapat mengubah status user.', 'error');
                    }
                });
            });

            // Delete confirm
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                let name = $(this).data('name') || 'User ini';

                Swal.fire({
                    title: 'Hapus ' + name + '?',
                    text: 'Data akan hilang permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e74c3c',
                    cancelButtonColor: '#6c63ff',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    padding: '1.5rem',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
