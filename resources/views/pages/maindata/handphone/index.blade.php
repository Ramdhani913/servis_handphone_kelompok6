@extends('layouts.app')

@section('content')
    {{-- === STYLE UTAMA (Warna gelap tapi tidak hitam) === --}}
    <style>
        body {
            background-color: #12121c;
            /* tetap gelap tapi bukan hitam murni */
        }

        .container-new {
            width: 100%;
            margin: 40px auto;
            padding: 50px 24px;
            box-sizing: border-box;
        }

        .card-fullscreen {
            background-color: #1e1e2d;
            /* gelap ungu/abu, bukan hitam */
            color: #fff;
            border-radius: 12px;
            padding: 50px 50px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            /* soft shadow */
        }

        .card-fullscreen h4 {
            font-weight: 600;
            margin-bottom: 30px;
            font-size: 1.5rem;
        }

        input#search {
            background-color: #26263b;
            /* gelap tapi bukan hitam */
            border: 1px solid #444;
            color: #fff;
            border-radius: 8px;
            padding: 8px 12px;
            width: 250px;
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
            background-color: #2b2b3f;
            /* lebih gelap tapi tidak hitam */
            transition: background 0.2s ease;
        }

        .table-hover tbody tr:hover {
            background-color: #3c3c5a;
            /* hover lebih terang dari hitam */
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

        /* === Pagination === */
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

        .pagination .page-link {
            background-color: #2b2b3f;
            /* gelap tapi bukan hitam */
            color: #cfcfff;
            border: 1px solid #444466;
            border-radius: 10px;
            padding: 8px 14px;
            font-weight: 500;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            transition: all 0.25s ease;
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
            background-color: #3c3c5a;
            color: #7777aa;
            border-color: #3c3c5a;
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
                <h4 class="mb-0">Table Handphone</h4>
                <a href="{{ route('handphones.create') }}" class="btn btn-tambah mt-2 mt-md-0">
                    <i class="mdi mdi-plus-circle-outline me-1"></i> Tambah Data
                </a>
            </div>

            {{-- 🔍 Live Search --}}
            <div class="d-flex align-items-center mb-4">
                <input type="text" id="search" placeholder="Cari brand / model..." />
                <span class="spinner ms-2"><i class="mdi mdi-loading mdi-spin"></i></span>
            </div>

            <div id="handphoneTable">
                @include('pages.maindata.handphone.table', ['handphones' => $handphones])

                {{-- Pagination --}}
                <div class="pagination-wrapper">
                    {{ $handphones->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            let timer = null;

            function fetchHandphones(page = 1) {
                let search = $('#search').val();
                $('.spinner').show();

                $.ajax({
                    url: "{{ route('handphones.index') }}",
                    type: "GET",
                    data: {
                        search: search,
                        page: page
                    },
                    success: function(data) {
                        // ✅ Fix: deteksi apakah response partial atau full page
                        if (data.includes('<table')) {
                            // Kalau controller return partial table (pada request AJAX)
                            $('#handphoneTable').html(data);
                        } else {
                            // Kalau controller return full page (normal reload)
                            let newContent = $(data).find('#handphoneTable').html();
                            $('#handphoneTable').html(newContent);
                        }
                        $('.spinner').hide();
                    },
                    error: function() {
                        $('.spinner').hide();
                        Swal.fire('Error', 'Gagal memuat data', 'error');
                    }
                });
            }

            $('#search').on('keyup', function() {
                clearTimeout(timer);
                timer = setTimeout(fetchHandphones, 300);
            });

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                fetchHandphones(page);
            });

            // Toggle Status
            $(document).on('click', '.status-toggle', function() {
                let id = $(this).data('id');
                let span = $(this);

                $.ajax({
                    url: "{{ url('handphones') }}/" + id + "/toggle-status",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        span.text(res.is_active);
                        span.removeClass('text-success text-danger')
                            .addClass(res.is_active === 'active' ? 'text-success' :
                                'text-danger');
                        Swal.fire('Berhasil', 'Status berhasil diubah', 'success');
                    },
                    error: function() {
                        Swal.fire('Error', 'Gagal mengubah status', 'error');
                    }
                });
            });
        });
    </script>

    {{-- SweetAlert Flash Messages --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
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
                title: 'Gagal',
                text: '{{ session('error') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
@endsection
