@extends('layouts.app')

@section('content')
    <style>
        /* ====== DETAIL SERVICE ITEM STYLE (FULL WIDTH DARK THEME) ====== */
        body {
            background-color: #181824;
        }

        .content-wrapper {
            padding: 50px 40px;
            min-height: 100vh;
        }

        .card-detail {
            background-color: #1e1e2d;
            border: none;
            border-radius: 16px;
            color: #ffffff;
            padding: 50px 60px;
            width: 100%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
            position: relative;
            margin-top: 40px;
        }

        .card-detail h4 {
            font-size: 22px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 35px;
            text-align: center;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px 40px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
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
            background-color: #2a2a3b;
            border-radius: 8px;
            padding: 10px 14px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 8px;
            font-weight: 600;
            text-transform: capitalize;
            width: fit-content;
        }

        .status-active {
            background-color: #1cc88a;
            color: #fff;
        }

        .status-inactive {
            background-color: #e74a3b;
            color: #fff;
        }

        .btn-back {
            position: absolute;
            top: 25px;
            left: 25px;
            background-color: #6c63ff;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 18px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
        }

        .btn-back:hover {
            background-color: #574fe4;
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .card-detail {
                padding: 30px 20px;
            }
        }
    </style>

    <div class="content-wrapper">
        <div class="card-detail">
            {{-- Tombol Back ke Index --}}
            <a href="{{ route('serviceitems.index') }}" class="btn-back">← Back</a>

            <h4>Detail Service Item</h4>

            <div class="info-grid">
                <div class="info-item">
                    <label>Nama Servis</label>
                    <span>{{ $serviceitem->service_name }}</span>
                </div>

                <div class="info-item">
                    <label>Harga</label>
                    <span>Rp {{ number_format($serviceitem->price, 0, ',', '.') }}</span>
                </div>

                <div class="info-item">
                    <label>Status</label>
                    <span
                        class="status-badge {{ $serviceitem->is_active === 'active' ? 'status-active' : 'status-inactive' }}">
                        {{ ucfirst($serviceitem->is_active) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
