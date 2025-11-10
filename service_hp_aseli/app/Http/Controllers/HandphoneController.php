<?php

namespace App\Http\Controllers;

use App\Models\Handphone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HandphoneController extends Controller
{

    public function create()
    {
        // Return the view to create a new handphone
        return view('pages.maindata.handphone.create');
    }

   public function store(Request $request)
{
    try {
        // ✅ Validasi input
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'release_year' => 'required|digits:4|integer|min:2000|max:' . (date('Y') + 1),
   
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // ✅ Anti duplikasi (brand + model)
        $exists = Handphone::where('brand', $request->brand)
            ->where('model', $request->model)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->with('error', '❌ Handphone dengan merk dan model tersebut sudah ada.');
        }

        // ✅ Upload gambar
        $path = $request->file('image')->store('handphone', 'public');

        // ✅ Simpan ke DB
        Handphone::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'release_year' => $request->release_year,
            'is_active' => 'active',
            'image' => $path,
        ]);

        return redirect()->route('handphones.index')->with('success', '✅ Handphone berhasil ditambahkan.');
    } catch (\Exception $e) {
        Log::error('Gagal membuat handphone: ' . $e->getMessage());
        return redirect()->back()->with('error', '❌ Terjadi kesalahan saat menambahkan data.');
    }
}


    public function edit ($id)
    {
        // Find the handphone by ID
        $handphone = Handphone::findOrFail($id);
        return view('pages.maindata.handphone.edit', compact('handphone'));

    }
public function update(Request $request, $id)
{
    try {
        // ✅ Validasi input
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'release_year' => 'nullable|digits:4|integer|min:2000|max:' . (date('Y') + 1),
            'is_active' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $handphone = Handphone::findOrFail($id);

        // ✅ Anti duplikasi saat edit
        $exists = Handphone::where('brand', $request->brand)
            ->where('model', $request->model)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->with('error', '❌ Handphone dengan merk dan model tersebut sudah ada.');
        }

        // ✅ Upload gambar baru (hapus lama)
        $path = $handphone->image;
        if ($request->hasFile('image')) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('image')->store('handphone', 'public');
        }

        // ✅ Update data
        $handphone->update([
            'brand' => $request->brand,
            'model' => $request->model,
            'release_year' => $request->release_year,
            'is_active' => $request->is_active,
            'image' => $path,
        ]);

        return redirect()->route('handphones.index')->with('success', '✅ Data handphone berhasil diperbarui.');
    } catch (\Exception $e) {
        Log::error('Gagal mengupdate handphone: ' . $e->getMessage());
        return redirect()->back()->with('error', '❌ Terjadi kesalahan saat memperbarui data.');
    }
}

    public function show($id)
    {
        $handphone = Handphone::findOrFail($id);
        return view('pages.maindata.handphone.detail', compact('handphone'));
    }   

    public function index(Request $request)
{
    $query = Handphone::query();

    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where('brand', 'like', "%{$search}%")
              ->orWhere('model', 'like', "%{$search}%");
    }

    $handphones = $query->orderBy('id', 'desc')->paginate(5);

    // Jika request AJAX, kirimkan partial view
    if ($request->ajax()) {
        return view('pages.maindata.handphone.index', compact('handphones'))->render();
    }

    return view('pages.maindata.handphone.index', compact('handphones'));
}

// ✅ AJAX toggle status
public function toggleStatus($id)
{
    $handphone = Handphone::findOrFail($id);
    $handphone->is_active = $handphone->is_active === 'active' ? 'inactive' : 'active';
    $handphone->save();

    return response()->json([
        'is_active' => $handphone->is_active,
        'message' => 'Status berhasil diubah'
    ]);
}


    public function destroy($id)
    {
        try{
        $handphone = Handphone::findOrFail($id);

        // Delete the image file if it exists
        if ($handphone->image && Storage::disk('public')->exists($handphone->image)) {
            Storage::disk('public')->delete($handphone->image);
        }

        // Delete the handphone record
        $handphone->delete();

        
       return redirect()->route('handphones.index')->with('success', '🗑️ model berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus model: '.$e->getMessage());
            return redirect()->back()->with('error', '❌ Gagal menghapus model.');
        }
    }

    

    public function checkDuplicate(Request $request)
{
    $brand = $request->brand;
    $model = $request->model;
    $id = $request->id; // untuk mode edit (agar tidak bentrok dengan dirinya sendiri)

    $query = \App\Models\Handphone::where('brand', $brand)
                ->where('model', $model);

    if ($id) {
        $query->where('id', '!=', $id);
    }

    $exists = $query->exists();

    return response()->json([
        'duplicate' => $exists
    ]);
}

}
