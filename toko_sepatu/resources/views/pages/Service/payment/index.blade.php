@extends('layouts.app')
@section('content')

<div class="container mt-4" style="max-width:900px;">
    {{-- === Card 1: Summary === --}}
    <div class="card shadow p-4 mb-4" style="background-color:#1e1e2d; color:#fff; border:none;">
        <h4 class="mb-3">💰 Payment Summary</h4>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Estimated Cost:</strong> Rp {{ number_format($service->estimated_cost, 0, ',', '.') }}</p>
                <p><strong>Other Cost:</strong>
                    <span id="other-cost" contenteditable="true"
                        style="display:inline-block; padding:4px 8px; background:#2c2c3e; border-radius:6px;">
                        {{ number_format($service->other_cost ?? 0, 0, ',', '.') }}
                    </span>
                </p>
                <p><strong>Total Cost:</strong>
                    <span id="total-cost">Rp {{ number_format($service->total_cost, 0, ',', '.') }}</span>
                </p>
            </div>
            <div class="col-md-6">
                <p><strong>Paid:</strong> 
                    <span id="paid-display">Rp {{ number_format($service->paid ?? 0, 0, ',', '.') }}</span>
                </p>
                <p><strong>Change:</strong> 
                    <span id="change-display">Rp {{ number_format($service->change ?? 0, 0, ',', '.') }}</span>
                </p>
                @php
                    $remaining = max(0, $service->total_cost - $service->paid);
                @endphp
                <p><strong>Remaining:</strong>
                    <span id="remaining-display" style="color:#00ffcc;">Rp {{ number_format($remaining, 0, ',', '.') }}</span>
                </p>

                {{-- Status Paid Display --}}
                <p><strong>Status:</strong>
                    <span id="status-display">
                        @if ($service->status_paid == 0)
                            ✅ Paid
                        @elseif ($service->status_paid == 1)
                            ⚠️ Debt
                        @else
                            ❌ Unpaid
                        @endif
                    </span>
                </p>
            </div>
        </div>
    </div>

    {{-- === Card 2: Payment Form === --}}
    <div class="card shadow p-4" style="background-color:#1e1e2d; color:#fff; border:none;">
        <h4 class="mb-3">💳 Make a Payment</h4>

        <form action="{{ url('/services/pay/' . $service->id) }}" method="POST">
            @csrf

            {{-- Payment Method --}}
            <div class="mb-3">
                <label class="form-label">Payment Method</label>
                <select name="payment_method" class="form-select" style="background:#2c2c3e; color:#fff; border:none;">
                    <option value="1" {{ $service->payment_method == 1 ? 'selected' : '' }}>Cash</option>
                    <option value="2" {{ $service->payment_method == 2 ? 'selected' : '' }}>Transfer</option>
                </select>
            </div>

            {{-- Payment Amount --}}
            <div class="mb-3">
                <label class="form-label">Add Payment</label>
                <input type="number" name="paid" class="form-control"
                       placeholder="Enter payment amount"
                       style="background:#2c2c3e; color:#fff; border:none;">
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success px-4 py-2">
                    <i class="mdi mdi-cash"></i> Submit Payment
                </button>
            </div>
        </form>
    </div>
</div>

{{-- === AJAX untuk update Other Cost === --}}
<script>
document.getElementById('other-cost').addEventListener('blur', function() {
    const id = "{{ $service->id }}";
    const other = this.innerText.replace(/\D/g, '');

    fetch(`/services/update-cost/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ other_cost: other })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // Update total cost
            document.getElementById('total-cost').innerText = 'Rp ' + data.total_cost;
            document.getElementById('change-display').innerText = 'Rp ' + data.change;

            // Hitung ulang remaining
            const paid = parseInt(document.getElementById('paid-display').innerText.replace(/\D/g, '')) || 0;
            const total = parseInt(data.total_cost.replace(/\D/g, '')) || 0;
            const remaining = Math.max(0, total - paid);
            document.getElementById('remaining-display').innerText = 'Rp ' + remaining.toLocaleString('id-ID');

            // Jika status debt, ubah change jadi 0
            if (data.status_paid == 1) {
                document.getElementById('change-display').innerText = 'Rp 0';
            }

            // Update status tampilan
            const statusEl = document.getElementById('status-display');
            if (data.status_paid == 0) {
                statusEl.innerText = '✅ Paid';
                statusEl.style.color = '#00ff99';
            } else if (data.status_paid == 1) {
                statusEl.innerText = '⚠️ Debt';
                statusEl.style.color = '#ffcc00';
            } else {
                statusEl.innerText = '❌ Unpaid';
                statusEl.style.color = '#ff6666';
            }

            // Toast kecil (notifikasi ringan)
            const msg = data.status_paid == 0 ? 'Payment complete (Paid)' :
                        data.status_paid == 1 ? 'Partial payment detected (Debt)' :
                        'Unpaid – please check';
            const toast = document.createElement('div');
            toast.textContent = msg;
            toast.style.position = 'fixed';
            toast.style.bottom = '20px';
            toast.style.right = '20px';
            toast.style.background = '#333';
            toast.style.color = '#fff';
            toast.style.padding = '10px 20px';
            toast.style.borderRadius = '8px';
            toast.style.zIndex = 1000;
            toast.style.opacity = 0.9;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 2500);
        }
    })
    .catch(err => console.error('Error updating cost:', err));
});
</script>

@endsection
