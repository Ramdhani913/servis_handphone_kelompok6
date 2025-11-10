<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/mdi/css/materialdesignicons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/css/vendor.bundle.base.css')); ?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/jvectormap/jquery-jvectormap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/owl-carousel-2/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css')); ?>">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/mdi/css/materialdesignicons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/css/vendor.bundle.base.css')); ?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/select2/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')); ?>">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>">
    <style>
        
        .full-bg {
            width: 100vw;
            min-height: 100vh;
            margin-left: calc(-50vw + 50%);
            margin-right: calc(-50vw + 50%);
            background: #fff;
            /* Change to your desired background color */
        }
    </style>

    
    <!-- jQuery dulu, baru SweetAlert -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <!-- partial -->
            <?php echo $__env->yieldContent('content'); ?>
            <!-- main-panel ends -->

        </div>
        <!-- page-body-wrapper ends -->

    </div>
    <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->




    
    <script src="<?php echo e(asset('assets/extensions/toastify-js/src/toastify.js')); ?>"></script>
    <?php if(session('success')): ?>
        <script>
            Toastify({
                text: "<?php echo e(session('success')); ?>",
                duration: 3000,
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
            }).showToast()
        </script>
    <?php endif; ?>
    <?php if(session('errors')): ?>
        <script>
            Toastify({
                text: "<?php echo e(session('errors')); ?>",
                duration: 3000,
                backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
            }).showToast()
        </script>
    <?php endif; ?>
    <?php if(session('info')): ?>
        <script>
            Toastify({
                text: "<?php echo e(session('info')); ?>",
                duration: 3000,
            }).showToast()
        </script>
    <?php endif; ?>

    <script>
        function toastifyConfirm(url) {
            var deleteButton = document.querySelectorAll(".delete-button");

            for (var i = 0; i < deleteButton.length; i++) {
                deleteButton[i].disabled = true;
            }

            let confirmHtml = `
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <span>Are you sure?</span>
                    <small>This action cannot be undone.</small>
                    <hr>
                    <div class="d-flex justify-content-between gap-2">
                        <button id="yesBtn" class="btn btn-outline-white w-100">Yes</button>
                        <button id="noBtn" class="btn btn-outline-white w-100">Cancel</button>
                    </div>
                </div>
            `;

            let toast = Toastify({
                node: (() => {
                    const div = document.createElement("div");
                    div.innerHTML = confirmHtml;
                    return div;
                })(),
                duration: -1,
                close: false,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    borderRadius: "8px",
                },
                backgroundColor: "linear-gradient(to right, #435ebe, #198754)",
                onClick: function() {}
            }).showToast();

            setTimeout(() => {
                document.getElementById("yesBtn")?.addEventListener("click", () => {
                    toast.hideToast();
                    window.location.href = url;
                });

                document.getElementById("noBtn")?.addEventListener("click", () => {
                    toast.hideToast();

                    for (var i = 0; i < deleteButton.length; i++) {
                        deleteButton[i].disabled = false;
                    }
                });
            }, 100);
        }
    </script>

    <script>
        $(document).ready(function() {
            $(".currency").on("keyup", function() {
                var currencyVal = $(this).val();
                var currencyValNumber = currencyVal.replace(/[^0-9]/g, '');
                var formatted = currencyValNumber.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                $(this).val(formatted);
            });

            $(".currency").each(function() {
                var currencyVal = $(this).val();
                var currencyValNumber = currencyVal.replace(/[^0-9]/g, '');
                var formatted = currencyValNumber.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                $(this).val(formatted);
            });
        });

        // idr format
        function currency(value) {
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>

    <script src="<?php echo e(asset('vendors/js/vendor.bundle.base.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo $__env->yieldPushContent('custom.js'); ?>
</body>

</html>
<?php /**PATH C:\Users\rendr\Desktop\desktop\service_hp_aseli\resources\views\layouts\app.blade.php ENDPATH**/ ?>