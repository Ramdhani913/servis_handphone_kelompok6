@extends('layouts.app')

@section('content')
<<<<<<< HEAD
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
=======
<style>
  body {
    background-color: #12121c;
  }

  /* Tambah jarak dari navbar biar ga kehalang */
  .content-wrapper {
    padding-top: 90px !important; /* sesuaikan kalau navbar kamu tinggi */
  }

  .card {
    background-color: #1e1e2d !important;
    border: none;
    border-radius: 12px;
    color: #ffffff;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
  }

  .card-title {
    color: #ffffff;
    font-weight: 600;
    font-size: 22px;
  }

  .btn-tambah {
    background-color: #6c63ff;
    color: #fff;
    font-weight: 600;
    border-radius: 8px;
    padding: 10px 25px;
    text-transform: capitalize;
    font-size: 16px;
    box-shadow: 0 0 10px rgba(108, 99, 255, 0.5);
    transition: 0.2s;
  }
  .btn-tambah:hover {
    background-color: #5a52e0;
    box-shadow: 0 0 15px rgba(108, 99, 255, 0.7);
    transform: translateY(-1px);
  }

  table {
    color: #e6e6e6;
    background-color: transparent;
  }

  th {
    color: #b0b0b0;
    font-weight: 600;
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
  .btn-edit:hover { background-color: #d9a100; }

  .btn-delete {
    background-color: #e74c3c;
    color: #fff;
    font-weight: 600;
    border: none;
  }
  .btn-delete:hover { background-color: #c0392b; }

  .btn-detail {
    background-color: #2ecc71;
    color: #fff;
    font-weight: 600;
    border: none;
  }
  .btn-detail:hover { background-color: #27ae60; }

  td, th {
    vertical-align: middle !important;
  }

  .text-success { color: #2ecc71 !important; }
  .text-danger { color: #e74c3c !important; }
  .text-info { color: #3498db !important; }

</style>

<div class="container-fluid grid-margin stretch-card content-wrapper">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="card-title mb-0">Table User</h4>
        <a href="/users/create" class="btn btn-tambah">
          <i class="mdi mdi-plus-circle-outline me-1"></i> Tambah User
        </a>
      </div>

      <div class="table-responsive">
        <table class="table table-hover text-center align-middle">
          <thead>
            <tr>
              <th>Photo</th>
              <th>Nama</th>
              <th>Role</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
              <td><img  src="{{ asset('storage/'. $user->image) }}" class="rounded-circle" width="40" height="40" alt="image"></td>
              <td>{{ $user->name }}</td>
              <td><span class="text-danger fw-bold">{{ $user->role }}</span></td>
              <td><span class="text-success fw-bold">{{ $user->is_active }}</span></td>
              <td>
                <a href={{ route('users.edit', $user->id) }}><button class="btn btn-edit btn-sm">Edit</button></a>
                <form action="/users/{{ $user->id }}/delete" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-delete btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                </form>
                <a href="{{ route('users.show', $user->id) }}"><button class="btn btn-detail btn-sm">Detail</button></a>
              </td>
            </tr> 
            @endforeach
           
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
>>>>>>> 0cdab11c69774ac7f57a244149b56b3da6621235
@endsection
