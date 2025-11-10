<?php $__env->startSection('content'); ?>
    <style>
        body {
            background-color: #12121c;
        }

        .container-new {
            max-width: auto;
            width: 100%;
            margin: 40px auto;
            padding: 100px 24px;
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

        input#search {
            background-color: #26263b;
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
            background-color: #26263b !important;
            transition: background 0.2s ease;
        }

        .table-hover tbody tr:hover {
            background-color: #343453 !important;
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 25px;
            display: flex;
            justify-content: flex-start;
            /* kiri di desktop */
        }

        @media (max-width: 768px) {
            .pagination-wrapper {
                justify-content: center;
                /* tengah di HP */
            }
        }

        .pagination {
            margin-bottom: 0;
            gap: 0px;
        }

        .pagination .page-item {
            margin: 0 3px;
        }

        .pagination .page-link {
            background-color: #1f1f2f;
            /* gelap lembut */
            color: #cfcfff;
            /* teks ungu muda */
            border: 1px solid #33334d;
            border-radius: 10px;
            padding: 8px 14px;
            transition: all 0.25s ease;
            font-weight: 500;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .pagination .page-link:hover {
            background-color: #6c63ff;
            /* warna utama */
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
    </style>

    
    <div class="container-new">
        <div class="card-fullscreen">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <h4 class="mb-0">Table Service Item</h4>
                <a href="<?php echo e(route('serviceitems.create')); ?>" class="btn btn-tambah mt-2 mt-md-0">
                    <i class="mdi mdi-plus-circle-outline me-1"></i> Tambah Service Item
                </a>
            </div>

            <div class="d-flex align-items-center mb-4">
                <input type="text" id="search" placeholder="Cari nama service..." />
                <span class="spinner ms-2"><i class="mdi mdi-loading mdi-spin"></i></span>
            </div>

            <div id="serviceTable">
                <?php echo $__env->make('pages.maindata.serviceitem.table', ['serviceitems' => $serviceitems], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <div class="pagination-wrapper">
                    <?php echo e($serviceitems->links('pagination::bootstrap-4')); ?>

                </div>

            </div>
        </div>
    </div>

    
    <?php if(session('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?php echo e(session('success')); ?>',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '<?php echo e(session('error')); ?>',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    <?php endif; ?>

    
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            let timer = null;

            function fetchServiceItems(page = 1) {
                let search = $('#search').val();
                $('.spinner').show();

                $.ajax({
                    url: "<?php echo e(route('serviceitems.index')); ?>",
                    type: "GET",
                    data: {
                        search: search,
                        page: page
                    },
                    success: function(data) {
                        $('#serviceTable').html($(data).find('#serviceTable').html());
                        $('.spinner').hide();
                    },
                    error: function() {
                        $('.spinner').hide();
                        Swal.fire('Error', 'Gagal memuat data.', 'error');
                    }
                });
            }

            // Search
            $('#search').on('keyup', function() {
                clearTimeout(timer);
                timer = setTimeout(fetchServiceItems, 300);
            });

            // Toggle Status
            $(document).on('click', '.status-toggle', function() {
                let id = $(this).data('id');
                let span = $(this);

                $.post("<?php echo e(route('serviceitems.toggle', ':id')); ?>".replace(':id', id), {}, function(res) {
                    span.text(res.is_active);
                    span.removeClass('text-success text-danger')
                        .addClass(res.is_active === 'active' ? 'text-success' : 'text-danger');
                    Swal.fire('Berhasil', 'Status berhasil diubah', 'success');
                }).fail(function() {
                    Swal.fire('Gagal', 'Gagal mengubah status.', 'error');
                });
            });

            // Delete confirm
            $(document).ready(function() {
                $('.btn-delete').click(function(e) {
                    e.preventDefault();
                    let form = $(this).closest('form');
                    let name = $(this).data('name');

                    Swal.fire({
                        title: 'Hapus "' + name + '"?',
                        text: 'Data akan hilang permanen!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e74c3c',
                        cancelButtonColor: '#6c63ff',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        padding: '1.5rem',
                        heightAuto: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rendr\Desktop\desktop\service_hp_aseli\resources\views/pages/maindata/serviceitem/index.blade.php ENDPATH**/ ?>