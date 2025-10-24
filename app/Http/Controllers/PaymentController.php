<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
      public function index()
    {
        return view('pages.payment.index');

    }

    public function store(Request $request)
    {
        return redirect()->route('payment.index')->with('success', 'Payment saved');
    }

    public function show($id)
    {
        return view('pages.payment.show', compact('id'));
    }

    public function edit($id)
    {
        return view('pages.payment.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('payment.index');
    }

    public function destroy($id)
    {
        return redirect()->route('payment.index');
    }
}
