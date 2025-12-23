@extends('layouts.dashboard')

@section('title', 'Pembayaran Pendirian CV')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <div class="text-center mb-6">
        <i class="fas fa-check-circle text-green-500 text-6xl mb-4"></i>
        <h2 class="text-2xl font-bold text-gray-800">Terima Kasih, Pengajuan Anda Diterima!</h2>
        <p class="text-gray-600 mt-2">Pengajuan pendirian CV untuk <strong>{{ $pendirianCv->nama_perusahaan }}</strong>
            telah kami terima.</p>
    </div>

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
        <h3 class="font-semibold text-blue-800 mb-2">Detail Pengajuan:</h3>
        <p><strong>ID Pengajuan:</strong> {{ $pendirianCv->id }}</p>
        <p><strong>Bank Rekanan:</strong> {{ $pendirianCv->selected_bank }}</p>
        <p><strong>Status:</strong> <span
                class="text-yellow-600 font-semibold">{{ ucfirst(str_replace('_', ' ', $pendirianCv->status)) }}</span>
        </p>
    </div>

    <hr>

    <form action="{{ route('pendirian.cv.pembayaran.upload', ['id' => $pendirianCv->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-4">Langkah Terakhir: Upload Bukti Pembayaran</h3>
        <div class="mb-4">
            <label for="payment_proof" class="block text-gray-700 text-sm font-bold mb-2">Bukti Pembayaran</label>
            <input type="file" name="payment_proof" id="payment_proof" class="form-input" required
                accept="image/*,.pdf">
            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, PDF (Maks. 5MB)</p>
        </div>
        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Upload Bukti Pembayaran
        </button>
    </form>
</div>
@endsection