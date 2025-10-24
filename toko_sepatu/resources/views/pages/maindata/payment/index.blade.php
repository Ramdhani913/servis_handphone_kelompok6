@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #0f111a !important;
        font-family: 'Poppins', sans-serif;
    }

    .content-wrapper {
        padding: 40px;
        color: #fff;
    }

    .card-section {
        background-color: #1c1f2a;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 35px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    .section-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 25px;
    }

    .calculation-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
    }

    .calc-item {
        display: flex;
        flex-direction: column;
    }

    .calc-label {
        color: #aaa;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .calc-value {
        font-size: 15px;
        font-weight: 500;
        color: #fff;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        color: #aaa;
        font-size: 13px;
        margin-bottom: 6px;
        display: block;
    }

    .dark-input, .dark-select {
        width: 100%;
        height: 45px;
        background-color: #2a2e3d;
        border: none;
        border-radius: 5px;
        color: #fff;
        padding: 10px 15px;
        font-size: 14px;
    }

    .dark-input::placeholder {
        color: #888;
    }

    .remaining-text {
        margin-top: 10px;
        color: #aaa;
        font-size: 13px;
    }

    .remaining-text strong {
        color: #fff;
        font-weight: 600;
    }

    .btn-area {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
    }

    .btn-prev {
        background-color: #2a2e3d;
        border: none;
        color: #fff;
        border-radius: 5px;
        width: 100px;
        height: 38px;
        transition: 0.3s;
    }

    .btn-prev:hover {
        background-color: #383c4e;
    }

    .btn-next {
        background-color: #007bff;
        border: none;
        color: #fff;
        border-radius: 5px;
        width: 100px;
        height: 38px;
        transition: 0.3s;
    }

    .btn-next:hover {
        background-color: #0069d9;
    }

</style>

<div class="content-wrapper">

    {{-- Kotak 1: Total Calculation --}}
    <div class="card-section">
        <h4 class="section-title">Total Calculation</h4>
        <div class="calculation-grid">
            <div class="calc-item">
                <p class="calc-label">Total Items</p>
                <p class="calc-value">2 items</p>
            </div>
            <div class="calc-item">
                <p class="calc-label">Total Price</p>
                <p class="calc-value">Rp. 28.887</p>
            </div>
            <div class="calc-item">
                <p class="calc-label">Total Paid</p>
                <p class="calc-value">Rp. 0</p>
            </div>
            <div class="calc-item">
                <p class="calc-label">Total Change</p>
                <p class="calc-value">Rp. 0</p>
            </div>
        </div>
    </div>

    {{-- Kotak 2: Payment Method --}}
    <div class="card-section">
        <h4 class="section-title">Payment Method</h4>

        <div class="form-group">
            <label class="form-label">Select Payment Method</label>
            <select class="dark-select">
                <option value="" disabled selected>Select Method</option>
                <option value="cash">Cash</option>
                <option value="transfer">Bank Transfer</option>
                <option value="ewallet">E-Wallet</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Paid</label>
            <input type="text" class="dark-input" placeholder="Ex: 19000">
        </div>

        <p class="remaining-text">
            Remaining payment: <strong>Rp. 28.886</strong>
        </p>

        <div class="btn-area">
            <button class="btn-prev">Previous</button>
            <button class="btn-next">Next</button>
        </div>
    </div>

</div>
@endsection
