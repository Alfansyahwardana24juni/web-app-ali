@extends('layouts.dashboard')

@section('title', 'Pendirian CV')

@section('content')

    <!-- Main Container -->
    <div class="container mx-auto px-4 py-8 lg:py-12 max-w-screen-2xl">
        <!-- Header Section -->
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Pendirian CV</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Pilihan tepat untuk usaha bersama dengan struktur yang fleksibel dan proses cepat.</p>
        </div>

        <!-- Desktop Layout: Grid System -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- LEFT COLUMN - Hero & Pricing -->
            <div class="lg:col-span-1">
                <!-- Hero Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden sticky top-8">
                    <!-- Badge Terpopuler -->
                    <div class="relative">
                        <div class="absolute top-4 right-4 z-10">
                            <span class="bg-red-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg animate-pulse">
                                🔥 TERPOPULER
                            </span>
                        </div>

                        <!-- Header Gradient -->
                        <div class="bg-gradient-to-br from-[#1E4E8C] to-[#2A6AA7] p-8 text-white">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="text-sm opacity-90 font-medium">4.9</span>
                                <span class="text-sm opacity-70">(1.200+ klien)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Section -->
                    <div class="bg-gradient-to-br from-pink-50 to-red-50 p-6 text-center border-b">
                        <p class="text-sm text-gray-500 mb-1">Harga Promo Terbatas</p>
                        <p class="text-gray-400 line-through text-sm mb-1">Rp 2.500.000</p>
                        <div class="text-4xl font-extrabold text-red-600 mb-2">
                            Rp 1.999.000<span class="text-xl">,-</span>
                        </div>
                        <div class="inline-flex items-center gap-2 bg-green-100 text-green-700 px-4 py-1.5 rounded-full text-sm font-medium">
                            <i class="fas fa-piggy-bank"></i>
                            <span>Hemat Rp 501.000</span>
                        </div>
                    </div>

                    <!-- Portal Resmi -->
                    <div class="p-6 bg-white/60">
                        <p class="text-sm text-gray-500 mb-3 text-center">Terintegrasi dengan platform resmi pemerintah</p>
                        <div class="flex flex-wrap gap-3 justify-center">
                            <img src="{{ asset('portal-resmi/lkpp.png') }}" alt="LKPP" class="h-10 rounded-lg" loading="lazy">
                            <img src="{{ asset('portal-resmi/oss.png') }}" alt="OSS" class="h-10 rounded-lg" loading="lazy">
                            <img src="{{ asset('portal-resmi/coretax.png') }}" alt="coretax" class="h-10 rounded-lg" loading="lazy">
                            <img src="{{ asset('portal-resmi/inaproc.png') }}" alt="inaproc" class="h-10 rounded-lg" loading="lazy">
                            <img src="{{ asset('portal-resmi/catalogue.png') }}" alt="catalogue" class="h-10 rounded-lg" loading="lazy">
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <div class="p-6">
                        <a href="{{ route('pendirian.cv.form') }}" class="block w-full bg-gradient-to-r from-blue-700 to-blue-500 hover:from-blue-600 hover:to-blue-400 text-white text-lg font-semibold py-4 px-6 rounded-xl shadow-lg hover:-translate-y-0.5 hover:shadow-xl transition-all duration-300 text-center">
                            <i class="fas fa-rocket mr-2"></i>
                            Dirikan CV Sekarang
                        </a>
                        <p class="text-xs text-gray-500 mt-3 text-center">Proses hanya 2-5 hari kerja. Gratis konsultasi awal.</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN - Documents & Bonus -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Dokumen yang Didapatkan -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500/10 to-emerald-500/10 p-6 border-b">
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-gift text-white"></i>
                            </div>
                            <span>Dokumen yang Didapatkan</span>
                        </h2>
                        <p class="text-sm text-gray-600 mt-2">Paket lengkap legalitas perusahaan Anda</p>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                                <span class="text-sm text-gray-700">Pengecekan Nama CV</span>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                                <span class="text-sm text-gray-700">Akun Coretax</span>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                                <span class="text-sm text-gray-700">Akta Notaris</span>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                                <span class="text-sm text-gray-700">NPWP Coretax</span>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                                <span class="text-sm text-gray-700">SK MENTRI</span>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                                <span class="text-sm text-gray-700">NPWP Fisik +30rb</span>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                                <span class="text-sm text-gray-700">NIB</span>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                                <span class="text-sm text-gray-700">Email Perusahaan</span>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                                <span class="text-sm text-gray-700">SK Kemenkumham</span>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                                <span class="text-sm text-gray-700">Akun OSS</span>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                                <span class="text-sm text-gray-700">Free 25 KBL</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bonus Section -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500/10 to-pink-500/10 p-6 border-b">
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-star text-white"></i>
                            </div>
                            <span>Bonus Spesial</span>
                        </h2>
                        <p class="text-sm text-gray-600 mt-2">Nilai tambah untuk bisnis Anda</p>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="flex items-center gap-4 p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                                <span class="text-3xl">🎁</span>
                                <span class="text-sm font-medium text-gray-700">Konsultasi Legalitas</span>
                            </div>
                            <div class="flex items-center gap-4 p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                                <span class="text-3xl">🎁</span>
                                <span class="text-sm font-medium text-gray-700">Pembukaan Rekening</span>
                            </div>
                            <div class="flex items-center gap-4 p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                                <span class="text-3xl">🎁</span>
                                <span class="text-sm font-medium text-gray-700">Desain Kartu Nama</span>
                            </div>
                            <div class="flex items-center gap-4 p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                                <span class="text-3xl">🎁</span>
                                <span class="text-sm font-medium text-gray-700">Desain Kop Surat</span>
                            </div>
                            <div class="flex items-center gap-4 p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                                <span class="text-3xl">🎁</span>
                                <span class="text-sm font-medium text-gray-700">Desain Logo</span>
                            </div>
                            <div class="flex items-center gap-4 p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                                <span class="text-3xl">🎁</span>
                                <span class="text-sm font-medium text-gray-700">Desain Stempel</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Tambahan -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-info-circle text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-[#2A6AA7] mb-2">Mengapa Memilih Kami?</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Kami menyediakan layanan pendirian CV yang cepat, mudah, dan terpercaya.
                                Dengan tim ahli yang berpengalaman, kami memastikan semua proses berjalan lancar
                                sesuai dengan regulasi yang berlaku. Dapatkan semua dokumen legalitas perusahaan Anda
                                dalam waktu 2-5 hari kerja.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile CTA (Visible only on mobile) -->
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t p-4 lg:hidden">
            <a href="{{ route('pendirian.cv.form') }}" class="block w-full bg-gradient-to-r from-blue-700 to-blue-500 hover:from-blue-600 hover:to-blue-400 text-white text-lg font-semibold py-4 px-6 rounded-xl shadow-lg transition-all duration-300 text-center">
                <i class="fas fa-rocket mr-2"></i>
                Dirikan CV Sekarang
            </a>
        </div>
    </div>

    <style>
    /* Custom animations */
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }

    .animate-pulse {
        animation: pulse 2s ease-in-out infinite;
    }

    /* Sticky positioning for desktop */
    @media (min-width: 1024px) {
        .sticky {
            position: sticky;
            top: 2rem;
        }
    }

    /* Spacing for mobile CTA */
    @media (max-width: 1023px) {
        body {
            padding-bottom: 100px;
        }
    }
    </style>
@endsection