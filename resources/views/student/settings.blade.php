@extends('layouts.student.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <!-- Settings Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold">
            Pengaturan
        </h1>
        <p class="text-gray-500 mt-2">
            Kelola preferensi dan pembayaran Anda.
        </p>
    </div>

    <!-- Settings Tabs -->
    <div class="mb-8">
        <div class="flex gap-4 border-b border-gray-200">
            <button class="tab-btn px-4 py-3 font-medium border-b-2 border-blue-500 text-blue-600" data-tab="general">
                Umum
            </button>
            <button class="tab-btn px-4 py-3 font-medium border-b-2 border-transparent text-gray-600 hover:text-gray-800" data-tab="payment">
                Pembayaran
            </button>
        </div>
    </div>

    <!-- General Settings Tab -->
    <div id="general" class="tab-content">
        <div class="bg-white rounded-3xl shadow-sm p-8">
            <h2 class="text-xl font-bold mb-6">
                Preferensi Umum
            </h2>

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Notifikasi Email
                    </label>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="email-notif" checked class="rounded">
                        <label for="email-notif" class="text-sm text-gray-600">
                            Terima notifikasi untuk kuis dan tugas baru
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Tema
                    </label>
                    <select class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option>Gelap</option>
                        <option selected>Terang</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Bahasa
                    </label>
                    <select class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option selected>Bahasa Indonesia</option>
                        <option>English</option>
                    </select>
                </div>

                <button class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition">
                    Simpan Pengaturan
                </button>
            </div>
        </div>
    </div>

    <!-- Payment Tab -->
    <div id="payment" class="tab-content hidden">
        <div class="bg-white rounded-3xl shadow-sm p-8">
            <h2 class="text-xl font-bold mb-2">
                Pembayaran
            </h2>
            <p class="text-gray-500 mb-6">
                Scan QRIS lalu upload bukti pembayaran.
            </p>

            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid md:grid-cols-2 gap-8">

                <!-- QR -->
                <div class="bg-gray-50 rounded-3xl p-8">

                    <h3 class="text-lg font-bold mb-6 text-center">
                        Scan QRIS
                    </h3>

                    <img
                        src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=PAYMENT{{ rand(100000,999999) }}"
                        class="mx-auto rounded-2xl border">

                    <p class="text-center text-sm text-gray-500 mt-4">
                        Gunakan aplikasi e-wallet atau mobile banking untuk melakukan pembayaran.
                    </p>

                </div>

                <!-- FORM -->
                <div>

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
    </div>

</div>

<script>
    // Tab switching functionality
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const tabName = this.dataset.tab;
            
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });
            
            // Remove active state from all buttons
            document.querySelectorAll('.tab-btn').forEach(button => {
                button.classList.remove('border-b-2', 'border-blue-500', 'text-blue-600');
                button.classList.add('border-b-2', 'border-transparent', 'text-gray-600');
            });
            
            // Show selected tab
            document.getElementById(tabName).classList.remove('hidden');
            
            // Add active state to clicked button
            this.classList.remove('border-b-2', 'border-transparent', 'text-gray-600');
            this.classList.add('border-b-2', 'border-blue-500', 'text-blue-600');
        });
    });
</script>

@endsection
