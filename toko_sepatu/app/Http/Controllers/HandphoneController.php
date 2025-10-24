<?php

namespace App\Http\Controllers;

use App\Models\Handphone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class HandphoneController extends Controller
{

    public function create()
    {
        // Return the view to create a new handphone
        return view('pages.maindata.handphone.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'release_year' => 'required|digits:4|integer|min:2000|max:' . (date('Y') + 1),
            'is_active' => 'required|in:active,inactive',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload
        $path = $request->file('image')->store('handphone', 'public');
        


        // Create a new handphone record
        Handphone::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'release_year' => $request->release_year,
            'is_active' => $request->is_active,
            'image' => $path,
        ]);

        return redirect()->route('handphones.index')->with('success', 'Handphone created successfully.');
    }

    public function edit ($id)
    {
        // Find the handphone by ID
        $handphone = Handphone::findOrFail($id);
        return view('pages.maindata.handphone.edit', compact('handphone'));

    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'release_year' => 'nullable|digits:4|integer|min:2000|max:' . (date('Y') + 1),
            'is_active' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the handphone by ID
        $handphone = Handphone::findOrFail($id);

        // Handle file upload if a new image is provided
         if ($request->hasFile('image')) {
            if ($handphone->image && Storage::disk('public')->exists($handphone->image)) {
                Storage::disk('public')->delete($handphone->image);
            }
            $path = $request->file('image')->store('handphone', 'public');
            $handphone->image = $path;
        }


        // Update handphone details
       $handphone->update([
            'brand' => $request->brand,
            'model' => $request->model,
            'release_year' => $request->release_year,
            'is_active' => $request->is_active,
            'image' => $path,
        ]);

        return redirect()->route('handphones.index', $id)->with('success', 'Handphone updated successfully.');
    }

    public function show($id)
    {
        $handphone = Handphone::findOrFail($id);
        return view('pages.maindata.handphone.detail', compact('handphone'));
    }   

    public function index()
    {
        $handphones = Handphone::all();
        return view('pages.maindata.handphone.index', compact('handphones'));
    }

    public function destroy($id)
    {
        $handphone = Handphone::findOrFail($id);

        // Delete the image file if it exists
        if ($handphone->image && Storage::disk('public')->exists($handphone->image)) {
            Storage::disk('public')->delete($handphone->image);
        }

        // Delete the handphone record
        $handphone->delete();

        return redirect()->route('handphones.index')->with('success', 'Handphone deleted successfully.');
    }
}
