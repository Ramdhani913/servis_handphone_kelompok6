<?php $__env->startSection('content'); ?>
<style>
  body {
    background-color: #12121c;
  }

  .content-wrapper {
    padding-top: 90px !important;
  }

  .card {
    background-color: #1e1e2d !important;
    border: none;
    border-radius: 12px;
    color: #ffffff;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
  }

  .card-title {
    color: #ffffff;
    font-weight: 600;
    font-size: 22px;
  }

  .btn-tambah {
    background-color: #6c63ff;
    color: #fff;
    font-weight: 600;
    border-radius: 8px;
    padding: 10px 25px;
    text-transform: capitalize;
    font-size: 16px;
    box-shadow: 0 0 10px rgba(108, 99, 255, 0.5);
    transition: 0.2s;
  }

  .btn-tambah:hover {
    background-color: #5a52e0;
    box-shadow: 0 0 15px rgba(108, 99, 255, 0.7);
    transform: translateY(-1px);
  }

  table {
    color: #e6e6e6;
    background-color: transparent;
  }

  th {
    color: #b0b0b0;
    font-weight: 600;
  }

  .table tbody tr {
    background-color: #26263b !important;
    transition: background 0.2s ease;
  }

  .table-hover tbody tr:hover {
    background-color: #343453 !important;
  }

  td, th {
    vertical-align: middle !important;
  }

  .btn-detail {
    background-color: #2ecc71;
    color: #fff;
    font-weight: 600;
    border: none;
  }

  .btn-detail:hover {
    background-color: #27ae60;
  }

  .btn-payment {
    background-color: #3498db;
    color: #fff;
    font-weight: 600;
    border: none;
  }

  .btn-payment:hover {
    background-color: #2980b9;
  }

  .btn-payment.disabled,
  .btn-payment:disabled {
    background-color: #3a3a50 !important;
    cursor: not-allowed;
    opacity: 0.6;
  }

  .badge {
    padding: 6px 10px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 12px;
  }

  .badge-info { background-color: #3498db; color: #fff; }
  .badge-warning { background-color: #f39c12; color: #fff; }
  .badge-success { background-color: #2ecc71; color: #fff; }
  .badge-danger { background-color: #e74c3c; color: #fff; }

  .dote {
    height: 10px;
    width: 10px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 6px;
  }

  .dote-success { background-color: #2ecc71; }
  .dote-danger { background-color: #e74c3c; }

</style>

<div class="container-fluid grid-margin stretch-card content-wrapper">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="card-title mb-0">Services Handphone</h4>
        <a href="<?php echo e(route('services.create')); ?>" class="btn btn-tambah">
          <i class="mdi mdi-plus-circle-outline me-1"></i> Add Service
        </a>
      </div>

      <div class="table-responsive">
        <table class="table table-hover text-center align-middle" id="tableService">
          <thead>
            <tr>
              <th>#</th>
              <th>No Invoice</th>
              <th>Customer</th>
              <th>Handphone</th>
              <th>Status Paid</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($index + 1); ?></td>
              <td><?php echo e($service->no_invoice); ?></td>
              <td><?php echo e($service->customer->name); ?></td>
              <td><?php echo e($service->handphones->brand); ?> | <?php echo e($service->handphones->model); ?></td>
              <td class="status-paid" data-paid="<?php echo e($service->status_paid); ?>">
    <?php if($service->status_paid == 0): ?>
        <span class="dote dote-success"></span>
        <small class="text-success fw-bold">Paid</small>
    <?php elseif($service->status_paid == 1): ?>
        <span class="dote dote-warning"></span>
        <small class="text-warning fw-bold">Debt</small>
    <?php else: ?>
        <span class="dote dote-danger"></span>
        <small class="text-danger fw-bold">Unpaid</small>
    <?php endif; ?>
</td>

<td class="status-service text-center" data-id="<?php echo e($service->id); ?>" data-status="<?php echo e($service->status); ?>">
  <?php
      $statusClass = [
          1 => 'badge-info',
          2 => 'badge-warning',
          3 => 'badge-success',
          4 => 'badge-success',
          5 => 'badge-danger',
      ];
      $statusLabel = [
          1 => 'Accepted',
          2 => 'Process',
          3 => 'Done',
          4 => 'Taken',
          5 => 'Canceled',
      ];
  ?>

  <span class="badge <?php echo e($statusClass[$service->status] ?? 'badge-secondary'); ?> badge-status" style="cursor:pointer;">
    <?php echo e($statusLabel[$service->status] ?? 'Unknown'); ?>

  </span>
</td>


              <td>
                <div class="d-flex justify-content-center gap-2">
                  <a href="services/<?php echo e($service->id); ?>" class="btn btn-detail btn-sm">Detail</a>
                  <?php
  $isPaymentDisabled = ($service->status_paid == 0 || $service->status != 3);
?>
<a href="/Services/<?php echo e($service->id); ?>/payment"
   class="btn btn-payment btn-sm <?php echo e($isPaymentDisabled ? 'disabled' : ''); ?>"
   <?php echo e($isPaymentDisabled ? 'disabled' : ''); ?>>
   Payment
</a>
<form action="/services/<?php echo e($service->id); ?>/delete" method="POST" style="display:inline;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-delete btn-sm" onclick="return confirm('Yakin hapus user ini?');">Delete</button>
          </form>

                </div>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const nextStatus = {
    1: 2, // Accepted → Process
    2: 3, // Process → Done
    3: 4, // Done → Taken
    4: 5, // Taken → Canceled
    5: 1  // Canceled → back to Accepted (loop)
  };

  const statusLabel = {
    1: 'Accepted',
    2: 'Process',
    3: 'Done',
    4: 'Taken',
    5: 'Canceled'
  };

  const statusColor = {
    1: 'badge-info',
    2: 'badge-warning',
    3: 'badge-success',
    4: 'badge-success',
    5: 'badge-danger'
  };

  document.querySelectorAll('.badge-status').forEach(badge => {
    badge.addEventListener('click', function() {
      const td = this.closest('.status-service');
      const id = td.dataset.id;
      const currentStatus = parseInt(td.dataset.status);
      const newStatus = nextStatus[currentStatus];

      // Optional: konfirmasi
      if (!confirm(`Ubah status menjadi "${statusLabel[newStatus]}"?`)) return;

     fetch(`/services/${id}/status`, {
  method: 'PATCH',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
  },
  body: JSON.stringify({ status: newStatus })
})

      .then(res => res.json())
      .then(data => {
        if (data.success) {
          td.dataset.status = newStatus;

          // Update tampilan badge
          this.className = `badge ${statusColor[newStatus]} badge-status`;
          this.textContent = statusLabel[newStatus];

          // Update tombol payment otomatis
          const paymentBtn = td.closest('tr').querySelector('.btn-payment');
          if (newStatus != 3) {
            paymentBtn.classList.add('disabled');
            paymentBtn.setAttribute('disabled', true);
          } else {
            paymentBtn.classList.remove('disabled');
            paymentBtn.removeAttribute('disabled');
          }

          Toastify({
            text: `Status updated to "${statusLabel[newStatus]}"`,
            duration: 2500,
            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)"
          }).showToast();
        }
      })
      .catch(err => {
        console.error(err);
        Toastify({
          text: "Gagal memperbarui status",
          duration: 2500,
          backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)"
        }).showToast();
      });
    });
  });
});
</script>
<script>
<?php if(session('success')): ?>
Swal.fire({
  icon: 'success',
  title: 'Berhasil!',
  text: '<?php echo e(session('success')); ?>',
  timer: 2000,
  showConfirmButton: false
});
<?php endif; ?>

<?php if(session('error')): ?>
Swal.fire({
  icon: 'error',
  title: 'Terjadi Kesalahan!',
  text: '<?php echo e(session('error')); ?>'
});
<?php endif; ?>
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rendr\Desktop\desktop\service_hp_aseli\resources\views\pages\Service\index.blade.php ENDPATH**/ ?>