<?php $__env->startSection('content'); ?>
<style>
  body {
    background-color: #0d0d16 !important;
    color: #fff !important;
    font-family: 'Poppins', sans-serif;
  }

  .card {
    background-color: #1e1e2d !important;
    border: none;
    border-radius: 12px;
    color: #fff;
  }

  .card-header {
    border-bottom: 1px solid rgba(255,255,255,0.1);
    padding-bottom: 10px;
    margin-bottom: 20px;
  }

  .table {
    color: #fff;
    width: 100%;
    border-collapse: collapse;
  }

  .table thead {
    background-color: #1e1e2d;
    color: #9a9cab;
    border-bottom: 1px solid rgba(255,255,255,0.1);
  }

  .table tbody tr {
    border-bottom: 1px solid rgba(255,255,255,0.08);
  }

  .table td, .table th {
    padding: 12px 16px;
  }

  .table tbody tr:hover {
    background-color: #2b2b3b;
  }

  .section-title {
    font-size: 20px;
    font-weight: 600;
    color: #fff;
    margin-bottom: 16px;
  }

  .info-item {
    display: flex;
    justify-content: space-between;
    padding: 4px 0;
  }

  .info-label {
    color: #9a9cab;
  }

  .info-value {
    color: #fff;
  }

  .content-wrapper {
    padding: 100px 20px 20px; /* supaya tidak ketutup navbar */
  }

  .search-box {
    margin-bottom: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .search-box input {
    padding: 8px 12px;
    border-radius: 6px;
    border: 1px solid #555;
    background-color: #1e1e2d;
    color: #fff;
    width: 250px;
  }

  .pagination {
    display: flex;
    justify-content: center;
    margin-top: 15px;
    gap: 8px;
  }

  .pagination button {
    background-color: #1e1e2d;
    border: 1px solid #555;
    color: #fff;
    border-radius: 6px;
    padding: 6px 10px;
    cursor: pointer;
  }

  .pagination button.active {
    background-color: #435ebe;
    border-color: #435ebe;
  }

  .pagination button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }

  .table-footer {
    margin-top: 10px;
    text-align: right;
    color: #aaa;
    font-size: 14px;
  }

  .btn-back {
    background-color: #435ebe;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 8px 16px;
    text-decoration: none;
  }

  .btn-back:hover {
    background-color: #5269f5;
  }
</style>

<div class="content-wrapper">
  
  <div class="card p-4 mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="section-title mb-0">Detail Service</h4>
    </div>
    <div class="card-body">
      <div class="info-item"><span class="info-label">Invoice</span><span class="info-value"><?php echo e($service->no_invoice); ?></span></div>
      <div class="info-item"><span class="info-label">Customer</span><span class="info-value"><?php echo e($service->customer->name ?? '-'); ?></span></div>
      <div class="info-item"><span class="info-label">Technician</span><span class="info-value"><?php echo e($service->technician->name ?? '-'); ?></span></div>
      <div class="info-item"><span class="info-label">Received Date</span>
        <span class="info-value"><?php echo e($service->received_date ? $service->received_date->format('Y-m-d H:i') : '-'); ?></span>
      </div>
      <div class="info-item"><span class="info-label">Handphone</span>
        <span class="info-value"><?php echo e($service->handphones->brand ?? '-'); ?> <?php echo e($service->handphones->model ?? ''); ?></span>
      </div>
    </div>
  </div>

  
  <div class="card p-4">
    <div class="card-header">
      <h4 class="section-title mb-0">Service Detail</h4>
    </div>
    <div class="card-body">

      
      <div class="search-box">
        <input type="text" id="searchInput" placeholder="Cari service...">
      </div>

      <table class="table" id="serviceTable">
        <thead>
          <tr>
            <th>No</th>
            <th>Service Name</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $serviceDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td><?php echo e($index + 1); ?></td>
              <td><?php echo e($detail->serviceItem->service_name ?? '-'); ?></td>
              <td>Rp <?php echo e(number_format($detail->price, 0, ',', '.')); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
              <td colspan="3" class="text-center text-muted">Tidak ada data service detail.</td>
              
            </tr>
          <?php endif; ?>
        </tbody>
      </table>

      <div class="table-footer" id="tableInfo"></div>
      <div class="pagination" id="pagination"></div>
      <a href="<?php echo e(route('services.index')); ?>" class="btn-back">← Kembali</a>
    </div>
  </div>
</div>


<script>
  document.addEventListener("DOMContentLoaded", function() {
    const rows = Array.from(document.querySelectorAll("#serviceTable tbody tr"));
    const rowsPerPage = 5;
    const pagination = document.getElementById("pagination");
    const tableInfo = document.getElementById("tableInfo");
    const searchInput = document.getElementById("searchInput");
    let currentPage = 1;
    let filteredRows = rows;

    function renderTable() {
      const start = (currentPage - 1) * rowsPerPage;
      const end = start + rowsPerPage;
      rows.forEach(r => r.style.display = "none");
      filteredRows.slice(start, end).forEach(r => r.style.display = "");

      const total = filteredRows.length;
      const showingStart = total === 0 ? 0 : start + 1;
      const showingEnd = Math.min(end, total);
      tableInfo.textContent = `Menampilkan ${showingStart}–${showingEnd} dari ${total} entri`;

      renderPagination();
    }

    function renderPagination() {
      pagination.innerHTML = "";
      const totalPages = Math.ceil(filteredRows.length / rowsPerPage);

      if (totalPages <= 1) {
        pagination.style.display = "none";
        return;
      } else {
        pagination.style.display = "flex";
      }

      for (let i = 1; i <= totalPages; i++) {
        const btn = document.createElement("button");
        btn.textContent = i;
        btn.classList.toggle("active", i === currentPage);
        btn.addEventListener("click", () => {
          currentPage = i;
          renderTable();
        });
        pagination.appendChild(btn);
      }
    }

    searchInput.addEventListener("keyup", function() {
      const term = this.value.toLowerCase();
      filteredRows = rows.filter(r => r.textContent.toLowerCase().includes(term));
      currentPage = 1;
      renderTable();
    });

    renderTable();
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rendr\Desktop\desktop\service_hp_aseli\resources\views\pages\Service\detail.blade.php ENDPATH**/ ?>