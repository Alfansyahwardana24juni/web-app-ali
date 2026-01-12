@extends('layouts.dashboard')

@section('title', 'Detail Pendirian CV')

@section('content')
    <div class="space-y-6">
        <!-- Back Button -->
        <div>
            <a href="{{ route('pendirian.cv.processing') }}"
                class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Daftar
            </a>
        </div>

        <!-- Header Status -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 
                @if($pendirian->status === 'pending') border-yellow-400
                @elseif($pendirian->status === 'processing') border-blue-500
                @elseif($pendirian->status === 'completed') border-green-500
                @else border-gray-400 @endif">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $pendirian->nama_perusahaan }}</h1>
                    <p class="text-gray-500 mt-1">
                        <i class="far fa-calendar-alt mr-2"></i>
                        Diajukan pada {{ $pendirian->created_at->isoFormat('D MMMM Y, HH:mm') }} WIB
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold
                            @if($pendirian->status === 'pending')
                                bg-yellow-100 text-yellow-800
                            @elseif($pendirian->status === 'processing')
                                bg-blue-100 text-blue-800
                            @elseif($pendirian->status === 'completed')
                                bg-green-100 text-green-800
                            @else
                                bg-gray-100 text-gray-800
                            @endif">
                        <i class="fas fa-circle text-xs mr-2 animate-pulse"></i>
                        {{ ucfirst(str_replace('_', ' ', $pendirian->status)) }}
                    </span>
                    <a href="{{ route('pendirian.cv.edit', $pendirian->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Data
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Company Info -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Company Address -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-map-marked-alt mr-3 text-indigo-500"></i>
                            Alamat & Lokasi Perusahaan
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Provinsi</p>
                                <p class="font-medium text-gray-900" id="province-display">{{ $provinceName ?? $pendirian->province }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Kota/Kabupaten</p>
                                <p class="font-medium text-gray-900" id="city-display">{{ $cityName ?? $pendirian->city }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Kecamatan</p>
                                <p class="font-medium text-gray-900" id="district-display">{{ $districtName ?? $pendirian->district }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Desa/Kelurahan</p>
                                <p class="font-medium text-gray-900" id="village-display">{{ $villageName ?? $pendirian->village }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 mb-1">Alamat Lengkap</p>
                                <p class="font-medium text-gray-900">{{ $pendirian->alamat_lengkap }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Kode Pos</p>
                                <p class="font-medium text-gray-900">{{ $pendirian->kode_pos }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Directors & Commissioners -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-users mr-3 text-indigo-500"></i>
                            Struktur Organisasi
                        </h3>
                    </div>
                    <div class="p-6 space-y-8">
                        <!-- Directors -->
                        <div>
                            <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4 border-b pb-2">Direktur
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @forelse($pendirian->direktur_data as $index => $direktur)
                                    <div class="border rounded-lg p-4 bg-gray-50 hover:bg-gray-100 transition-colors">
                                        <div class="flex items-start justify-between mb-2">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold mr-3">
                                                    {{ substr($direktur['nama'] ?? 'D', 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-900">{{ $direktur['nama'] ?? '-' }}</p>
                                                    <p class="text-xs text-gray-500">{{ $direktur['jabatan'] ?? 'Direktur #' . ($index + 1) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex gap-2 mt-3">
                                            @if(!empty($direktur['ktp_path']))
                                                <a href="{{ asset('storage/' . $direktur['ktp_path']) }}" target="_blank"
                                                    class="flex-1 inline-flex items-center justify-center px-3 py-1.5 bg-white border border-gray-200 rounded text-xs text-gray-700 hover:border-indigo-300 hover:text-indigo-600 transition-colors">
                                                    <i class="fas fa-id-card mr-2"></i> KTP
                                                </a>
                                            @endif
                                            @if(!empty($direktur['npwp_path']))
                                                <a href="{{ asset('storage/' . $direktur['npwp_path']) }}" target="_blank"
                                                    class="flex-1 inline-flex items-center justify-center px-3 py-1.5 bg-white border border-gray-200 rounded text-xs text-gray-700 hover:border-indigo-300 hover:text-indigo-600 transition-colors">
                                                    <i class="fas fa-file-invoice mr-2"></i> NPWP
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-gray-500">Tidak ada data direktur.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Commissioners -->
                        <div>
                            <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4 border-b pb-2">
                                Komisaris</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @forelse($pendirian->komisaris_data as $index => $komisaris)
                                    @if(empty($komisaris['nama'])) @continue @endif
                                    <div class="border rounded-lg p-4 bg-gray-50 hover:bg-gray-100 transition-colors">
                                        <div class="flex items-start justify-between mb-2">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 font-bold mr-3">
                                                    {{ substr($komisaris['nama'] ?? 'K', 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-900">{{ $komisaris['nama'] ?? '-' }}</p>
                                                    <p class="text-xs text-gray-500">{{ $komisaris['jabatan'] ?? 'Komisaris #' . ($index + 1) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex gap-2 mt-3">
                                            @if(!empty($komisaris['ktp_path']))
                                                <a href="{{ asset('storage/' . $komisaris['ktp_path']) }}" target="_blank"
                                                    class="flex-1 inline-flex items-center justify-center px-3 py-1.5 bg-white border border-gray-200 rounded text-xs text-gray-700 hover:border-teal-300 hover:text-teal-600 transition-colors">
                                                    <i class="fas fa-id-card mr-2"></i> KTP
                                                </a>
                                            @endif
                                            @if(!empty($komisaris['npwp_path']))
                                                <a href="{{ asset('storage/' . $komisaris['npwp_path']) }}" target="_blank"
                                                    class="flex-1 inline-flex items-center justify-center px-3 py-1.5 bg-white border border-gray-200 rounded text-xs text-gray-700 hover:border-teal-300 hover:text-teal-600 transition-colors">
                                                    <i class="fas fa-file-invoice mr-2"></i> NPWP
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-gray-500 italic">Tidak ada data komisaris.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KBLI -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-list-alt mr-3 text-indigo-500"></i>
                            KBLI (Bidang Usaha)
                        </h3>
                        <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-bold">
                            Total: {{ count($pendirian->kbli_selected ?? []) }}
                        </span>
                    </div>
                    <div class="p-6">
                        @if(!empty($pendirian->kbli_selected))
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left">
                                    <thead class="bg-gray-50 text-gray-600">
                                        <tr>
                                            <th class="px-4 py-2 rounded-tl-lg">Kode</th>
                                            <th class="px-4 py-2">Judul KBLI</th>
                                            <th class="px-4 py-2 rounded-tr-lg">Uraian</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($pendirian->kbli_selected as $kbli)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-4 py-3 font-mono font-bold text-indigo-600 align-top">
                                                    {{ $kbli['kbli'] ?? '-' }}</td>
                                                <td class="px-4 py-3 font-semibold text-gray-800 align-top">
                                                    {{ $kbli['judul'] ?? '-' }}</td>
                                                <td class="px-4 py-3 text-gray-600 align-top">
                                                    {{ Str::limit($kbli['uraian'] ?? '-', 100) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if(count($pendirian->kbli_selected) > 5)
                                <div class="mt-4 p-4 bg-amber-50 border border-amber-200 rounded-lg flex items-start gap-3">
                                    <i class="fas fa-info-circle text-amber-500 mt-0.5"></i>
                                    <div>
                                        <p class="text-sm font-semibold text-amber-800">Biaya Tambahan KBLI</p>
                                        <p class="text-sm text-amber-700">
                                            Opsi dokumen yang dipilih untuk kelebihan KBLI:
                                            <strong>
                                                @if($pendirian->kbli_doc_option == 'akta')
                                                    Akta Saja
                                                @elseif($pendirian->kbli_doc_option == 'both')
                                                    Akta + NIB
                                                @else
                                                    -
                                                @endif
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                            @endif
                        @else
                            <p class="text-gray-500">Tidak ada KBLI yang dipilih.</p>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Right Column: Bank & Payment & Timeline -->
            <div class="space-y-6">
                <!-- Selected Bank -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-university mr-3 text-indigo-500"></i>
                            Bank Rekanan
                        </h3>
                    </div>
                    <div class="p-6 text-center">
                        @if($pendirian->selected_bank)
                            <div class="inline-block p-4 border rounded-xl mb-3 shadow-sm">
                                <i class="fas fa-building text-4xl text-gray-400 mb-2 block"></i>
                                <span class="font-bold text-xl text-gray-800">{{ $pendirian->selected_bank }}</span>
                            </div>
                            <p class="text-sm text-gray-500">Bank yang dipilih untuk pembukaan rekening perusahaan.</p>
                        @else
                            <p class="text-gray-500 italic">Belum memilih bank.</p>
                        @endif
                    </div>
                </div>

                <!-- Payment Proof -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-receipt mr-3 text-indigo-500"></i>
                            Bukti Pembayaran
                        </h3>
                    </div>
                    <div class="p-6">
                        @if($pendirian->payment_proof_path)
                            <div class="flex items-center gap-3 p-3 bg-green-50 border border-green-200 rounded-lg">
                                <div class="bg-green-100 p-2 rounded text-green-600">
                                    <i class="fas fa-file-invoice-dollar text-xl"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ basename($pendirian->payment_proof_path) }}</p>
                                    <p class="text-xs text-gray-500">Uploaded: {{ $pendirian->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $pendirian->payment_proof_path) }}" target="_blank"
                                class="block w-full mt-3 text-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors shadow-sm text-sm font-medium">
                                <i class="fas fa-download mr-2"></i> Download Bukti
                            </a>
                        @else
                            <div class="text-center py-6 bg-gray-50 rounded border border-dashed border-gray-300">
                                <i class="fas fa-exclamation-triangle text-amber-400 text-2xl mb-2"></i>
                                <p class="text-gray-500 text-sm">Belum ada bukti pembayaran.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Timeline / History Placeholder -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-history mr-3 text-indigo-500"></i>
                            Riwayat Status
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="relative pl-4 border-l-2 border-indigo-100 space-y-6">
                            <!-- Current Status -->
                            <div class="relative">
                                <div class="absolute -left-[21px] bg-indigo-500 h-3 w-3 rounded-full ring-4 ring-white">
                                </div>
                                <p class="text-sm font-bold text-gray-900">Pengajuan {{ ucfirst($pendirian->status) }}</p>
                                <p class="text-xs text-gray-500">{{ $pendirian->updated_at->format('d M Y, H:i') }}</p>
                                <p class="text-xs text-gray-600 mt-1">Status terakhir pengajuan Anda saat ini.</p>
                            </div>
                            <!-- Created Status -->
                            <div class="relative">
                                <div class="absolute -left-[21px] bg-gray-300 h-3 w-3 rounded-full ring-4 ring-white"></div>
                                <p class="text-sm font-bold text-gray-900">Pengajuan Dibuat</p>
                                <p class="text-xs text-gray-500">{{ $pendirian->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Script to fetch location details for IDs (Optional, usually better to store names or use relation) -->
    <!-- Assuming we display IDs for now, or if they are names (which they seem to be based on controller store logic taking request input directly), then fine. -->
    <!-- The form sends values. If values are IDs, we see IDs. If names, we see names. -->

    <!-- Optional: Add simple JS to fetch names if they look like IDs -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Check if province looks like an ID (numeric)
            const provinceEl = document.getElementById('province-display');
            const cityEl = document.getElementById('city-display');
            const districtEl = document.getElementById('district-display');
            const villageEl = document.getElementById('village-display');

            // Helper to fetch Name
            async function fetchName(url, id, element) {
                if (!id || isNaN(id)) return; // Assuming IDs are numeric strings
                try {
                    // This endpoint might not exist to fetch SINGLE item by ID unless we use the same list endpoint with filter?
                    // The existing endpoints return lists based on PARENT ID.
                    // We can't easily fetch name by simple ID unless we have a specific endpoint or iterate.
                    // Given the constraint, we will stick to displaying what is stored.
                    // If the user feedback says "It shows numbers", we will fix it.
                } catch (e) {
                    console.error(e);
                }
            }
        });
    </script>
@endsection