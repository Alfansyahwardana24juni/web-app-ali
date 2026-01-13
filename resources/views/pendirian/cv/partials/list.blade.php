@if($pendirianCVs->count() > 0)
    <div class="space-y-4">
        @foreach($pendirianCVs as $pendirian)
            @php
                try {
                    $cityName = \Laravolt\Indonesia\Facade::findCity($pendirian->city)->name ?? $pendirian->city;
                    $provinceName = \Laravolt\Indonesia\Facade::findProvince($pendirian->province)->name ?? $pendirian->province;
                } catch (\Exception $e) {
                    $cityName = $pendirian->city;
                    $provinceName = $pendirian->province;
                }

                $witaProvinces = [
                    'Bali', 'Nusa Tenggara Barat', 'Nusa Tenggara Timur',
                    'Kalimantan Selatan', 'Kalimantan Timur', 'Kalimantan Utara',
                    'Sulawesi Utara', 'Sulawesi Tengah', 'Sulawesi Selatan',
                    'Sulawesi Tenggara', 'Gorontalo', 'Sulawesi Barat'
                ];

                $witProvinces = [
                    'Maluku', 'Maluku Utara', 'Papua', 'Papua Barat'
                ];

                $tzLabel = 'WIB';
                $tz = 'Asia/Jakarta';

                if (in_array($provinceName, $witProvinces)) {
                    $tz = 'Asia/Jayapura';
                    $tzLabel = 'WIT';
                } elseif (in_array($provinceName, $witaProvinces)) {
                    $tz = 'Asia/Makassar';
                    $tzLabel = 'WITA';
                }

                try {
                    $createdAtLocal = $pendirian->created_at->timezone($tz)->format('d M Y H:i');
                } catch (\Exception $e) {
                    $createdAtLocal = $pendirian->created_at->format('d M Y H:i');
                }

                try {
                    $updatedAtLocal = $pendirian->updated_at->timezone($tz)->format('d M Y H:i');
                } catch (\Exception $e) {
                    $updatedAtLocal = $pendirian->updated_at->format('d M Y H:i');
                }
            @endphp
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
                                {{ $createdAtLocal ?? $pendirian->created_at->format('d M Y H:i') }} {{ $tzLabel ?? 'WIB' }}
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
                                        {{ $updatedAtLocal ?? $pendirian->updated_at->format('d M Y H:i') }} {{ $tzLabel ?? 'WIB' }}
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
                        <button type="button"
                            onclick="confirmDelete('{{ $pendirian->id }}', '{{ $pendirian->nama_perusahaan }}')"
                            class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors font-medium">
                            <!-- Changed to button type and onclick -->
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
        {{ $pendirianCVs->appends(request()->query())->links() }}
    </div>
@else
    <!-- Empty State -->
    <div class="bg-white rounded-lg shadow-sm p-12 text-center">
        <div class="mb-4">
            <i class="fas fa-inbox text-6xl text-gray-400"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Tidak Ada Data Ditemukan</h3>
        <p class="text-gray-600 mb-6">Pencarian untuk "{{ request('search') }}" tidak memberikan hasil.</p>
        @if(request('search') || request('status'))
            <button type="button" onclick="resetFilters()"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-sync mr-2"></i>
                Reset Filter
            </button>
        @else
            <a href="{{ route('pendirian.cv.form') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Buat Pengajuan Baru
            </a>
        @endif
    </div>
@endif