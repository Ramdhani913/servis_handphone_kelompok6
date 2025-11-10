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
      <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <tr>
        <td>
          <?php if($user->image): ?>
            <img src="<?php echo e(asset('storage/' . $user->image)); ?>" class="rounded-circle" width="40" height="40" alt="image">
          <?php else: ?>
            <span class="text-secondary">No Image</span>
          <?php endif; ?>
        </td>
        <td><?php echo e($user->name); ?></td>
        <td><span class="fw-bold text-danger"><?php echo e($user->role); ?></span></td>
        <td>
          <span class="fw-bold status-toggle <?php echo e($user->is_active == 'active' ? 'text-success' : 'text-danger'); ?>"
                data-id="<?php echo e($user->id); ?>"
                style="cursor: pointer;">
                <?php echo e(ucfirst($user->is_active)); ?>

          </span>
        </td>
        <td>
          <a href="<?php echo e(route('users.edit', $user->id)); ?>"><button class="btn btn-edit btn-sm">Edit</button></a>
          <form action="/users/<?php echo e($user->id); ?>/delete" method="POST" style="display:inline;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-delete btn-sm" onclick="return confirm('Yakin hapus user ini?');">Delete</button>
          </form>
          <a href="<?php echo e(route('users.show', $user->id)); ?>"><button class="btn btn-detail btn-sm">Detail</button></a>
        </td>
      </tr> 
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <tr>
        <td colspan="5" class="text-secondary py-3">Tidak ada data ditemukan.</td>
      </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
  <?php echo e($users->appends(request()->query())->links('pagination::bootstrap-5')); ?>

</div>
<?php /**PATH C:\Users\rendr\Desktop\desktop\service_hp_aseli\resources\views\pages\maindata\user\table.blade.php ENDPATH**/ ?>