<?php

namespace App\Http\Controllers;

use App\Models\Serviceitem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceitemController extends Controller
{
    public function create()
    {
        return view('pages.maindata.serviceitem.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
         $request->validate([
            'service_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);
        
        Serviceitem::create([
            'service_name' => $request->service_name,
            'price' => $request->price,
        ]);

        // Create a new service ite
        return redirect()->route('serviceitems.create')->with('success', 'Service item created successfully.');
    }

    public function index()
    {
        $serviceitems = Serviceitem::all();
        return view('pages.maindata.serviceitem.index', compact('serviceitems'));
    }       

    public function show($id)
    {
        $serviceitem = Serviceitem::findOrFail($id);
        return view('pages.maindata.serviceitem.detail', compact('serviceitem'));
    }

    public function edit($id)
    {
        $serviceitem = Serviceitem::findOrFail($id);
        return view('pages.maindata.serviceitem.edit', compact('serviceitem'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $serviceitem = Serviceitem::findOrFail($id);

        $serviceitem->update([
            'service_name' => $request->service_name,
            'price' => $request->price,
        ]);

        return redirect()->route('serviceitems.create')->with('success', 'Service item updated successfully.');
    }   
}
