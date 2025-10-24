<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Handphone;
use App\Models\Service;
use App\Models\Serviceitem;
use Illuminate\Http\Request;
use App\Models\Servicedetail;
use Illuminate\Support\Facades\DB;

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
        $request->validate([
            'status' => 'required|integer|min:1|max:5'
        ]);

        $service = Service::findOrFail($id);
        $service->status = $request->status;

        // contoh logic tambahan
        if ($request->status == 3 && !$service->completed_date) {
            $service->completed_date = now();
        } elseif ($request->status != 3) {
            $service->completed_date = null;
        }

        $service->save();

        return response()->json([
            'success' => true,
            'status' => $service->status,
        ]);
    }
}





