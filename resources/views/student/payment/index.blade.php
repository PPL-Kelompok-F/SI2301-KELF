@extends('layouts.student.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="mb-8">

        <h1 class="text-3xl font-bold">
            Pembayaran
        </h1>

        <p class="text-gray-500 mt-2">
            Scan QRIS lalu upload bukti pembayaran.
        </p>

    </div>

    @if(session('success'))

        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-6">
            {{ session('success') }}
        </div>

    @endif

    <div class="grid md:grid-cols-2 gap-8">

        <!-- QR -->
        <div class="bg-white rounded-3xl shadow-sm p-8">

            <h2 class="text-xl font-bold mb-6 text-center">
                Scan QRIS
            </h2>

            <img
                src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=PAYMENT{{ rand(100000,999999) }}"
                class="mx-auto rounded-2xl border">

            <p class="text-center text-sm text-gray-500 mt-4">
                Gunakan aplikasi e-wallet atau mobile banking untuk melakukan pembayaran.
            </p>

        </div>

        <!-- FORM -->
        <div class="bg-white rounded-3xl shadow-sm p-8">

            <form
                action="{{ route('student.payment.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="mb-5">

                    <label class="block text-sm font-medium mb-2">
                        Nominal Pembayaran
                    </label>

                    <input
                        type="number"
                        name="nominal"
                        min="1000"
                        required
                        class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                </div>

                <div class="mb-6">

                    <label class="block text-sm font-medium mb-2">
                        Bukti Pembayaran
                    </label>

                    <input
                        type="file"
                        name="bukti_pembayaran"
                        accept=".jpg,.jpeg,.png"
                        required
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                <button
                    type="submit"
                    class="w-full bg-black text-white py-3 rounded-xl hover:bg-gray-800 transition">

                    Kirim Bukti Pembayaran

                </button>

            </form>

        </div>

    </div>

</div>

@endsection