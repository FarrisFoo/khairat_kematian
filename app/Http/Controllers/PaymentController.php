<?php

namespace App\Http\Controllers;

use App\Models\Dana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function showPaymentMethods()
    {
        return view('payment-methods');
    }

public function storePayment(Request $request)
{
    $request->validate([
        'jumlah' => 'required|numeric|min:0',
        'kaedah_bayaran' => 'required|in:QR,FPX,Debit',
        'nama_ahli' => 'required|string|max:255',
        'resit' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Store receipt image
    $resitPath = $request->file('resit')->store('resit_pembayaran');

    // Create payment record
    Dana::create([
        'jumlah' => $request->jumlah,
        'kaedah_bayaran' => $request->kaedah_bayaran,
        'nama_ahli' => $request->nama_ahli,
        'resit_path' => $resitPath,
        'status' => "pending"
    ]);

    return redirect()->route('payment-methods')
        ->with('success', 'Pembayaran berjaya dihantar. Sila tunggu pengesahan.');
}
}
