<?php

namespace App\Http\Controllers;

use App\Models\Serviceitem;
use Illuminate\Http\Request;

class ServiceitemController extends Controller
{
    // ✅ Tampilkan daftar service item dengan pagination dan pencarian
    public function index(Request $request)
    {
        $query = Serviceitem::query();

        if ($request->has('search') && $request->search !== '') {
            $query->where('service_name', 'like', '%' . $request->search . '%');
        }

        // Pagination Laravel standar
        $serviceitems = $query->orderBy('created_at', 'desc')->paginate(10);

        // Tidak perlu cek AJAX karena reload page
        return view('pages.maindata.serviceitem.index', compact('serviceitems'));
    }


    public function toggleStatus($id)
    {
        $item = Serviceitem::findOrFail($id);
        $item->is_active = $item->is_active === 'active' ? 'inactive' : 'active';
        $item->save();

        return response()->json([
            'is_active' => $item->is_active,
            'message' => 'Status berhasil diubah'
        ]);
    }

    public function destroy($id)
    {
        $item = Serviceitem::findOrFail($id);
        $item->delete();

        return redirect()->route('serviceitems.index')
            ->with('success', 'Service item berhasil dihapus.');
    }


    // ✅ Create
    public function create()
    {
        return view('pages.maindata.serviceitem.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price' => 'required|string', // tetap string dulu karena ada Rp.
        ]);

        // Hapus semua selain angka dari input price
        $price = preg_replace('/\D/', '', $request->price);

        // ✅ Cek duplikat sebelum insert
        $exists = Serviceitem::where('service_name', $request->service_name)->exists();
        if ($exists) {
            return redirect()->route('serviceitems.index')
                ->with('error', 'Nama service sudah ada! Gunakan nama lain.');
        }

        try {
            Serviceitem::create([
                'service_name' => $request->service_name,
                'price' => $price,
                'is_active' => 'active',
            ]);

            return redirect()->route('serviceitems.index')
                ->with('success', 'Service item berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->route('serviceitems.index')
                ->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }


    // ✅ Edit
    public function edit($id)
    {
        $serviceitem = Serviceitem::findOrFail($id);
        return view('pages.maindata.serviceitem.edit', compact('serviceitem'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price' => 'required|string',
        ]);

        $serviceitem = Serviceitem::findOrFail($id);

        // Hapus semua selain angka dari input price
        $price = preg_replace('/\D/', '', $request->price);

        // ✅ Cek duplikat nama (kecuali record saat ini)
        $exists = Serviceitem::where('service_name', $request->service_name)
            ->where('id', '!=', $id)
            ->exists();
        if ($exists) {
            return redirect()->route('serviceitems.index')
                ->with('error', 'Nama service sudah ada! Gunakan nama lain.');
        }

        try {
            $serviceitem->update([
                'service_name' => $request->service_name,
                'price' => $price,
            ]);

            return redirect()->route('serviceitems.index')
                ->with('success', 'Service item berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('serviceitems.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }


    public function show($id)
    {
        $serviceitem = \App\Models\Serviceitem::findOrFail($id);
        return view('pages.maindata.serviceitem.show', compact('serviceitem'));
    }
}
