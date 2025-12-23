@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Client')

@section('content')
<style>
/* Carousel Custom Styles */
.carousel-slide {
    display: none;
    animation: fadeIn 0.5s ease-in-out;
}

.carousel-slide.active {
    display: block;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

.carousel-dot {
    transition: all 0.3s ease;
}

.carousel-dot.active {
    width: 2rem;
}
</style>

<!-- SocialChat - Loaded asynchronously -->
<script>
window.addEventListener('load', function() {
    setTimeout(function() {
        var js = document.createElement("script");
        js.async = true;
        window.WEBCHAT_URL =
            'https://app.socialchat.id/webchat/f1d99d96d567ef7e07a1e8a182f7ffe44c?iframe=true';
        window.WEBCHAT_BASE_URL = 'https://app.socialchat.id';
        js.src = 'https://app.socialchat.id/widget/loader.js';
        document.head.appendChild(js);
    }, 2000);
});
</script>

<!-- Welcome Banner -->
<div
    class="bg-gradient-to-r from-[#2A6AA7] to-[#1e5a8e] rounded-xl shadow-lg p-6 md:p-8 mb-6 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
    <div class="relative flex flex-col md:flex-row items-center justify-between">
        <div class="mb-4 md:mb-0">
            <h2 class="text-2xl md:text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
            <p class="text-sm text-blue-100">Kelola semua kebutuhan Pendirian legalitas, perizinan, dan perpajakan
                secara online dengan mudah dan aman</p>
        </div>
        <button
            class="bg-white text-[#2A6AA7] px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-all transform hover:scale-105 flex items-center space-x-2 shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <span>Ajukan Layanan Baru</span>
        </button>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Pengajuan Aktif</p>
                <h3 class="text-3xl font-bold text-gray-800">0</h3>
                <p class="text-xs text-gray-500 mt-1">Sedang diproses</p>
            </div>
            <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Layanan Selesai</p>
                <h3 class="text-3xl font-bold text-gray-800">0</h3>
                <p class="text-xs text-gray-500 mt-1">Total selesai</p>
            </div>
            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-yellow-500 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Menunggu Pembayaran</p>
                <h3 class="text-3xl font-bold text-gray-800">0</h3>
                <p class="text-xs text-gray-500 mt-1">Perlu dibayar</p>
            </div>
            <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center">
                <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Konsultasi</p>
                <h3 class="text-3xl font-bold text-gray-800">0</h3>
                <p class="text-xs text-gray-500 mt-1">Pesan baru</p>
            </div>
            <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center">
                <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column (2/3) -->
    <div class="lg:col-span-2 space-y-6">

        <!-- Tax Reminder Section -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-6 h-6 text-[#2A6AA7]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    Pengingat Pajak
                </h3>
                <a href="#" class="text-sm text-[#2A6AA7] hover:text-[#1e5a8e] font-semibold">Lihat Semua →</a>
            </div>

            <div class="space-y-3">
                <!-- Urgent Tax -->
                <div
                    class="flex items-center p-4 bg-red-50 border-l-4 border-red-500 rounded-lg hover:bg-red-100 transition-all">
                    <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center text-red-500 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800 mb-1">SPT Masa PPh Pasal 21</h4>
                        <p class="text-sm text-gray-600">Jatuh tempo: 10 Desember 2024</p>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-red-500">3</div>
                        <div class="text-xs text-gray-500 uppercase">Hari Lagi</div>
                    </div>
                </div>

                <!-- Warning Tax -->
                <div
                    class="flex items-center p-4 bg-yellow-50 border-l-4 border-yellow-500 rounded-lg hover:bg-yellow-100 transition-all">
                    <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center text-yellow-500 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800 mb-1">SPT Masa PPN</h4>
                        <p class="text-sm text-gray-600">Jatuh tempo: 31 Desember 2024</p>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-yellow-500">24</div>
                        <div class="text-xs text-gray-500 uppercase">Hari Lagi</div>
                    </div>
                </div>

                <!-- Safe Tax -->
                <div
                    class="flex items-center p-4 bg-green-50 border-l-4 border-green-500 rounded-lg hover:bg-green-100 transition-all">
                    <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center text-green-500 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800 mb-1">SPT Tahunan Badan</h4>
                        <p class="text-sm text-gray-600">Jatuh tempo: 30 April 2025</p>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-green-500">143</div>
                        <div class="text-xs text-gray-500 uppercase">Hari Lagi</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Promo Carousel -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-6 h-6 text-[#2A6AA7]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    Promo & Penawaran Spesial
                </h3>
            </div>

            <div class="relative rounded-xl overflow-hidden">
                <!-- Carousel Wrapper -->
                <div class="relative h-80 md:h-96">
                    <!-- Slide 1 -->
                    <div class="carousel-slide active absolute inset-0">
                        <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=1200&h=400&fit=crop"
                            alt="Promo 1" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 text-white">
                            <h3 class="text-2xl md:text-3xl font-bold mb-2">Diskon 30% Pendirian PT</h3>
                            <p class="text-sm md:text-base mb-4 text-gray-200">Dapatkan diskon spesial untuk pendirian
                                PT. Proses cepat, mudah, dan terpercaya!</p>
                            <a href="#"
                                class="inline-block bg-[#2A6AA7] hover:bg-[#1e5a8e] text-white px-6 py-2 rounded-lg font-semibold transition-all transform hover:scale-105">
                                Selengkapnya →
                            </a>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-slide absolute inset-0">
                        <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=1200&h=400&fit=crop"
                            alt="Promo 2" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 text-white">
                            <h3 class="text-2xl md:text-3xl font-bold mb-2">Gratis Konsultasi Pajak</h3>
                            <p class="text-sm md:text-base mb-4 text-gray-200">Konsultasi gratis dengan ahli perpajakan
                                kami. Solusi terbaik untuk kebutuhan pajak Anda!</p>
                            <a href="#"
                                class="inline-block bg-[#2A6AA7] hover:bg-[#1e5a8e] text-white px-6 py-2 rounded-lg font-semibold transition-all transform hover:scale-105">
                                Hubungi Kami →
                            </a>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="carousel-slide absolute inset-0">
                        <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=1200&h=400&fit=crop"
                            alt="Promo 3" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 text-white">
                            <h3 class="text-2xl md:text-3xl font-bold mb-2">Paket Hemat Perizinan</h3>
                            <p class="text-sm md:text-base mb-4 text-gray-200">Paket bundling perizinan usaha dengan
                                harga spesial. Hemat hingga 40%!</p>
                            <a href="#"
                                class="inline-block bg-[#2A6AA7] hover:bg-[#1e5a8e] text-white px-6 py-2 rounded-lg font-semibold transition-all transform hover:scale-105">
                                Lihat Paket →
                            </a>
                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="carousel-slide absolute inset-0">
                        <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?w=1200&h=400&fit=crop"
                            alt="Promo 4" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 text-white">
                            <h3 class="text-2xl md:text-3xl font-bold mb-2">Pendaftaran Merek Mudah</h3>
                            <p class="text-sm md:text-base mb-4 text-gray-200">Lindungi brand Anda! Proses pendaftaran
                                merek cepat dengan garansi approved!</p>
                            <a href="#"
                                class="inline-block bg-[#2A6AA7] hover:bg-[#1e5a8e] text-white px-6 py-2 rounded-lg font-semibold transition-all transform hover:scale-105">
                                Daftar Sekarang →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button onclick="changeSlide(-1)"
                    class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/90 hover:bg-white rounded-full flex items-center justify-center shadow-lg transition-all z-10">
                    <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button onclick="changeSlide(1)"
                    class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/90 hover:bg-white rounded-full flex items-center justify-center shadow-lg transition-all z-10">
                    <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Indicators -->
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                    <button onclick="goToSlide(0)"
                        class="carousel-dot active w-3 h-3 bg-white rounded-full transition-all"></button>
                    <button onclick="goToSlide(1)"
                        class="carousel-dot w-3 h-3 bg-white/50 rounded-full transition-all"></button>
                    <button onclick="goToSlide(2)"
                        class="carousel-dot w-3 h-3 bg-white/50 rounded-full transition-all"></button>
                    <button onclick="goToSlide(3)"
                        class="carousel-dot w-3 h-3 bg-white/50 rounded-full transition-all"></button>
                </div>
            </div>
        </div>



        <!-- Status Pengajuan -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Status Pengajuan Saya</h3>

            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-gray-800 mb-2">Belum Ada Pengajuan</h4>
                <p class="text-gray-500 mb-6 max-w-md mx-auto">Mulai ajukan layanan legalitas untuk usaha Anda sekarang
                </p>
                <button
                    class="bg-[#2A6AA7] hover:bg-[#1e5a8e] text-white px-6 py-3 rounded-lg font-semibold transition-all transform hover:scale-105 inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Ajukan Layanan
                </button>
            </div>
        </div>
    </div>

    <!-- Right Column (1/3) -->
    <div class="space-y-6">
        <!-- User Info Card -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center space-x-3 mb-6">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-[#2A6AA7] to-[#1e5a8e] rounded-full flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">{{ Auth::user()->name }}</h3>
                    <p class="text-sm text-gray-500">Client</p>
                </div>
            </div>

            <div class="space-y-4 border-t pt-4">
                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-gray-500 mb-1">Email</p>
                        <p class="text-sm text-gray-800 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500 mb-1">Telepon</p>
                        <p class="text-sm text-gray-800">{{ Auth::user()->no_telepon }}</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500 mb-1">Alamat</p>
                        <p class="text-sm text-gray-800">{{ Auth::user()->alamat }}</p>
                    </div>
                </div>
            </div>

            <button
                class="mt-6 w-full bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold transition-colors text-sm">
                Edit Profile
            </button>
        </div>

        <!-- Contact Support -->
        <div class="bg-gradient-to-br from-[#2A6AA7] to-[#1e5a8e] rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold">Butuh Bantuan?</h4>
                    <p class="text-sm text-blue-100">Tim kami siap membantu</p>
                </div>
            </div>
            <p class="text-sm text-blue-100 mb-4">Hubungi customer service kami untuk konsultasi gratis tentang layanan
                legalitas usaha Anda.</p>
            <button
                class="w-full bg-white text-[#2A6AA7] px-4 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-all transform hover:scale-105">
                Hubungi CS
            </button>
        </div>

        <!-- Info Box -->
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
            <div class="flex items-start space-x-3">
                <svg class="w-5 h-5 text-amber-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h4 class="text-sm font-bold text-amber-900 mb-1">Informasi Penting</h4>
                    <p class="text-xs text-amber-800">Pastikan data yang Anda masukkan sudah benar. Proses verifikasi
                        akan dilakukan dalam 1x24 jam.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Carousel JavaScript
let currentSlide = 0;
const slides = document.querySelectorAll('.carousel-slide');
const dots = document.querySelectorAll('.carousel-dot');
let autoSlideTimer;

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.remove('active');
        if (i === index) {
            slide.classList.add('active');
        }
    });

    dots.forEach((dot, i) => {
        if (i === index) {
            dot.classList.add('active', 'w-8');
            dot.classList.remove('w-3', 'bg-white/50');
            dot.classList.add('bg-white');
        } else {
            dot.classList.remove('active', 'w-8', 'bg-white');
            dot.classList.add('w-3', 'bg-white/50');
        }
    });
}

function changeSlide(direction) {
    currentSlide += direction;
    if (currentSlide >= slides.length) {
        currentSlide = 0;
    } else if (currentSlide < 0) {
        currentSlide = slides.length - 1;
    }
    showSlide(currentSlide);
    resetAutoSlide();
}

function goToSlide(index) {
    currentSlide = index;
    showSlide(currentSlide);
    resetAutoSlide();
}

function autoSlide() {
    currentSlide++;
    if (currentSlide >= slides.length) {
        currentSlide = 0;
    }
    showSlide(currentSlide);
}

function resetAutoSlide() {
    clearInterval(autoSlideTimer);
    autoSlideTimer = setInterval(autoSlide, 5000);
}

// Initialize carousel
showSlide(0);
autoSlideTimer = setInterval(autoSlide, 5000);

// Pause auto-slide on hover
const carouselContainer = document.querySelector('.carousel-slide').parentElement;
carouselContainer.addEventListener('mouseenter', () => {
    clearInterval(autoSlideTimer);
});

carouselContainer.addEventListener('mouseleave', () => {
    resetAutoSlide();
});

// Keyboard navigation
document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') {
        changeSlide(-1);
    } else if (e.key === 'ArrowRight') {
        changeSlide(1);
    }
});

// Touch support for mobile
let touchStartX = 0;
let touchEndX = 0;

carouselContainer.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
});

carouselContainer.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
});

function handleSwipe() {
    if (touchEndX < touchStartX - 50) {
        changeSlide(1);
    }
    if (touchEndX > touchStartX + 50) {
        changeSlide(-1);
    }
}
</script>

@endsection