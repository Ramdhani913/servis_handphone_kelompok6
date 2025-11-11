<?php

namespace App\Http\Controllers;

use App\Models\Handphone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HandphoneController extends Controller
{
    public function index(Request $request)
    {
        $query = Handphone::query();

        // 🔍 Search mirip ServiceItem
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('brand', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%");
            });
        }

        // 📄 Pagination
        $handphones = $query->paginate(10)->withQueryString();

        // 🔁 Jika AJAX (panggilan dari JS)
        if ($request->ajax()) {
            return view('pages.maindata.handphone.table', compact('handphones'))->render();
        }

        // 📄 Jika bukan AJAX (load awal)
        return view('pages.maindata.handphone.index', compact('handphones'));
    }



    public function create()
    {
        return view('pages.maindata.handphone.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'brand' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'release_year' => 'required|digits:4|integer|min:2000|max:' . (date('Y') + 1),
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // ✅ Cek duplikat
            $exists = Handphone::where('brand', $request->brand)
                ->where('model', $request->model)
                ->exists();

            if ($exists) {
                return redirect()->route('handphones.index')->with('error', 'Handphone dengan merk & model tersebut sudah ada.');
            }

            // ✅ Upload foto
            $path = $request->file('image')->store('handphone', 'public');

            Handphone::create([
                'brand' => $request->brand,
                'model' => $request->model,
                'release_year' => $request->release_year,
                'is_active' => 'active',
                'image' => $path,
            ]);

            return redirect()->route('handphones.index')->with('success', 'Handphone berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal membuat handphone: ' . $e->getMessage());
            return redirect()->route('handphones.index')->with('error', 'Handphone dengan model tersebut sudah ada.');
        }
    }

    public function edit($id)
    {
        $handphone = Handphone::findOrFail($id);
        return view('pages.maindata.handphone.edit', compact('handphone'));
    }

    public function update(Request $request, $id)
    {
        try {
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
                return redirect()->route('handphones.index')->with('error', 'Handphone dengan model tersebut sudah ada.');
            }

            // ✅ Upload gambar baru jika ada
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

            return redirect()->route('handphones.index')->with('success', 'Data handphone berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal mengupdate handphone: ' . $e->getMessage());
            return redirect()->route('handphones.index')->with('error', 'Gagal memperbarui data, Handphone dengan model tersebut sudah ada.');
        }
    }

    public function show($id)
    {
        $handphone = Handphone::findOrFail($id);
        return view('pages.maindata.handphone.detail', compact('handphone'));
    }

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
        try {
            $handphone = Handphone::findOrFail($id);

            if ($handphone->image && Storage::disk('public')->exists($handphone->image)) {
                Storage::disk('public')->delete($handphone->image);
            }

            $handphone->delete();

            return redirect()->route('handphones.index')->with('success', 'Model berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus model: ' . $e->getMessage());
            return redirect()->route('handphones.index')->with('error', 'Gagal menghapus model.');
        }
    }

    public function checkDuplicate(Request $request)
    {
        $query = Handphone::where('brand', $request->brand)
            ->where('model', $request->model);

        if ($request->id) {
            $query->where('id', '!=', $request->id);
        }

        return response()->json(['duplicate' => $query->exists()]);
    }
}
