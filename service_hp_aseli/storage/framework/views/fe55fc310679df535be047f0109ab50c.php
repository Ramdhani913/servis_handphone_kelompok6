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

        .form-control {
            background-color: #26263b;
            border: 1px solid #444;
            color: #fff;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 1rem;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .btn-primary {
            background-color: #6c63ff;
            border: none;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(108, 99, 255, 0.5);
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #5a52e0;
        }

        .btn-dark {
            background-color: #333;
            border: none;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 8px;
            transition: 0.3s;
            color: #fff;
            margin-left: 10px;
        }

        .btn-dark:hover {
            background-color: #555;
        }

        .form-actions {
            display: flex;
            justify-content: flex-start;
            margin-top: 30px;
        }

        @media (max-width: 768px) {
            .card-fullscreen {
                padding: 20px 20px;
            }

            .btn-primary,
            .btn-dark {
                width: 100%;
                margin-bottom: 10px;
            }

            .form-actions {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>

    <div class="container-new">
        <form action="/serviceitems/store" method="POST">
            <?php echo csrf_field(); ?>
            <div class="card-fullscreen">
                <h4>Create Service Item</h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">Name</label>
                            <input type="text" class="form-control" name="service_name" placeholder="Service name"
                                required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">Price</label>
                            <input type="text" id="price" class="form-control" name="price" placeholder="Rp.0"
                                required>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo e(route('serviceitems.index')); ?>">
                        <button type="button" class="btn btn-dark">Cancel</button>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            var priceInput = $('#price');

            // Set default value saat load
            priceInput.val('Rp.0');

            // Fokus: hilangkan angka 0 tapi sisakan Rp.
            priceInput.focus(function() {
                var val = $(this).val().replace(/\D/g, '');
                if (val === '0' || val === '') {
                    $(this).val('Rp.');
                }
            });

            // Blur: jika kosong, isi Rp.0; jika ada angka, format ribuan
            priceInput.blur(function() {
                var val = $(this).val().replace(/\D/g, '');
                if (val === '') val = '0';
                $(this).val('Rp.' + Number(val).toLocaleString('id-ID'));
            });

            // Input: otomatis format ribuan tapi tetap ada Rp.
            priceInput.on('input', function() {
                var val = $(this).val().replace(/\D/g, '');
                if (val === '') {
                    $(this).val('Rp.');
                } else {
                    $(this).val('Rp.' + Number(val).toLocaleString('id-ID'));
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rendr\Desktop\desktop\service_hp_aseli\resources\views\pages\maindata\serviceitem\create.blade.php ENDPATH**/ ?>