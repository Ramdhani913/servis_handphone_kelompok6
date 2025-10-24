@extends('layouts.app')
@section('content')
<style>
  body {
    background-color: #12121c;
  }

  /* Tambah jarak dari navbar biar ga kehalang */
  .content-wrapper {
    padding-top: 90px !important; /* sesuaikan kalau navbar kamu tinggi */
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

  .btn-edit {
    background-color: #f5b400;
    color: #1e1e2d;
    font-weight: 600;
    border: none;
  }
  .btn-edit:hover { background-color: #d9a100; }

  .btn-delete {
    background-color: #e74c3c;
    color: #fff;
    font-weight: 600;
    border: none;
  }
  .btn-delete:hover { background-color: #c0392b; }

  .btn-detail {
    background-color: #2ecc71;
    color: #fff;
    font-weight: 600;
    border: none;
  }
  .btn-detail:hover { background-color: #27ae60; }

  td, th {
    vertical-align: middle !important;
  }

  .text-success { color: #2ecc71 !important; }
  .text-danger { color: #e74c3c !important; }
  .text-info { color: #3498db !important; }

</style>
{{-- Start Handphone --}}
<div class="container-fluid grid-margin stretch-card content-wrapper">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="card-title mb-0">Table Handphone</h4>
        <a href="{{ route('handphones.create') }}" class="btn btn-tambah">
          <i class="mdi mdi-plus-circle-outline me-1"></i> Tambah Handphone
        </a>
      </div>

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
            <tr>
              @foreach ( $handphones as $phone )
                 <td><img src="{{ asset('storage'. $phone->image) }}" class="rounded-circle" width="40" height="40" alt="image"></td>
              <td>{{ $phone->brand }}</td>
              <td><span class="text-danger fw-bold">{{ $phone->model }}</span></td>
              <td><span class="text-success fw-bold">{{ $phone->is_active }}/span></td>
              <td>
                <button class="btn btn-edit btn-sm">Edit</button>
                <button class="btn btn-delete btn-sm">Delete</button>
                <button class="btn btn-detail btn-sm">Detail</button>
              </td>
              @endforeach
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
{{-- End Handphone --}}