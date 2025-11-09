@extends('layouts.app')

@section('content')
<style>
  body { background-color: #12121c; }
  .content-wrapper { padding-top: 90px !important; }
  .card { background-color: #1e1e2d !important; border: none; border-radius: 12px; color: #fff; box-shadow: 0 0 15px rgba(0,0,0,0.2); }
  .btn-tambah { background-color: #6c63ff; color: #fff; font-weight: 600; border-radius: 8px; padding: 10px 25px; box-shadow: 0 0 10px rgba(108,99,255,0.5); }
  .btn-tambah:hover { background-color: #5a52e0; }
  .table tbody tr { background-color: #26263b !important; transition: background 0.2s ease; }
  .table-hover tbody tr:hover { background-color: #343453 !important; }
  input#search { background-color: #26263b; border: 1px solid #444; color: #fff; border-radius: 8px; padding: 8px 12px; width: 250px; }
  .spinner { display: none; color: #6c63ff; }
  .btn-edit { background-color: #f5b400; color: #1e1e2d; font-weight: 600; border: none; }
  .btn-delete { background-color: #e74c3c; color: #fff; font-weight: 600; border: none; }
  .btn-detail { background-color: #2ecc71; color: #fff; font-weight: 600; border: none; }
  .text-success { color: #2ecc71 !important; }
  .text-danger { color: #e74c3c !important; }
</style>

<div class="container-fluid grid-margin stretch-card content-wrapper">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h4 class="card-title mb-0 text-white">Table Service Item</h4>
        <a href="{{ route('serviceitems.create') }}" class="btn btn-tambah mt-2 mt-md-0">
          <i class="mdi mdi-plus-circle-outline me-1"></i> Tambah Service Item
        </a>
      </div>

      <div class="d-flex align-items-center mb-4">
        <input type="text" id="search" placeholder="Cari nama service..." />
        <span class="spinner ms-2"><i class="mdi mdi-loading mdi-spin"></i></span>
      </div>

      <div id="serviceTable">
        @include('pages.maindata.serviceitem.table', ['serviceitems' => $serviceitems])
      </div>
    </div>
  </div>
</div>

<!-- SweetAlert dan jQuery -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$.ajaxSetup({
  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

$(document).ready(function() {
  let timer = null;

  function fetchServiceItems(page = 1) {
    let search = $('#search').val();
    $('.spinner').show();

    $.ajax({
      url: "{{ route('serviceitems.index') }}",
      type: "GET",
      data: { search: search, page: page },
      success: function(data) {
        $('#serviceTable').html($(data).find('#serviceTable').html());
        $('.spinner').hide();
      },
      error: function() {
        $('.spinner').hide();
        Swal.fire('Error', 'Gagal memuat data.', 'error');
      }
    });
  }

  $('#search').on('keyup', function() {
    clearTimeout(timer);
    timer = setTimeout(fetchServiceItems, 300);
  });

  $(document).on('click', '.pagination a', function(e) {
    e.preventDefault();
    let page = $(this).attr('href').split('page=')[1];
    fetchServiceItems(page);
  });

  $(document).on('click', '.status-toggle', function() {
    let id = $(this).data('id');
    let span = $(this);

    $.ajax({
      url: "{{ route('serviceitems.toggle', ':id') }}".replace(':id', id),
      type: 'POST',
      success: function(res) {
        span.text(res.is_active);
        span.removeClass('text-success text-danger')
            .addClass(res.is_active === 'active' ? 'text-success' : 'text-danger');
        Swal.fire('Berhasil', 'Status berhasil diubah', 'success');
      },
      error: function() {
        Swal.fire('Error', 'Gagal mengubah status', 'error');
      }
    });
  });

  $(document).on('click', '.delete-btn', function(e) {
    e.preventDefault();
    let id = $(this).data('id');

    Swal.fire({
      title: 'Yakin hapus item ini?',
      text: 'Data akan hilang permanen',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#e74c3c',
      cancelButtonColor: '#6c63ff',
      confirmButtonText: 'Ya, hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "{{ url('serviceitems') }}/" + id,
          type: 'DELETE',
          success: function() {
            fetchServiceItems();
            Swal.fire('Dihapus!', 'Service item telah dihapus.', 'success');
          },
          error: function() {
            Swal.fire('Error', 'Gagal menghapus item.', 'error');
          }
        });
      }
    });
  });
});
</script>
@endsection
