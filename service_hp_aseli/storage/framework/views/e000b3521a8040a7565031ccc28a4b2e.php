<?php $__env->startSection('content'); ?>
<style>
  /* ====== DETAIL HANDPHONE STYLE (SAMA SEPERTI FIGMA) ====== */
  body {
    background-color: #181824;
  }

  .card-detail {
    background-color: #1e1e2d;
    border: none;
    border-radius: 12px;
    color: #ffffff;
    padding: 30px 40px;
    margin-top: 30px;
  }

  .card-detail h4 {
    font-size: 20px;
    font-weight: 600;
    color: #fff;
    margin-bottom: 25px;
  }

  .info-item {
    display: flex;
    flex-direction: column;
    margin-bottom: 18px;
  }

  .info-item label {
    color: #a0a0b2;
    font-size: 14px;
    margin-bottom: 4px;
  }

  .info-item span {
    font-size: 15px;
    font-weight: 500;
    color: #ffffff;
  }

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

  .content-wrapper {
    padding: 40px;
  }
</style>

<div class="content-wrapper">
  <div class="card-detail">
    <h4>Detail HAandphone</h4>

     <div class="info-item">
      <label>Upload Foto</label>
      <div class="user-photo">
        <img src="<?php echo e(asset('storage/'. $handphone->image)); ?>" alt="Handphone  Photo">
      </div>
    </div>

    <div class="info-item">
      <label>Brand</label>
      <span><?php echo e($handphone->brand); ?></span>
    </div>

    <div class="info-item">
      <label>Model</label>
      <span><?php echo e($handphone->model); ?></span>
    </div>

    <div class="info-item">
      <label>Tahun Rilis</label>
      <span><?php echo e($handphone->release_year); ?></span>
    </div>

    <div class="info-item">
      <label>Status</label>
      <span>aktif</span>
    </div>

   
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rendr\Desktop\desktop\service_hp_aseli\resources\views\pages\maindata\handphone\detail.blade.php ENDPATH**/ ?>