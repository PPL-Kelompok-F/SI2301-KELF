<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('student.payment.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nominal' => 'required|integer|min:1000',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('bukti_pembayaran');

        $filename = time().'_'.$file->getClientOriginalName();

        $file->move(
            public_path('uploads/payments'),
            $filename
        );

        $payment = new Payment();
        $payment->user_id = auth()->id();
        $payment->nominal = $request->nominal;
        $payment->bukti_pembayaran = 'uploads/payments/'.$filename;
        $payment->save();

        return redirect()
            ->back()
            ->with('success', 'Bukti pembayaran berhasil dikirim.');
    }
}