<div class="table-responsive">
  <table class="table table-hover text-center align-middle">
    <thead>
      <tr>
        <th>Photo</th>
        <th>Brand</th>
        <th>Model</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php $__empty_1 = true; $__currentLoopData = $handphones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <tr>
        <td><img src="<?php echo e(asset('storage/' . $phone->image)); ?>" class="rounded-circle" width="40" height="40"></td>
        <td><?php echo e($phone->brand); ?></td>
        <td><?php echo e($phone->model); ?></td>
        <td>
          <span class="status-toggle fw-bold <?php echo e($phone->is_active == 'active' ? 'text-success' : 'text-danger'); ?>" style="cursor:pointer" data-id="<?php echo e($phone->id); ?>">
            <?php echo e($phone->is_active); ?>

          </span>
        </td>
        <td>
          <a href="<?php echo e(route('handphones.edit', $phone->id)); ?>" class="btn btn-edit btn-sm">Edit</a>
          <form action="<?php echo e(route('handphones.destroy', $phone->id)); ?>" method="POST" class="d-inline">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button class="btn btn-delete btn-sm" type="submit" onclick="return confirm('Yakin hapus Model ini?');">Delete</button>
          </form>
          <a href="<?php echo e(route('handphones.show', $phone->id)); ?>" class="btn btn-detail btn-sm">Detail</a>
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <tr><td colspan="5" class="text-center text-muted">Tidak ada data</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
  <div class="d-flex justify-content-center">
    <?php echo e($handphones->links()); ?>

  </div>
</div>
<?php /**PATH C:\Users\rendr\Desktop\desktop\service_hp_aseli\resources\views\pages\maindata\handphone\table.blade.php ENDPATH**/ ?>