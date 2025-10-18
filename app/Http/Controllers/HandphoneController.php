<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Handphone;

class HandphoneController extends Controller
{
    public function index()
    {
        $handphones = Handphone::all();
        return view('pages.maindata.handphone.index', compact('handphones'));
    }

    public function create()
    {
        return view('pages.maindata.handphone.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'imei' => 'required|string|max:50|unique:handphones,imei',
            'status' => 'required|string|max:50',
        ]);

        Handphone::create($request->all());

        return redirect()->route('handphone.index')->with('success', 'Data handphone berhasil disimpan.');
    }

    public function show($id)
    {
        $handphone = Handphone::findOrFail($id);
        return view('pages.maindata.handphone.detail', compact('handphone'));
    }
}
