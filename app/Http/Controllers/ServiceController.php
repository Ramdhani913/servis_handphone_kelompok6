<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\User;
use App\Models\Handphone;
use App\Models\Service;
use App\Models\Serviceitem;
use Illuminate\Http\Request;
use App\Models\Servicedetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    // index view
    public function index() {
        $services = Service::all();
        return view('pages.service.index', compact('services'));
    }

    // create view
    public function create(){
        $customers    = User::where('role', '=', 'technician')->get();
        $technicians  = User::where('role', '=', 'customer')->get();
        $handphones   = Handphone::all();
        $serviceItems = Serviceitem::all();

        return view('pages.service.create', compact('customers', 'technicians', 'handphones', 'serviceItems'));
    }

    // store process
  public function store(Request $request)
{
    DB::beginTransaction();
    try {
        $request->validate([
            'customer'          => 'required', 
            'handphone'         => 'required', 
            'technician'        => 'required', 
            'damagedescription' => 'required',
            'service_type'      => 'required|array|min:1'
        ]);

        // Buat service utama dulu
        $service = Service::create([
            'no_invoice'         => 'INV-' . rand(1000, 9999),
            'customer_id'        => $request->customer,
            'technician_id'      => $request->technician,
            'handphone_id'       => $request->handphone,
            'damage_description' => $request->damagedescription,
            'estimated_cost'     => 0,
            'total_cost'         => 0,
            'status_paid'        => 2, // ✅ default unpaid
            'received_date'      => now(), // ✅ otomatis isi tanggal & waktu real-time
        ]);

        $estimatedCost = 0;

        // Loop tiap service type yang dipilih user
        foreach ($request->service_type as $serviceTypeId) {
            $serviceItem = Serviceitem::find($serviceTypeId);

            if (!$serviceItem) continue;

            // Simpan detail
            Servicedetail::create([
                'service_id'     => $service->id,
                'serviceitem_id' => $serviceItem->id,
                'price'          => $serviceItem->price,
            ]);

            $estimatedCost += $serviceItem->price;
        }

        if (count($request->service_type) == 1) {
            $serviceItem = Serviceitem::find($request->service_type[0]);
            $estimatedCost = $serviceItem ? $serviceItem->price : 0;
        }

        $service->update([
            'estimated_cost' => $estimatedCost,
            'total_cost'     => $estimatedCost,
        ]);

        DB::commit();

        return redirect()->route('services.index')->with('success', 'Service created successfully!');
    } catch (\Throwable $th) {
        DB::rollBack();
        return redirect()->back()->with('error', $th->getMessage());
    }
}



    // edit view
    public function edit($id){
        //
    }

    // update process
    public function update(Request $request, $id){
        //
    }

    public function detail($id)
{
    // Ambil data service utama (misal untuk menampilkan info invoice, nama customer, dll)
    $service = Service::findOrFail($id);

    // Ambil semua data detail berdasarkan service_id
    $serviceDetails = ServiceDetail::where('service_id', $id)->get();

    // Kirim ke view
    return view('pages.service.detail', compact('service', 'serviceDetails'));
}



   public function updateStatus(Request $request, $id)
{
    try {
        $service = Service::findOrFail($id);
        $service->status = $request->status;
        $service->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'status'  => $service->status
        ]);
    } catch (\Throwable $th) {
        return response()->json([
            'success' => false,
            'message' => $th->getMessage()
        ], 500);
    }
}

public function updateCost(Request $request, $id)
{
    $service = Service::findOrFail($id);

    $other = floatval($request->other_cost ?? 0);
    $estimated = floatval($service->estimated_cost ?? 0);
    $paid = floatval($service->paid ?? 0);

    // Hitung total cost baru
    $total = $estimated + $other;

    // Default values
    $statusPaid = 2; // Unpaid
    $change = 0;

    // Tentukan status_paid dan change
    if ($paid >= $total) {
        $statusPaid = 0; // Paid
        $change = $paid - $total;
    } elseif ($paid > 0 && $paid < $total) {
        $statusPaid = 1; // Debt
        $change = 0;
    } else {
        $statusPaid = 2; // Unpaid
        $change = 0;
    }

    // Update data di database
    $service->update([
        'other_cost'  => $other,
        'total_cost'  => $total,
        'status_paid' => $statusPaid,
        'change'      => $change,
    ]);

    // Kembalikan hasil via JSON agar bisa dipakai di tampilan
    return response()->json([
        'success'     => true,
        'total_cost'  => number_format($total, 0, ',', '.'),
        'status_paid' => $statusPaid,
        'change'      => number_format($change, 0, ',', '.'),
    ]);
}



public function payment($id){
$service = Service::findOrFail($id);
return view('pages.Service.payment.index', compact('service'));
}


public function processPayment(Request $request, $id)
{
    $service = \App\Models\Service::findOrFail($id);

    $newPayment = floatval($request->paid ?? 0);
    $method = intval($request->payment_method ?? $service->payment_method);

    // Tambahkan ke total pembayaran yang sudah ada
    $totalPaid = floatval($service->paid ?? 0) + $newPayment;
    $totalCost = floatval($service->total_cost ?? 0);

    $change = 0;
    $statusPaid = 2; // Default: unpaid
    $remaining = max(0, $totalCost - $totalPaid);

    if ($totalPaid >= $totalCost) {
        $change = $totalPaid - $totalCost;
        $statusPaid = 0; // paid
    } elseif ($totalPaid > 0 && $totalPaid < $totalCost) {
        $statusPaid = 1; // debt
    }

    // Simpan ke database (langsung update tanpa ajax lagi)
    $service->update([
        'payment_method' => $method,
        'paid'           => $totalPaid,
        'change'         => $change,
        'status_paid'    => $statusPaid,
    ]);

    if ($totalPaid >= $totalCost) {
    $change = $totalPaid - $totalCost;
    $statusPaid = 0; // Paid
} elseif ($totalPaid < $totalCost && $totalPaid > 0) {
    $change = 0; // ✅ tambahkan baris ini agar debt tidak ada kembalian
    $statusPaid = 1; // Debt
} else {
    $change = 0;
    $statusPaid = 2; // Unpaid
}


    return redirect('/services')->with('success', 'Payment processed successfully.');
}


public function destroy($id)
    {
        try {
        $service = Service::findOrFail($id);
        $service->delete(); 

        return redirect()->route('services.index')->with('success', '🗑️ Service berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus service: '.$e->getMessage());
            return redirect()->back()->with('error', '❌ Gagal menghapus service.');
        }
        
    

}





}
=======
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //
}
>>>>>>> 0cdab11c69774ac7f57a244149b56b3da6621235
