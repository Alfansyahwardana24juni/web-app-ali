@extends('layouts.dashboard')

@section('title', 'Pengajuan Sedang Diproses - Pendirian CV')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Pengajuan Sedang Diproses</h1>
                    <p class="text-gray-600 mt-2">Pantau status pengajuan pendirian CV Anda di sini</p>
                </div>
                <div class="text-right">
                    <div class="text-4xl font-bold text-blue-600">{{ $pendirianCVs->total() }}</div>
                    <p class="text-gray-600 text-sm">Total Pengajuan</p>
                </div>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" placeholder="Cari nama perusahaan..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                </select>
            </div>
        </div>

        <!-- Pengajuan List -->
        @if($pendirianCVs->count() > 0)
            <div class="space-y-4">
                @foreach($pendirianCVs as $pendirian)
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="p-6">
                            <!-- Header Kartu -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $pendirian->nama_perusahaan }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">
                                        <i class="fas fa-id-card mr-2"></i>
                                        ID: {{ $pendirian->id }}
                                    </p>
                                </div>
                                <div class="flex flex-col items-end gap-2">
                                    <!-- Status Badge -->
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                                                        @if($pendirian->status === 'pending')
                                                                            bg-yellow-100 text-yellow-800
                                                                        @elseif($pendirian->status === 'processing')
                                                                            bg-blue-100 text-blue-800
                                                                        @else
                                                                            bg-gray-100 text-gray-800
                                                                        @endif">
                                        <i class="fas fa-circle text-xs mr-2 animate-pulse"></i>
                                        {{ ucfirst(str_replace('_', ' ', $pendirian->status)) }}
                                    </span>
                                    <p class="text-xs text-gray-500">
                                        {{ $pendirian->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Informasi Lokasi -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 pb-4 border-b border-gray-200">
                                <div>
                                    <p class="text-sm text-gray-600">Lokasi</p>
                                    <p class="font-medium text-gray-900">
                                        @php
                                            try {
                                                $cityName = \Laravolt\Indonesia\Facade::findCity($pendirian->city)->name ?? $pendirian->city;
                                                $provinceName = \Laravolt\Indonesia\Facade::findProvince($pendirian->province)->name ?? $pendirian->province;
                                            } catch (\Exception $e) {
                                                $cityName = $pendirian->city;
                                                $provinceName = $pendirian->province;
                                            }
                                        @endphp
                                        {{ $cityName }}, {{ $provinceName }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Bank Rekanan</p>
                                    <p class="font-medium text-gray-900">{{ $pendirian->selected_bank ?? 'Belum dipilih' }}</p>
                                </div>
                            </div>

                            <!-- Detail Info -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 pb-4 border-b border-gray-200">
                                <div>
                                    <p class="text-sm text-gray-600">Jumlah Direktur</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ count($pendirian->direktur_data ?? []) }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Jumlah Komisaris</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ count($pendirian->komisaris_data ?? []) }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Jumlah KBLI</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ count($pendirian->kbli_selected ?? []) }}
                                    </p>
                                </div>
                            </div>

                            <!-- KBLI List -->
                            @php
                                $kbliList = $pendirian->kbli_selected ?? [];
                            @endphp
                            @if(count($kbliList) > 0)
                                <div class="mb-4 pb-4 border-b border-gray-200">
                                    <p class="text-sm font-medium text-gray-900 mb-2">KBLI yang Dipilih:</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($kbliList as $kbli)
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                {{ $kbli['kbli'] ?? 'N/A' }} - {{ $kbli['judul'] ?? 'Tidak ada' }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Bukti Pembayaran -->
                            <div class="mb-4 pb-4 border-b border-gray-200">
                                <p class="text-sm font-medium text-gray-900 mb-2">Bukti Pembayaran</p>
                                @if($pendirian->payment_proof_path)
                                    <div class="flex items-center gap-3">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-file-pdf text-red-500 text-xl"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ basename($pendirian->payment_proof_path) }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $pendirian->updated_at->format('d M Y H:i') }}
                                            </p>
                                        </div>
                                        <a href="{{ asset('storage/' . $pendirian->payment_proof_path) }}" target="_blank"
                                            class="inline-flex items-center px-3 py-2 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition-colors">
                                            <i class="fas fa-download mr-2"></i>
                                            Lihat
                                        </a>
                                    </div>
                                @else
                                    <div class="text-center py-4 bg-gray-50 rounded-lg">
                                        <i class="fas fa-exclamation-circle text-yellow-500 text-2xl mb-2"></i>
                                        <p class="text-sm text-gray-600">Bukti pembayaran belum diupload</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col md:flex-row gap-3">
                                <a href="{{ route('pendirian.cv.edit', $pendirian->id) }}"
                                    class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition-colors font-medium">
                                    <i class="fas fa-edit mr-2"></i>
                                    Edit
                                </a>
                                <a href="{{ route('pendirian.cv.show', $pendirian->id) }}"
                                    class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors font-medium">
                                    <i class="fas fa-eye mr-2"></i>
                                    Lihat Detail
                                </a>
                                <button type="button" onclick="confirmDelete('{{ $pendirian->id }}', '{{ $pendirian->nama_perusahaan }}')"
                                    class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors font-medium"> <!-- Changed to button type and onclick -->
                                    <i class="fas fa-trash-alt mr-2"></i>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-8">
                {{ $pendirianCVs->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <div class="mb-4">
                    <i class="fas fa-inbox text-6xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Pengajuan</h3>
                <p class="text-gray-600 mb-6">Anda belum memiliki pengajuan pendirian CV yang sedang diproses.</p>
                <a href="{{ route('pendirian.cv.form') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Buat Pengajuan Baru
                </a>
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeDeleteModal()"></div>

            <!-- Modal panel -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <!-- Heroicon name: outline/exclamation -->
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Hapus Data Pengajuan
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Apakah Anda yakin ingin menghapus data pengajuan untuk <span id="delete-company-name" class="font-bold"></span>?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Hapus
                        </button>
                    </form>
                    <button type="button" onclick="closeDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id, name) {
            // Set company name in prompt
            document.getElementById('delete-company-name').textContent = name;
            
            // Set form action
            const form = document.getElementById('deleteForm');
            // Construct route URL correctly. Assuming route pattern is /pendirian/cv/{id}
            // Use a base variable or simple string concatenation if the prefix is known.
            // Safe way: usage of a placeholder or just constructing it.
            // Base URL: /pendirian/cv/
            form.action = '/pendirian/cv/' + id;
            
            // Show modal
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeDeleteModal();
            }
        });
    </script>
@endsection