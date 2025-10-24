@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="text-center mb-4">💳 Halaman Pembayaran</h2>

        <form action="{{ route('payment.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pembayar</label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama">
            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah Pembayaran</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Masukkan jumlah">
            </div>

            <div class="mb-3">
                <label for="metode" class="form-label">Metode Pembayaran</label>
                <select name="metode" id="metode" class="form-select">
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer</option>
                    <option value="ewallet">E-Wallet</option>
                </select>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success me-2">Simpan</button>
                <a href="/" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
