<?php $__env->startSection('content'); ?>
<style>
    .card-fullscreen {
        width: 1300px; /* kamu bisa ubah jadi 1400px jika ingin lebih lebar */
        margin: 40px auto;
        background-color: #1e1e2d;
        color: #fff;
        border-radius: 12px;
        padding: 60px;
        box-shadow: 0 0 20px rgba(0,0,0,0.3);
    }

    .form-control-custom {
        background-color: #2a2a3c;
        border: none;
        color: #fff;
        border-radius: 8px;
        padding: 12px 16px;
        width: 100%;
    }

    .form-control-custom:focus {
        outline: none;
        background-color: #33334d;
    }

    .btn-submit {
        background-color: #007bff;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        color: #fff;
        font-weight: 600;
    }

    .btn-cancel {
        background-color: #000;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        color: #fff;
        font-weight: 600;
        margin-left: 10px;
    }

    .row-full {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .col-half {
        flex: 1;
        min-width: 48%;
    }
</style>

<div class="card-fullscreen">
    <h3>Create Handphone</h3>
    <form id="handphoneForm" action="<?php echo e(route('handphones.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <br>
        <br>
        <div class="row-full">
            <div class="col-half">
                <label>Brand</label>
                <input type="text" id="brand" name="brand" class="form-control-custom" placeholder="Masukkan merek handphone" required>
            </div>

            <div class="col-half">
                <label>Model</label>
                <input type="text" id="model" name="model" class="form-control-custom" placeholder="Masukkan model handphone" required>
            </div>

            <div class="col-half">
                <label>Release Year</label>
                <select name="release_year" class="form-control-custom" required>
                    <option value="">Pilih tahun rilis</option>
                    <?php for($i = date('Y'); $i >= 2000; $i--): ?>
                        <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="col-half">
              <div class="form-group">
                <label class="col-form-label">Foto</label>
                <div class="row g-2">
                  <div class="col-6">
                    <label for="image" class="form-control mb-0 d-flex align-items-center" style="cursor:pointer;">
                      <span id="file-name-label">Upload Foto</span>
                    </label>
                  </div>
                  <div class="col-6">
                    <input type="text" id="file-name-display" class="form-control" readonly placeholder="No file">
                  </div>
                </div>
                <input type="file" id="image" name="image" style="display:none;"
                  onchange="(function(f){ 
                    document.getElementById('file-name-label').textContent = f?.name || 'Upload Foto'; 
                    document.getElementById('file-name-display').value = f?.name || ''; 
                  })(this.files[0]);">
              </div>
            </div>
        </div>

        <div id="duplicate-warning" style="display:none; color:red; margin-top:10px;">
            Data dengan brand dan model yang sama sudah ada!
        </div>

        <div style="margin-top: 24px;">
            <button type="submit" id="submitBtn" class="btn-submit">Submit</button>
            <a href="<?php echo e(route('handphones.index')); ?>" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

<script>
    // Cek duplikasi brand & model dengan AJAX
    document.getElementById('brand').addEventListener('input', checkDuplicate);
    document.getElementById('model').addEventListener('input', checkDuplicate);

    function checkDuplicate() {
        const brand = document.getElementById('brand').value;
        const model = document.getElementById('model').value;

        if (brand && model) {
            fetch("<?php echo e(route('handphones.checkDuplicate')); ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                },
                body: JSON.stringify({ brand, model })
            })
            .then(res => res.json())
            .then(data => {
                if (data.duplicate) {
                    document.getElementById('duplicate-warning').style.display = 'block';
                    document.getElementById('submitBtn').disabled = true;
                } else {
                    document.getElementById('duplicate-warning').style.display = 'none';
                    document.getElementById('submitBtn').disabled = false;
                }
            });
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rendr\Desktop\desktop\service_hp_aseli\resources\views\pages\maindata\handphone\create.blade.php ENDPATH**/ ?>