@extends('layouts.app')

@section('content')
<style>
  /* ====== DETAIL SERVICE STYLE (SAMA SEPERTI FIGMA) ====== */
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
    <h4>Detail Service Item</h4>

    <div class="info-item">
      <label>Nama Service</label>
      <span>Ganti LCD</span>
    </div>

    <div class="info-item">
      <label>Price</label>
      <span>250.000</span>
    </div>

    <div class="info-item">
      <label>Status</label>
      <span>aktif</span>
    </div>

  </div>
</div>
@endsection
