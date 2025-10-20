<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Handphone;

class HandphoneController extends Controller
{
    /**
     * Tampilkan daftar handphone.
     */
    public function index()
    {
        $handphones = Handphone::all();
        return view('pages.handphone.index', compact('handphones'));
    }

    /**
     * Form tambah data handphone.
     */
    public function create()
    {
        return view('pages.handphone.create');
    }

    /**
     * Simpan data baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        // Simpan gambar (jika ada)
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/handphone', 'public');
        }

        Handphone::create($data);

        return redirect()->route('handphone.index')->with('success', 'Data handphone berhasil ditambahkan.');
    }

    /**
     * Detail satu handphone.
     */
    public function show($id)
{
    $handphone = \App\Models\Handphone::findOrFail($id);
    return view('pages.handphone.detail', compact('handphone'));
}


    /**
     * Form edit handphone.
     */
    public function edit($id)
    {
        $handphone = Handphone::findOrFail($id);
        return view('pages.handphone.edit', compact('handphone'));
    }

    /**
     * Update data handphone.
     */
    public function update(Request $request, $id)
    {
        $handphone = Handphone::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('uploads/handphone', 'public');
        }

        $handphone->update($data);

        return redirect()->route('handphone.index')->with('success', 'Data handphone berhasil diperbarui.');
    }

    /**
     * Hapus data handphone.
     */
    public function destroy($id)
    {
        $handphone = Handphone::findOrFail($id);
        $handphone->delete();

        return redirect()->route('handphone.index')->with('success', 'Data handphone berhasil dihapus.');
    }
}
