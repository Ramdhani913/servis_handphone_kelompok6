@extends('layouts.app')

@section('content')
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

  .table-footer {
    color: #9a9cab;
    font-size: 13px;
  }

  .dataTables_paginate {
    display: flex;
    justify-content: flex-end;
    align-items: center;
  }

  .paginate_button {
    color: #fff !important;
    background-color: #1e1e2d !important;
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 6px;
    padding: 5px 10px;
    margin-left: 5px;
  }

  .paginate_button.current {
    background-color: #007bff !important;
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
    padding: 20px;
  }
</style>

<div class="content-wrapper">
  <div class="card p-4 mb-4">
    <div class="card-header">
      <h4 class="section-title mb-0">Detail Sales</h4>
    </div>
    <div class="card-body">
      <div class="info-item"><span class="info-label">Invoice</span><span class="info-value">INV-123</span></div>
      <div class="info-item"><span class="info-label">Technician</span><span class="info-value">Bayu</span></div>
      <div class="info-item"><span class="info-label">Date</span><span class="info-value">2024-10-06</span></div>
      <div class="info-item"><span class="info-label">Handphone</span><span class="info-value">Samsung s23 ultra</span></div>
    </div>
  </div>

  <div class="card p-4">
    <div class="card-header">
      <h4 class="section-title mb-0">Servis Item</h4>
    </div>
    <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Service Item</th>
            <th>Price</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Ganti LCD</td>
            <td>Rp 1.200.000</td>
            <td>Rp 1.200.000</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Ganti Baterai</td>
            <td>Rp 150.000</td>
            <td>Rp 150.000</td>
          </tr>
        </tbody>
      </table>
      <div class="d-flex justify-content-between mt-3">
        <div class="table-footer">Showing 1 to 2 of 2 entries (filtered from 10 total entries)</div>
        <div class="dataTables_paginate">
          <span class="paginate_button previous disabled">Previous</span>
          <span class="paginate_button current">1</span>
          <span class="paginate_button next disabled">Next</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
