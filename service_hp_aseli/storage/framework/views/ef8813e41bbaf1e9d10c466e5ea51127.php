<style>
    .container-new {
    max-width: 1400px; /* wider than bootstrap container */
    width: 100%;
    margin-left: auto;
    margin-right: auto;
    padding-left: 24px;
    padding-right: 24px;
    box-sizing: border-box;

     .user-photo {
    margin-top: 15px;
    display: flex;
    align-items: center;
  }

  .user-photo img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    border: 2px solid #3f3f55;
    object-fit: cover;
  }
}
</style>

<?php $__env->startSection('content'); ?>
<form method="POST" action="/handphones/<?php echo e($handphone->id); ?>/update" enctype="multipart/form-data">
  <?php echo csrf_field(); ?>
  <div class="container-new">
    <div class="row">
      <div class="col-lg-12 col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Create Handphone</h4>

             <div class="user-photo">
              <img src="<?php echo e(asset('storage/'. $handphone->image)); ?>" alt="User Photo">
            </div>

            <!-- Model -->
            <div class="form-group">
              <label class="col-form-label">Model</label>
              <input type="text" class="form-control" name="model" value="<?php echo e(old('model', $handphone->model)); ?>" required>
            </div>

            <!-- Brand -->
            <div class="form-group">
              <label class="col-form-label">Brand</label>
              <input type="text" class="form-control" name="brand" value="<?php echo e(old('brand', $handphone->brand)); ?>" required>
            </div>

            <!-- Tahun Rilis (Select Dropdown) -->
            <div class="form-group">
              <label class="col-form-label">Release Year</label>
              <select class="form-control" id="release_year" name="release_year" required>
                <option value="value="<?php echo e(old('model', $handphone->model)); ?>></option>
              </select>
            </div>

            <!-- Upload Foto -->
            <div class="form-group">
              <label class="col-form-label">Foto</label>
              <div class="row g-2">
                <div class="col-9">
                  <label for="image" class="form-control mb-0 d-flex align-items-center" style="cursor:pointer;">
                    <span id="file-name-label">Upload Foto</span>
                  </label>
                </div>
                <div class="col-3">
                  <input type="text" id="file-name-display" class="form-control" readonly placeholder="No file">
                </div>
              </div>
              <input type="file" id="image" name="image" style="display:none;"
                onchange="(function(f){ 
                  document.getElementById('file-name-label').textContent = f?.name || 'Upload Foto'; 
                  document.getElementById('file-name-display').value = f?.name || ''; 
                })(this.files[0]);">
            </div>

            <input type="hidden" name="is_active" value="active">

            <div class="mt-3">
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <button type="reset" class="btn btn-dark">Cancel</button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- JS: Buat dropdown tahun otomatis -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('release_year');
    const currentYear = new Date().getFullYear();
    const startYear = 1990; // bisa diubah sesuai kebutuhan

    for (let year = currentYear; year >= startYear; year--) {
        const option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        select.appendChild(option);
    }
});

$.ajax({
    url: "<?php echo e(route('handphones.checkDuplicate')); ?>",
    method: "POST",
    data: {
        _token: '<?php echo e(csrf_token()); ?>',
        brand: brand,
        model: model,
        id: '<?php echo e($handphone->id); ?>'
    },
    success: function(res) {
        if (res.duplicate) {
            $('#duplicate-warning').show();
            $('#submitBtn').prop('disabled', true);
        } else {
            $('#duplicate-warning').hide();
            $('#submitBtn').prop('disabled', false);
        }
    }
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rendr\Desktop\desktop\service_hp_aseli\resources\views\pages\maindata\handphone\edit.blade.php ENDPATH**/ ?>