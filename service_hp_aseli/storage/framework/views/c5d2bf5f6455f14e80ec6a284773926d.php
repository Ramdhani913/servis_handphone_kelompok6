
<table class="table table-hover text-white">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Service</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $serviceitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($serviceitems->firstItem() + $loop->index); ?></td>
                <td><?php echo e($item->service_name); ?></td>
                <td>Rp <?php echo e(number_format($item->price, 0, ',', '.')); ?></td>
                <td>
                    <span class="status-toggle <?php echo e($item->is_active === 'active' ? 'text-success' : 'text-danger'); ?>"
                        data-id="<?php echo e($item->id); ?>" style="cursor:pointer;">
                        <?php echo e($item->is_active); ?>

                    </span>
                </td>
                <td>
                    <a href="<?php echo e(route('serviceitems.edit', $item->id)); ?>" class="btn btn-sm btn-edit">Edit</a>
                    <form action="<?php echo e(route('serviceitems.destroy', $item->id)); ?>" method="POST" style="display:inline;"
                        class="delete-form">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="button" class="btn btn-sm btn-delete" data-name="<?php echo e($item->service_id); ?>">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="5" class="text-center text-muted">Tidak ada data service item.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php /**PATH C:\Users\rendr\Desktop\desktop\service_hp_aseli\resources\views\pages\maindata\serviceitem\table.blade.php ENDPATH**/ ?>