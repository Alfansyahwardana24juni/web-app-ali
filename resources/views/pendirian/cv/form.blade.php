<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendirian CV - {{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        :root {
            --primary: #0b326b;
            --primary-foreground: #ffffff;
            --accent: #0077e6;
            --accent-foreground: #ffffff;
            --accent-hover: #0060ba;
            --background: #f8fafc;
            --foreground: #0f172a;
            --muted: #f1f5f9;
            --muted-foreground: #64748b;
            --card: #ffffff;
            --card-foreground: #0f172a;
            --success: #10b981;
            --destructive: #ef4444;
            --border: #e2e8f0;
            --input: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            --radius: 0.75rem;
            --touch-target: 44px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--muted);
            color: var(--foreground);
            margin: 0;
            padding-bottom: 90px;
        }

        header.app-header {
            background-color: var(--primary);
            color: var(--primary-foreground);
            padding: 1rem;
            box-shadow: var(--shadow-md);
        }

        .stepper-sticky {
            background-color: var(--card);
            border-bottom: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
        }

        .sticky-top-wrapper {
            position: sticky;
            top: 0;
            z-index: 50;
            width: 100%;
        }

        .stepper-content {
            max-width: 42rem;
            margin: 0 auto;
            padding: 1rem;
        }

        .desktop-stepper {
            display: none;
            position: relative;
            justify-content: space-between;
            align-items: center;
        }

        @media (min-width: 768px) {
            .desktop-stepper {
                display: flex;
            }
        }

        .stepper-line-bg {
            position: absolute;
            left: 0;
            right: 0;
            top: 1.25rem;
            height: 2px;
            background-color: var(--muted);
            z-index: 0;
            border-radius: 999px;
        }

        .stepper-line-fill {
            position: absolute;
            left: 0;
            top: 1.25rem;
            height: 2px;
            background-color: var(--accent);
            z-index: 0;
            transition: width 0.5s ease-out;
            width: 0%;
        }

        .step-item {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            min-width: 80px;
        }

        .step-circle {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background-color: var(--muted);
            color: var(--muted-foreground);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 0 0 4px var(--card);
        }

        .step-item.active .step-circle {
            background-color: var(--primary);
            color: var(--primary-foreground);
            transform: scale(1.1);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 0 0 4px var(--card);
        }

        .step-item.completed .step-circle {
            background-color: var(--accent);
            color: var(--accent-foreground);
            box-shadow: var(--shadow-sm), 0 0 0 4px var(--card);
        }

        .step-label {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--muted-foreground);
            transition: color 0.3s;
        }

        .step-item.active .step-label,
        .step-item.completed .step-label {
            color: var(--foreground);
        }

        .mobile-stepper {
            display: block;
        }

        @media (min-width: 768px) {
            .mobile-stepper {
                display: none;
            }
        }

        .mobile-stepper-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .mobile-progress-track {
            height: 0.5rem;
            background-color: var(--muted);
            border-radius: 999px;
            overflow: hidden;
        }

        .mobile-progress-fill {
            height: 100%;
            background-color: var(--accent);
            transition: width 0.5s ease;
            width: 20%;
        }

        .card-elevated {
            background-color: var(--card);
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
            animation: slide-in 0.4s ease-out;
        }

        .form-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--foreground);
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-input {
            width: 100%;
            min-height: var(--touch-target);
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 0.5rem;
            border: 1px solid var(--border);
            color: var(--foreground);
            background-color: white;
            transition: all 0.2s;
        }

        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(11, 50, 107, 0.1);
        }

        .bottom-nav {
            background-color: var(--card);
            border-top: 1px solid var(--border);
            padding: 1rem;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 50;
            box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            height: var(--touch-target);
            padding: 0 1rem;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-primary {
            background-color: var(--accent);
            color: var(--accent-foreground);
        }

        .btn-primary:hover {
            background-color: var(--accent-hover);
        }

        .btn-outline {
            border: 1px solid var(--border);
            background-color: transparent;
            color: var(--foreground);
        }

        .btn-outline:hover {
            background-color: var(--muted);
        }

        .person-entry,
        .bg-muted {
            background: var(--muted);
            border-radius: 0.75rem;
            padding: 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid var(--border);
        }

        .select2-container .select2-selection--single {
            height: var(--touch-target) !important;
            border: 1px solid var(--input) !important;
            border-radius: 0.5rem !important;
            padding: 0.5rem !important;
            display: flex !important;
            align-items: center !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: var(--touch-target) !important;
            top: 0 !important;
        }

        .select2-dropdown {
            z-index: 9999;
            width: 20% !important;
        }

        .select2-container {
            width: 100% !important;
        }

        .form-input.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.1);
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }

        .toast {
            position: fixed;
            top: 1rem;
            right: 1rem;
            padding: 1rem 1.5rem;
            background: white;
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            border-left: 4px solid var(--primary);
            z-index: 100;
            transform: translateX(110%);
            transition: transform 0.3s ease;
        }

        .toast.show {
            transform: translateX(0);
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
        }

        /* Bottom Sheet Styles */
        .bottom-sheet-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }

        .bottom-sheet-overlay.show {
            opacity: 1;
            pointer-events: auto;
        }

        .bottom-sheet {
            background: white;
            width: 100%;
            max-width: 600px;
            /* Limit width on desktop */
            border-top-left-radius: 1.5rem;
            border-top-right-radius: 1.5rem;
            padding: 1.5rem;
            max-height: 85vh;
            display: flex;
            flex-direction: column;
            transform: translateY(100%);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
        }

        .bottom-sheet-overlay.show .bottom-sheet {
            transform: translateY(0);
        }

        .bottom-sheet-header {
            flex-shrink: 0;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .bottom-sheet-body {
            overflow-y: auto;
            flex-grow: 1;
            padding-bottom: 2rem;
            /* Initial padding */
        }

        /* Custom Scrollbar for sheet */
        .bottom-sheet-body::-webkit-scrollbar {
            width: 6px;
        }

        .bottom-sheet-body::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .bottom-sheet-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .kbli-item {
            padding: 1rem;
            border-bottom: 1px solid var(--border);
            cursor: pointer;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .kbli-item:last-child {
            border-bottom: none;
        }

        .kbli-item:hover {
            background-color: var(--muted);
        }

        .kbli-item.selected {
            background-color: #eff6ff;
            border-color: #bfdbfe;
        }

        /* Bank Option Styles */
        .bank-option {
            cursor: pointer;
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 1rem;
            background-color: white;
            transition: all 0.2s;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .bank-option:hover {
            background-color: var(--muted);
            border-color: var(--accent);
        }

        .bank-option.selected {
            border-color: var(--accent);
            background-color: #eff6ff;
            box-shadow: 0 0 0 2px rgba(0, 119, 230, 0.1);
        }

        .bank-logo {
            height: 2.5rem;
            width: auto;
            object-fit: contain;
            transition: transform 0.2s;
        }

        .bank-option:hover .bank-logo {
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="min-h-screen bg-background pb-10">
        <div class="sticky-top-wrapper">
            <header class="app-header border-b px-4 py-3 flex items-center justify-between shadow-sm">
                <div class="header-content w-full">
                    <div class="flex items-center gap-3">
                        <div class="bg-white/10 text-white p-2 rounded-lg"><i class="fas fa-building text-xl"></i></div>
                        <div>
                            <h1 class="text-lg font-bold text-white leading-tight">Form Pendirian CV</h1>
                            <p class="text-xs text-blue-100">Lengkapi formulir berikut untuk mengajukan pendirian CV</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="stepper-sticky bg-white/90 backdrop-blur border-b transition-all">
                <div class="stepper-content">
                    <div class="mobile-stepper">
                        <div class="mobile-stepper-header"><span class="text-foreground"
                                id="mobile-step-title">Informasi Perusahaan</span><span class="text-muted-foreground"
                                id="mobile-step-count">1/5</span></div>
                        <div class="mobile-progress-track">
                            <div class="mobile-progress-fill" id="mobile-progress-bar" style="width: 20%"></div>
                        </div>
                    </div>
                    <div class="desktop-stepper">
                        <div class="stepper-line-bg"></div>
                        <div class="stepper-line-fill" id="desktop-progress-line" style="width: 0%"></div>
                        <div class="step-item active" data-step="1">
                            <div class="step-circle"><i class="fas fa-building"></i></div><span
                                class="step-label">Perusahaan</span>
                        </div>
                        <div class="step-item" data-step="2">
                            <div class="step-circle"><i class="fas fa-users"></i></div><span
                                class="step-label">Direktur</span>
                        </div>
                        <div class="step-item" data-step="3">
                            <div class="step-circle"><i class="fas fa-user-tie"></i></div><span
                                class="step-label">Komisaris</span>
                        </div>
                        <div class="step-item" data-step="4">
                            <div class="step-circle"><i class="fas fa-landmark"></i></div><span class="step-label">KBLI
                                & Bank</span>
                        </div>
                        <div class="step-item" data-step="5">
                            <div class="step-circle"><i class="fas fa-credit-card"></i></div><span
                                class="step-label">Bayar</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="main-content max-w-2xl mx-auto px-4 py-6 mb-24">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3 text-green-700">
                    <i class="fas fa-check-circle text-xl"></i><span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="card-elevated bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-100">
                <form
                    action="{{ isset($pendirianCV) ? route('pendirian.cv.update', $pendirianCV->id) : route('pendirian.cv.store') }}"
                    method="POST" enctype="multipart/form-data" id="pendirian-cv-form">
                    @csrf @if(isset($pendirianCV)) @method('PUT') @endif

                    <div class="form-section active" data-step="1">
                        <div class="mb-6 pb-4 border-b">
                            <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2"><i
                                    class="fas fa-building text-blue-600"></i>Informasi Perusahaan</h2>
                            <p class="text-sm text-gray-500 mt-1">Lengkapi identitas dasar perusahaan CV Anda.</p>
                        </div>
                        <div class="form-group mb-4">
                            <label for="nama_perusahaan" class="form-label required">Nama Perusahaan</label>
                            <input type="text" class="form-input" id="nama_perusahaan" name="nama_perusahaan" required
                                placeholder="Contoh: Maju Jaya Abadi"
                                value="{{ old('nama_perusahaan', $pendirianCV->nama_perusahaan ?? '') }}">
                            <p class="text-xs text-muted-foreground mt-1">Minimal 2 suku kata.</p>
                            <div class="error-message text-red-500 text-xs mt-1" id="nama_perusahaan-error"></div>
                        </div>
                        <div class="border-t pt-4 mt-4">
                            <h4 class="text-md font-medium text-gray-900 mb-4 flex items-center"><i
                                    class="fas fa-map-marker-alt mr-2 text-indigo-500"></i>Alamat Lengkap Perusahaan
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="form-group"><label for="province"
                                        class="form-label required">Provinsi</label><select class="form-input"
                                        id="province" name="province" required>
                                        <option value="">-- Pilih Provinsi --</option>
                                    </select>
                                    <div class="error-message text-red-500 text-xs mt-1" id="province-error"></div>
                                </div>
                                <div class="form-group"><label for="city"
                                        class="form-label required">Kota/Kabupaten</label><select class="form-input"
                                        id="city" name="city" required disabled>
                                        <option value="">-- Pilih Kota --</option>
                                    </select>
                                    <div class="error-message text-red-500 text-xs mt-1" id="city-error"></div>
                                </div>
                                <div class="form-group"><label for="district"
                                        class="form-label required">Kecamatan</label><select class="form-input"
                                        id="district" name="district" required disabled>
                                        <option value="">-- Pilih Kecamatan --</option>
                                    </select>
                                    <div class="error-message text-red-500 text-xs mt-1" id="district-error"></div>
                                </div>
                                <div class="form-group"><label for="village"
                                        class="form-label required">Desa/Kelurahan</label><select class="form-input"
                                        id="village" name="village" required disabled>
                                        <option value="">-- Pilih Desa --</option>
                                    </select>
                                    <div class="error-message text-red-500 text-xs mt-1" id="village-error"></div>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="alamat_lengkap" class="form-label required">Alamat Lengkap</label>
                                <textarea class="form-input" id="alamat_lengkap" name="alamat_lengkap" rows="3" required
                                    placeholder="Jalan, nomor rumah, RT/RW, dll.">{{ old('alamat_lengkap', $pendirianCV->alamat_lengkap ?? '') }}</textarea>
                                <div class="error-message text-red-500 text-xs mt-1" id="alamat_lengkap-error"></div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="kode_pos" class="form-label required">Kode Pos</label>
                                <input type="text" class="form-input" id="kode_pos" name="kode_pos" required
                                    placeholder="Contoh: 12345"
                                    value="{{ old('kode_pos', $pendirianCV->kode_pos ?? '') }}">
                                <div class="error-message text-red-500 text-xs mt-1" id="kode_pos-error"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section" data-step="2">
                        <div class="mb-6 pb-4 border-b">
                            <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2"><i
                                    class="fas fa-user-tie text-blue-600"></i>Informasi Direktur</h2>
                            <p class="text-sm text-gray-500 mt-1">Tambahkan informasi lengkap untuk setiap direktur
                                perusahaan.</p>
                        </div>
                        <div id="direktur-container" class="space-y-4"></div>
                        <button type="button" class="btn btn-outline btn-sm mt-4 w-full md:w-auto border-dashed"
                            id="add-direktur"><i class="fas fa-plus mr-2"></i>Tambah Direktur</button>
                    </div>

                    <div class="form-section" data-step="3">
                        <div class="mb-6 pb-4 border-b">
                            <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2"><i
                                    class="fas fa-users text-blue-600"></i>Informasi Komisaris</h2>
                        </div>
                        <div id="komisaris-container" class="space-y-4"></div>
                        <button type="button" class="btn btn-outline btn-sm mt-4 w-full md:w-auto border-dashed"
                            id="add-komisaris"><i class="fas fa-plus mr-2"></i>Tambah Komisaris</button>
                    </div>

                    <div class="form-section" data-step="4">
                        <div class="mb-6 pb-4 border-b">
                            <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2"><i
                                    class="fas fa-list-alt text-blue-600"></i>KBLI & Bank</h2>
                            <p class="text-sm text-gray-500 mt-1">Pilih Bidang Usaha (KBLI) dan Bank Rekanan.</p>
                        </div>

                        <!-- Selected KBLI List -->
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-3">
                                <h4 class="text-md font-medium text-gray-900"><i
                                        class="fas fa-check-circle mr-2 text-green-500"></i>KBLI Terpilih (<span
                                        id="selected-kbli-count">0</span>)</h4>
                                <button type="button" id="open-kbli-sheet"
                                    class="btn btn-outline border-dashed text-blue-600 border-blue-200 hover:bg-blue-50 text-sm">
                                    <i class="fas fa-plus mr-2"></i>Tambah KBLI
                                </button>
                            </div>

                            <p class="text-xs text-gray-500 mt-1 pb-1"><span class="text-[#b45309]">*</span>Pilih
                                minimal 1 kbli</p>

                            <div class="space-y-3" id="selected-kbli-container">
                                <!-- KBLI Items will be rendered here as cards/blocks -->
                                <div class="text-center py-8 border-2 border-dashed border-gray-200 rounded-xl bg-gray-50 text-gray-500"
                                    id="empty-kbli-state">
                                    <i class="fas fa-clipboard-list text-3xl mb-2 opacity-30"></i>
                                    <p>Belum ada KBLI yang dipilih</p>
                                    <p class="text-xs">Klik tombol "Tambah KBLI" untuk memilih bidang usaha.</p>
                                </div>
                            </div>
                            <!-- Hidden input for form submission -->
                            <input type="hidden" name="kbli_selected" id="kbli_selected" value="[]">
                            <div class="error-message text-red-500 text-xs mt-1" id="kbli-section-error"></div>
                        </div>

                        <!-- Financial Info / Excess Fee -->
                        <div class="bg-amber-50 border-l-4 border-amber-500 rounded-r-lg shadow-sm p-5 mb-6 mt-6 transition-all duration-300 hidden"
                            id="kbli-excess-alert">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 text-amber-500 mt-1"><i
                                        class="fas fa-exclamation-triangle fa-lg"></i></div>
                                <div class="w-full">
                                    <h3 class="text-lg font-bold text-gray-800 mb-2">Informasi Biaya Tambahan KBLI</h3>
                                    <div
                                        class="inline-flex items-center bg-white border border-amber-200 rounded-md px-3 py-1 mb-3 shadow-sm">
                                        <span class="text-xs text-gray-500 uppercase tracking-wide font-bold mr-2">Batas
                                            Gratis</span><span class="text-sm font-bold text-amber-700">5 KBLI</span>
                                    </div>
                                    <div id="kbli-doc-options" class="hidden">
                                        <div
                                            class="bg-blue-50 border border-blue-200 rounded-md p-3 mb-4 flex gap-3 items-start">
                                            <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                                            <div class="text-sm text-blue-800">
                                                <p class="font-bold mb-1">Anda telah memilih lebih dari 5 KBLI.</p>
                                                <p class="leading-snug">
                                                    Setiap kelebihan 1 KBLI akan dikenakan biaya:
                                                <ul class="list-disc list-inside mt-1 ml-1 text-blue-700">
                                                    <li><strong>Rp15.000</strong> jika hanya Akta.</li>
                                                    <li><strong>Rp115.000</strong> jika Akta + NIB (Rp15rb + Rp100rb).
                                                    </li>
                                                </ul>
                                                </p>
                                            </div>
                                        </div>
                                        <p class="text-sm font-semibold text-gray-700 mb-3 block">Pilih dokumen untuk
                                            kelebihan KBLI:</p>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <label
                                                class="relative flex items-center p-3 border rounded-lg cursor-pointer hover:bg-amber-50 transition-colors border-gray-200 has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50/50">
                                                <input type="radio" name="kbli_doc_option_radio" value="akta"
                                                    class="h-4 w-4 text-amber-600 border-gray-300 focus:ring-amber-500">
                                                <div class="ml-3"><span
                                                        class="block text-sm font-bold text-gray-900">Akta
                                                        Saja</span><span class="block text-xs text-gray-500">Biaya:
                                                        Rp15.000 / KBLI</span></div>
                                            </label>
                                            <label
                                                class="relative flex items-center p-3 border rounded-lg cursor-pointer hover:bg-amber-50 transition-colors border-gray-200 has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50/50">
                                                <input type="radio" name="kbli_doc_option_radio" value="both" checked
                                                    class="h-4 w-4 text-amber-600 border-gray-300 focus:ring-amber-500">
                                                <div class="ml-3"><span
                                                        class="block text-sm font-bold text-gray-900">Akta +
                                                        NIB</span><span class="block text-xs text-gray-500">Biaya:
                                                        Rp115.000 / KBLI</span></div>
                                            </label>
                                        </div>
                                    </div>
                                    <div
                                        class="mt-4 pt-3 border-t border-amber-200/60 flex justify-between items-center">
                                        <div class="text-sm text-gray-600">
                                            <p>Kelebihan: <span id="excess-kbli-count" class="font-bold text-gray-800">0
                                                    KBLI</span></p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs text-gray-500 uppercase font-bold">Total Tambahan</p>
                                            <p class="text-xl font-extrabold text-amber-700" id="total-kbli-charge">Rp0
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="kbli_doc_option" name="kbli_doc_option" value="">
                        <input type="hidden" id="include_akta" name="include_akta" value="0">
                        <input type="hidden" id="include_nib" name="include_nib" value="0">
                        <div class="mt-8 border-t pt-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2"><i
                                    class="fas fa-university text-blue-600"></i>Pilih Rekanan Bank</h3>
                            <p class="text-sm text-gray-600 mb-4">Silakan pilih salah satu bank rekanan kami untuk
                                proses pembukaan rekening perusahaan anda.</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="bank-options"></div>
                            <input type="hidden" name="selected_bank" id="selected_bank" value="">
                            <div class="error-message text-red-500 text-xs mt-1" id="selected_bank-error"></div>
                        </div>
                    </div>

                    <div class="form-section" data-step="5">
                        <div class="mb-6 pb-4 border-b">
                            <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2"><i
                                    class="fas fa-credit-card text-blue-600"></i>Pembayaran & Upload Bukti</h2>
                        </div>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                            <h4 class="text-lg font-semibold text-blue-900 mb-4">Ringkasan Pembayaran</h4>
                            <div id="payment-summary" class="text-blue-800 space-y-2"></div>
                        </div>
                        <div class="bg-amber-50 border border-amber-200 rounded-lg p-6 mb-6">
                            <h4 class="font-semibold text-amber-900 mb-3 flex items-center"><i
                                    class="fas fa-info-circle mr-2 text-amber-600"></i>Instruksi Pembayaran</h4>
                            <ol class="text-sm text-amber-800 space-y-2 list-decimal list-inside">
                                <li>Transfer biaya</li>
                                <li>Simpan bukti</li>
                                <li>Upload bukti</li>
                                <li>Klik "Ajukan Pendirian"</li>
                            </ol>
                        </div>
                        <div class="form-group">
                            <label class="form-label required">Bukti Pembayaran</label>
                            <div class="payment-proof-container border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition-colors cursor-pointer"
                                id="payment-proof-container">
                                <div class="mb-4"><i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i></div>
                                <p class="text-sm text-gray-600 mb-2">Klik atau seret file ke sini</p>
                                <p class="text-xs text-gray-500 mb-2">Format: JPG, PNG, PDF. Maks: 2MB.</p>
                                <input type="file" id="payment_proof" name="payment_proof" class="hidden"
                                    accept=".jpg,.jpeg,.png,.pdf">
                                <button type="button" class="btn btn-primary mt-2" id="upload-payment-proof-btn"><i
                                        class="fas fa-upload mr-2"></i> Pilih File</button>
                            </div>
                            <div id="payment-proof-preview" class="mt-4 hidden">
                                <div
                                    class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                                    <div class="flex items-center"><i
                                            class="fas fa-check-circle text-green-500 text-2xl mr-3"></i>
                                        <div>
                                            <p class="font-medium text-gray-900" id="payment-proof-name"></p>
                                            <p class="text-sm text-gray-500" id="payment-proof-size"></p>
                                        </div>
                                    </div><button type="button" class="text-red-500 hover:text-red-700"
                                        id="remove-payment-proof"><i class="fas fa-times-circle text-xl"></i></button>
                                </div>
                            </div>
                            <div class="error-message text-red-500 text-xs mt-1" id="payment_proof-error"></div>
                        </div>
                        <div class="bg-blue-600 text-white p-4 rounded-lg mt-6 flex gap-4"><i
                                class="fas fa-list-check text-2xl mt-1"></i>
                            <div>
                                <h4 class="text-md font-bold mb-2">Ringkasan Pengajuan</h4>
                                <div id="submission-summary" class="text-sm space-y-1 text-blue-100"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>

        <div
            class="bottom-nav bg-white border-t p-4 fixed bottom-0 left-0 right-0 z-50 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
            <div class="bottom-nav-content max-w-2xl mx-auto flex gap-3">
                <button type="button" id="prev-step-btn" class="btn btn-outline flex-shrink-0 min-w-[100px]" disabled><i
                        class="fas fa-arrow-left mr-2"></i> Kembali</button>
                <button type="button" id="next-step-btn" class="btn btn-primary flex-grow shadow-md">Lanjut <i
                        class="fas fa-arrow-right ml-2"></i></button>
            </div>
            <p class="text-xs text-center text-gray-500 mt-2 font-medium"><span id="time-estimate"
                    class="text-[#B45309]">Mohon cek kembali form yang anda isi!</span></p>
        </div>
    </div>

    <!-- Bottom Sheet Component -->
    <div class="bottom-sheet-overlay" id="kbli-bottom-sheet-overlay">
        <div class="bottom-sheet">
            <div class="bottom-sheet-header">
                <h3 class="text-lg font-bold">Pilih KBLI</h3>
                <button type="button" id="close-kbli-sheet" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="mb-4">
                <div class="relative">
                    <input type="text" id="sheet-kbli-search" class="form-input pl-10 bg-gray-50 border-gray-200"
                        placeholder="Cari kode atau judul KBLI...">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <div class="bottom-sheet-body" id="sheet-kbli-list">
                <!-- KBLI List Items -->
                <div class="text-center py-8">
                    <span class="spinner-border spinner-border-sm text-blue-500"></span>
                    <p class="text-sm text-gray-500 mt-2">Memuat data KBLI...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sukses Pengajuan -->
    <div id="submission-success-modal" style="display: none;"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[1100]">
        <div class="bg-white rounded-lg shadow-2xl p-8 max-w-md w-full mx-4">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <i class="fas fa-check text-3xl text-green-600"></i>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-2">Pengajuan Terkirim</h2>
            <p class="text-center text-gray-600 mb-6 leading-relaxed">
                Pengajuan anda sedang di proses. Silakan tunggu konfirmasi dari kami.
            </p>
            <button id="lanjut-btn" type="button"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200">
                Lanjut
            </button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // Constants & State
        const AKTA_FEE = 15000, NIB_FEE = 100000, MAX_KBLI_FREE = 5;
        let selectedKBLIs = [], kbliDocOption = 'both', bankLogosMap = {}, selectedBank = null;
        let lastKBLISearchQuery = '', currentKBLIPage = 1, searchSuggestions = [], activeSuggestionIndex = -1, kbliDetailsCache = {};

        const isEdit = {{ isset($pendirianCV) ? 'true' : 'false' }};
        const editData = isEdit ? @json($pendirianCV ?? []) : null;
        if (isEdit && editData) {
            try {
                if (editData.kbli_selected) selectedKBLIs = JSON.parse(editData.kbli_selected);
                if (editData.selected_bank) selectedBank = editData.selected_bank;
            } catch (e) { }
        }

        $(document).ready(function () {
            function initializeApp() {
                initializeLocationDropdowns();
                $('#kbli-search-suggestions').hide();
                // loadAllKBLIs();
                updateSelectedKBLIList();
                updateFinancialSummary(); // Init financial
                initializePersonForms();

                showStep(1);
                updateProgressIndicator(1);
                updateNavigationButtons(1);

                if (selectedBank) $('#selected_bank').val(selectedBank);
            }

            // Location Logic (Original logic simplified for brevity but functional)
            function initializeLocationDropdowns() {
                // Common Select2 Config
                const select2Config = { width: '100%', dropdownAutoWidth: true };

                // Initialize all
                $('#province').select2({ ...select2Config, placeholder: '-- Pilih Provinsi --' });
                $('#city').select2({ ...select2Config, placeholder: '-- Pilih Kota --' });
                $('#district').select2({ ...select2Config, placeholder: '-- Pilih Kecamatan --' });
                $('#village').select2({ ...select2Config, placeholder: '-- Pilih Desa --' });

                // Helper to Populate & Enable/Disable
                function populateSelect(selector, data, placeholder, selectedValue) {
                    const $el = $(selector);
                    $el.empty().append(`<option value="">${placeholder}</option>`);

                    if (data && Object.keys(data).length > 0) {
                        $.each(data, function (key, value) {
                            const isSelected = (selectedValue == key) ? 'selected' : '';
                            $el.append(`<option value="${key}" ${isSelected}>${value}</option>`);
                        });
                        $el.prop('disabled', false); // Use prop, not attr
                    } else {
                        $el.prop('disabled', true);
                    }
                    // Notify Select2 of changes
                    $el.trigger('change.select2');
                }

                // Load Provinces
                $.get('/provinces')
                    .done(function (data) {
                        populateSelect('#province', data, '-- Pilih Provinsi --', (isEdit && editData ? editData.province : null));
                        if (isEdit && editData.province) $('#province').trigger('change');
                    })
                    .fail(function () { console.error("Failed to load provinces"); });

                // Event Handlers
                $('#province').on('change', function () {
                    const id = $(this).val();

                    // Reset children
                    populateSelect('#city', null, '-- Pilih Kota --');
                    populateSelect('#district', null, '-- Pilih Kecamatan --');
                    populateSelect('#village', null, '-- Pilih Desa --');

                    if (id) {
                        $.get('/cities?id=' + id)
                            .done(function (data) {
                                populateSelect('#city', data, '-- Pilih Kota --', (isEdit && editData ? editData.city : null));
                                // Auto trigger if editing to chain load next level
                                if (isEdit && editData.city && $('#city').val() == editData.city) {
                                    $('#city').trigger('change');
                                }
                                updateBankOptions();
                            })
                            .fail(function () { $('#city-error').text('Gagal memuat data kota. Silakan coba lagi.'); console.error('Failed to load cities for province ' + id); });
                    }
                });

                $('#city').on('change', function () {
                    const id = $(this).val();

                    populateSelect('#district', null, '-- Pilih Kecamatan --');
                    populateSelect('#village', null, '-- Pilih Desa --');

                    if (id) {
                        $.get('/districts?id=' + id)
                            .done(function (data) {
                                populateSelect('#district', data, '-- Pilih Kecamatan --', (isEdit && editData ? editData.district : null));
                                if (isEdit && editData.district && $('#district').val() == editData.district) {
                                    $('#district').trigger('change');
                                }
                                updateBankOptions();
                            })
                            .fail(function () { $('#district-error').text('Gagal memuat data kecamatan. Silakan coba lagi.'); console.error('Failed to load districts for city ' + id); });
                    }
                });

                $('#district').on('change', function () {
                    const id = $(this).val();
                    populateSelect('#village', null, '-- Pilih Desa --');

                    if (id) {
                        $.get('/villages?id=' + id)
                            .done(function (data) {
                                populateSelect('#village', data, '-- Pilih Desa --', (isEdit && editData ? editData.village : null));
                            })
                            .fail(function () { $('#village-error').text('Gagal memuat data desa/kelurahan. Silakan coba lagi.'); console.error('Failed to load villages for district ' + id); });
                    }
                });
            }

            function updateBankOptions() {
                const provinceTextRaw = $('#province option:selected').text();
                const cityTextRaw = $('#city option:selected').text();
                const provinceText = (provinceTextRaw || '').toLowerCase().trim();
                const cityText = (cityTextRaw || '').toLowerCase().trim();
                const locationText = cityText || provinceText;
                const bankOptionsContainer = $('#bank-options');

                const bankLogosMap = {
                    'Mandiri': 'https://upload.wikimedia.org/wikipedia/en/thumb/f/fa/Bank_Mandiri_logo.svg/222px-Bank_Mandiri_logo.svg.png?20161029145158',
                    'BNI': 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c6/Logo_Wondr_by_BNI.svg/250px-Logo_Wondr_by_BNI.svg.png',
                    'BRI': 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/BANK_BRI_logo.svg/2560px-BANK_BRI_logo.svg.png',
                    'BSI': 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Bank_Syariah_Indonesia.svg/512px-Bank_Syariah_Indonesia.svg.png',
                    'OCBC': 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1d/Logo-ocbc.svg/512px-Logo-ocbc.svg.png'
                };

                let availableBanks = [];

                if (!locationText || locationText.startsWith('-- pilih')) {
                    bankOptionsContainer.html(
                        '<p class="text-sm text-gray-500 col-span-full">Silakan pilih lokasi terlebih dahulu.</p>'
                    );
                    return;
                }

                if (locationText.includes('makassar') || locationText.includes('gowa') || locationText.includes('maros')) {
                    availableBanks = ['Mandiri', 'BNI', 'BRI', 'BSI'];
                } else if (locationText.includes('jakarta') || locationText.includes('bogor') ||
                    locationText.includes('depok') || locationText.includes('tangerang') || locationText.includes(
                        'tangerang selatan')) {
                    availableBanks = ['Mandiri'];
                } else if (locationText.includes('bekasi') || provinceText.includes('jawa barat')) {
                    availableBanks = ['BNI'];
                } else if (locationText) {
                    availableBanks = ['OCBC'];
                }

                bankOptionsContainer.empty();
                availableBanks.forEach(bank => {
                    const bankOption = $(`
                        <div class="bank-option" data-bank="${bank}">
                            <div class="flex items-center justify-center p-4">
                                <img src="${bankLogosMap[bank]}" alt="${bank}" class="bank-logo">
                            </div>
                            <div class="text-center mt-2">
                                <p class="font-medium text-gray-900">${bank}</p>
                            </div>
                        </div>
                    `);
                    bankOptionsContainer.append(bankOption);
                });

                // Add click event to bank options
                $('.bank-option').on('click', function () {
                    $('.bank-option').removeClass('selected');
                    $(this).addClass('selected');
                    selectedBank = $(this).data('bank');
                    $('#selected_bank').val(selectedBank);
                    $('#selected_bank-error').hide();
                });
            }

            // KBLI Logic - Bottom Sheet Implementation
            let allKBLIData = []; // Store loaded KBLIs if possible, or just use current result

            // Sheet Control
            function openKBLISheet() {
                $('#kbli-bottom-sheet-overlay').addClass('show');
                $('body').css('overflow', 'hidden'); // Prevent background scrolling
                if ($('#sheet-kbli-list').children().length === 0 || $('#sheet-kbli-list').find('.spinner-border').length > 0) {
                    loadKBLIsForSheet();
                }
            }

            function closeKBLISheet() {
                console.log('Closing KBLI sheet');
                $('#kbli-bottom-sheet-overlay').removeClass('show');
                $('body').css('overflow', '');
            }

            $('#open-kbli-sheet').click(openKBLISheet);
            $('#close-kbli-sheet').click(closeKBLISheet);
            $('#kbli-bottom-sheet-overlay').click(function (e) {
                if (e.target === this) closeKBLISheet();
            });

            // Search & Render
            function loadKBLIsForSheet(query = '') {
                $('#sheet-kbli-list').html('<div class="text-center py-8"><span class="spinner-border spinner-border-sm text-blue-500"></span><p class="text-sm text-gray-500 mt-2">Memuat data KBLI...</p></div>');

                // Use existing API but requesting more items for better scrolling experience? 
                // Let's stick to 50 for now to keep it responsive
                $.ajax({
                    url: `/api/kbli/search?query=${encodeURIComponent(query)}&page=1&per_page=100`,
                    method: 'GET',
                    success: function (data) {
                        renderKBLISheetItems(data.data || []);
                    },
                    error: function () {
                        $('#sheet-kbli-list').html(`<div class="text-center py-8 text-red-500">Gagal memuat data. <button class="text-blue-600 underline" onclick="loadKBLIsForSheet('${query}')">Coba lagi</button></div>`);
                    }
                });
            }

            // Search Input Debounce
            let sheetSearchTimeout;
            $('#sheet-kbli-search').on('input', function () {
                clearTimeout(sheetSearchTimeout);
                const q = $(this).val().trim();
                sheetSearchTimeout = setTimeout(() => {
                    loadKBLIsForSheet(q);
                }, 400);
            });


            function renderKBLISheetItems(items) {
                const container = $('#sheet-kbli-list').empty();
                if (!items.length) { container.html('<div class="text-center py-8 text-gray-500">Tidak ada data KBLI ditemukan.</div>'); return; }

                items.forEach(item => {
                    kbliDetailsCache[item.kbli] = item;
                    const isSelected = selectedKBLIs.some(k => k.kbli === item.kbli);
                    container.append(`
                        <div class="kbli-item ${isSelected ? 'selected' : ''}" data-kbli="${item.kbli}">
                            <div class="flex-grow pr-4 pointer-events-none">
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs font-mono font-bold px-2 py-1 rounded mb-1">${item.kbli}</span>
                                <p class="text-sm font-medium text-gray-900 leading-snug">${item.judul}</p>
                            </div>
                            <div class="flex-shrink-0 text-blue-600 ${isSelected ? '' : 'hidden'} check-icon pointer-events-none">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                        </div>
                    `);
                });
            }

            $(document).on('click', '.kbli-item', function () {
                const kbli = $(this).data('kbli');
                const index = selectedKBLIs.findIndex(k => k.kbli === kbli);

                if (index >= 0) {
                    selectedKBLIs.splice(index, 1);
                    $(this).removeClass('selected');
                    $(this).find('.check-icon').addClass('hidden');
                } else {
                    if (kbliDetailsCache[kbli]) {
                        selectedKBLIs.push(kbliDetailsCache[kbli]);
                        $(this).addClass('selected');
                        $(this).find('.check-icon').removeClass('hidden');
                    }
                }
                updateSelectedKBLIList();
                updateFinancialSummary();
            });

            $(document).on('click', '.remove-kbli-btn', function () {
                const kbli = $(this).data('kbli');
                removeKBLI(kbli);
            });

            function updateSelectedKBLIList() {
                const container = $('#selected-kbli-container');
                const emptyState = $('#empty-kbli-state');
                $('#selected-kbli-count').text(selectedKBLIs.length);
                $('#kbli_selected').val(JSON.stringify(selectedKBLIs));

                // Remove all current items except empty state
                container.find('.selected-kbli-card').remove();

                if (selectedKBLIs.length === 0) {
                    emptyState.removeClass('hidden');
                } else {
                    emptyState.addClass('hidden');

                    selectedKBLIs.forEach(k => {
                        // Safety check
                        if (!k || !k.kbli) return;

                        // Create UID for accordion - safely cast to string
                        const kbliCode = String(k.kbli);
                        const uid = kbliCode.replace(/[^a-zA-Z0-9]/g, '');

                        container.append(`
                            <div class="selected-kbli-card bg-white border border-gray-200 rounded-lg shadow-sm transition-colors hover:border-blue-300">
                                <div class="p-3 flex justify-between items-start">
                                    <div class="flex-grow cursor-pointer" onclick="toggleDetail('${uid}')">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2 py-0.5 rounded font-mono">${kbliCode}</span>
                                            <div class="text-xs text-blue-600 flex items-center gap-1 bg-blue-50 px-2 py-0.5 rounded-full">
                                                <span>Lihat Uraian</span>
                                                <i class="fas fa-chevron-down text-blue-500 transition-transform duration-200" id="arrow-${uid}"></i>
                                            </div>
                                        </div>
                                        <p class="text-sm font-medium text-gray-800">${k.judul || 'Tanpa Judul'}</p>
                                    </div>
                                    <button type="button" class="remove-kbli-btn text-gray-400 hover:text-red-500 ml-3 mt-1 flex-shrink-0" data-kbli="${kbliCode}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                                <div id="detail-${uid}" class="hidden border-t border-gray-100 p-3 bg-gray-50 rounded-b-lg">
                                    <p class="text-xs text-gray-600 leading-relaxed text-justify">${k.uraian || 'Tidak ada uraian tersedia.'}</p>
                                </div>
                            </div>
                        `);
                    });
                }

                // Clear validation error if any
                if (selectedKBLIs.length > 0) {
                    $('#kbli-search-input').removeClass('shake error');
                    $('#kbli-section-error').text('');
                }
            }

            window.toggleDetail = function (uid) {
                const detail = $(`#detail-${uid}`);
                const arrow = $(`#arrow-${uid}`);

                if (detail.hasClass('hidden')) {
                    detail.removeClass('hidden').hide().slideDown(200);
                    arrow.css('transform', 'rotate(180deg)');
                } else {
                    detail.slideUp(200, function () {
                        $(this).addClass('hidden');
                    });
                    arrow.css('transform', 'rotate(0deg)');
                }
            };

            function removeKBLI(kbli) {
                console.log('Removing KBLI:', kbli, 'Current selectedKBLIs:', selectedKBLIs);
                selectedKBLIs = selectedKBLIs.filter(k => {
                    console.log('Checking k.kbli:', k.kbli, 'vs kbli:', kbli, 'equal:', k.kbli === kbli);
                    return k.kbli !== kbli;
                });
                console.log('After filter:', selectedKBLIs);
                updateSelectedKBLIList();
                updateFinancialSummary();
                // Also update sheet if open (optional but good)
                const sheetItem = $(`.kbli-item[data-kbli="${kbli}"]`);
                if (sheetItem.length) {
                    sheetItem.removeClass('selected').find('.check-icon').addClass('hidden');
                }
            }
            window.removeKBLI = removeKBLI;

            // Financial Summary
            function updateFinancialSummary() {
                const excess = Math.max(0, selectedKBLIs.length - MAX_KBLI_FREE);
                $('#excess-kbli-count').text(excess + ' KBLI');

                // Always show the alert in step 4
                $('#kbli-excess-alert').removeClass('hidden');

                if (excess > 0) {
                    $('#kbli-doc-options').removeClass('hidden'); // Show doc options only if excess > 0
                    const opt = $('input[name="kbli_doc_option_radio"]:checked').val();
                    kbliDocOption = opt;
                    $('#kbli_doc_option').val(opt);
                    const fee = opt === 'akta' ? AKTA_FEE : (AKTA_FEE + NIB_FEE);
                    const total = excess * fee;
                    $('#total-kbli-charge').text('Rp' + total.toLocaleString('id-ID'));
                } else {
                    $('#kbli-doc-options').addClass('hidden'); // Hide doc options if no excess
                    $('#total-kbli-charge').text('Rp0');
                }
                updatePaymentSummary();
            }
            $('input[name="kbli_doc_option_radio"]').change(updateFinancialSummary);

            function updatePaymentSummary() {
                const excess = Math.max(0, selectedKBLIs.length - MAX_KBLI_FREE);
                let html = `<div class="text-sm space-y-2">`;
                html += `<div class="flex justify-between"><span>Layanan Dasar (5 KBLI pertama)</span><span class="font-bold">Rp0</span></div>`;
                if (excess > 0) {
                    const fee = kbliDocOption === 'akta' ? AKTA_FEE : (AKTA_FEE + NIB_FEE);
                    const docType = kbliDocOption === 'akta' ? 'Akta' : 'Akta + NIB';
                    html += `<div class="flex justify-between"><span>${docType} untuk ${excess} KBLI</span><span class="font-bold">Rp${(excess * fee).toLocaleString('id-ID')}</span></div>`;
                    html += `<div class="flex justify-between text-amber-700"><span>Total Biaya Tambahan</span><span class="font-bold">Rp${(excess * fee).toLocaleString('id-ID')}</span></div>`;
                }
                html += `</div>`;
                $('#payment-summary').html(html);
            }
            function updateSubmissionSummary() {
                const namaPerusahaan = $('#nama_perusahaan').val() || '-';
                const lokasi = ($('#province option:selected').text() || '') + ', ' + ($('#city option:selected').text() || '');
                const jumlahDirektur = $('#direktur-container .person-entry').length;
                const jumlahKomisaris = $('#komisaris-container .person-entry').length;
                const jumlahKBLI = selectedKBLIs.length;
                const rekananBank = selectedBank || '-';
                const excess = Math.max(0, selectedKBLIs.length - MAX_KBLI_FREE);
                const fee = kbliDocOption === 'akta' ? AKTA_FEE : (AKTA_FEE + NIB_FEE);
                const total = excess * fee;
                $('#submission-summary').html(`
                      <div class="text-sm space-y-1">
                          <div><strong>Nama Perusahaan:</strong> ${namaPerusahaan}</div>
                          <div><strong>Lokasi:</strong> ${lokasi}</div>
                          <div><strong>Jumlah Direktur:</strong> ${jumlahDirektur}</div>
                          <div><strong>Jumlah Komisaris:</strong> ${jumlahKomisaris}</div>
                          <div><strong>Jumlah KBLI:</strong> ${jumlahKBLI}</div>
                          <div><strong>Rekanan Bank:</strong> ${rekananBank}</div>
                          <div><strong>Rincian Biaya per Unit:</strong> Akta Rp15.000, NIB Rp100.000</div>
                          <div><strong>Kelebihan:</strong> ${excess} × Rp${fee.toLocaleString('id-ID')} = Rp${total.toLocaleString('id-ID')}</div>
                          <div><strong>Total Biaya Tambahan:</strong> Rp${total.toLocaleString('id-ID')}</div>
                      </div>
                  `);
            }

            // Person Forms
            function createPersonTemplate(type, index, data = null) {
                return `<div class="person-entry relative" data-type="${type}" data-index="${index}">
                        <div class="flex justify-between items-center mb-4 pb-2 border-b border-gray-200"><h4 class="font-bold text-gray-700">${type.charAt(0).toUpperCase() + type.slice(1)} #${index + 1}</h4>${index > 0 ? '<button type="button" class="remove-person text-red-500"><i class="fas fa-trash"></i></button>' : ''}</div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4"><label class="form-label required">Nama Lengkap</label><input type="text" name="${type}[${index}][nama]" class="form-input" required value="${data ? data.nama : ''}"><div class="error-message text-red-500 text-xs mt-1"></div></div>
                            <div class="mb-4"><label class="form-label required">Upload KTP</label><input type="file" name="${type}[${index}][ktp]" class="form-input file-input-preview" accept=".jpg,.jpeg,.png,.pdf"><p class="text-xs text-muted-foreground mt-1">Format: JPG, PNG, PDF. Maks: 2MB.</p><div class="file-preview mt-2 hidden"></div><div class="error-message text-red-500 text-xs mt-1"></div></div>
                            <div class="mb-4"><label class="form-label">Upload NPWP (Opsional)</label><input type="file" name="${type}[${index}][npwp]" class="form-input file-input-preview" accept=".jpg,.jpeg,.png,.pdf"><p class="text-xs text-muted-foreground mt-1">Format: JPG, PNG, PDF. Maks: 2MB.</p><div class="file-preview mt-2 hidden"></div></div>
                        </div></div>`;
            }
            function initializePersonForms() {
                if (isEdit && editData) {
                    if (editData.direktur && editData.direktur.length > 0) {
                        editData.direktur.forEach((d, i) => $('#direktur-container').append(createPersonTemplate('direktur', i, d)));
                    } else {
                        $('#add-direktur').click();
                    }
                    if (editData.komisaris && editData.komisaris.length > 0) {
                        editData.komisaris.forEach((k, i) => $('#komisaris-container').append(createPersonTemplate('komisaris', i, k)));
                    } else {
                        $('#add-komisaris').click();
                    }
                } else {
                    if ($('#direktur-container').children().length === 0) $('#add-direktur').click();
                    if ($('#komisaris-container').children().length === 0) $('#add-komisaris').click();
                }
            }
            $('#add-direktur').click(() => $('#direktur-container').append(createPersonTemplate('direktur', $('#direktur-container .person-entry').length)));
            $('#add-komisaris').click(() => $('#komisaris-container').append(createPersonTemplate('komisaris', $('#komisaris-container .person-entry').length)));
            $(document).on('click', '.remove-person', function () { $(this).closest('.person-entry').remove(); });

            // Payment Proof Button Handler
            $('#upload-payment-proof-btn').click(function () { $('#payment_proof').click(); });

            // File Preview Handler
            $(document).on('change', '.file-input-preview, #payment_proof', function (event) {
                const file = event.target.files[0];
                const isPaymentProof = $(this).attr('id') === 'payment_proof';
                const previewContainer = isPaymentProof ? $('#payment-proof-preview') : $(this).siblings('.file-preview');

                if (file) {
                    // Validation
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
                    if (!allowedTypes.includes(file.type)) {
                        alert('Format file tidak didukung. Harap upload JPG, PNG, atau PDF.');
                        $(this).val('');
                        if (!isPaymentProof) {
                            previewContainer.empty().addClass('hidden');
                        } else {
                            previewContainer.addClass('hidden');
                        }
                        return;
                    }
                    if (file.size > 2 * 1024 * 1024) { // 2MB
                        alert('Ukuran file terlalu besar. Maksimal 2MB.');
                        $(this).val('');
                        if (!isPaymentProof) {
                            previewContainer.empty().addClass('hidden');
                        } else {
                            previewContainer.addClass('hidden');
                        }
                        return;
                    }

                    // Render Preview
                    if (isPaymentProof) {
                        // Payment Proof Specific UI
                        $('#payment-proof-name').text(file.name);
                        $('#payment-proof-size').text((file.size / 1024).toFixed(0) + ' KB');
                        previewContainer.removeClass('hidden');

                        // Add click handler for removal (since it's a specific button in the static HTML)
                        $('#remove-payment-proof').off('click').on('click', function () {
                            $('#payment_proof').val('');
                            $('#payment-proof-preview').addClass('hidden');
                        });
                    } else {
                        if (file.type.match('image.*')) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                previewContainer.html(`<div class="relative inline-block"><img src="${e.target.result}" class="max-h-48 rounded border border-gray-200 shadow-sm"><button type="button" class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs cursor-pointer remove-preview" title="Hapus file"><i class="fas fa-times"></i></button></div>`).removeClass('hidden');
                            }
                            reader.readAsDataURL(file);
                        } else {
                            // Handle non-image files (e.g. PDF)
                            let iconClass = 'fa-file-alt text-gray-500';
                            if (file.type === 'application/pdf') {
                                iconClass = 'fa-file-pdf text-red-500';
                            }

                            previewContainer.html(`
                                <div class="relative inline-flex items-center p-3 bg-gray-50 border border-gray-200 rounded-lg shadow-sm mt-2">
                                    <i class="fas ${iconClass} text-2xl mr-3"></i>
                                    <div class="mr-4">
                                        <p class="text-sm font-medium text-gray-800 break-all line-clamp-1 max-w-[200px]">${file.name}</p>
                                        <p class="text-xs text-gray-500">${(file.size / 1024).toFixed(0)} KB</p>
                                    </div>
                                    <button type="button" class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs cursor-pointer remove-preview" title="Hapus file"><i class="fas fa-times"></i></button>
                                </div>
                            `).removeClass('hidden');
                        }
                    }
                } else {
                    if (!isPaymentProof) previewContainer.empty().addClass('hidden');
                    else previewContainer.addClass('hidden');
                }
            });

            // Remove preview handler
            $(document).on('click', '.remove-preview', function () {
                const container = $(this).closest('.file-preview');
                const input = container.siblings('.file-input-preview');
                input.val(''); // Clear input
                container.empty().addClass('hidden');
            });

            // Stepper Logic
            function showStep(step) {
                $('.form-section').removeClass('active'); $(`.form-section[data-step="${step}"]`).addClass('active');
                if (step === 5) { updateSubmissionSummary(); updatePaymentSummary(); }
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
            function updateProgressIndicator(step) {
                $('.step-item').removeClass('active completed');
                for (let i = 1; i < step; i++) $(`.step-item[data-step="${i}"]`).addClass('completed');
                $(`.step-item[data-step="${step}"]`).addClass('active');
                $('#desktop-progress-line').css('width', `${((step - 1) / 4) * 100}%`);
                $('#mobile-progress-bar').css('width', `${(step / 5) * 100}%`);
                const titles = { 1: 'Informasi', 2: 'Direktur', 3: 'Komisaris', 4: 'KBLI & Bank', 5: 'Pembayaran' };
                $('#mobile-step-title').text(titles[step]); $('#mobile-step-count').text(`${step}/5`);
            }
            function updateNavigationButtons(step) {
                const next = $('#next-step-btn');
                // Hide Prev button on step 1, show on subsequent steps
                if (step === 1) {
                    $('#prev-step-btn').hide();
                } else {
                    $('#prev-step-btn').show();
                }
                $('#prev-step-btn').prop('disabled', step === 1);
                if (step === 5) {
                    next.html(`<i class="fas fa-paper-plane mr-2"></i> ${isEdit ? 'Simpan Perubahan' : 'Ajukan Pendirian'}`).removeClass('btn-primary').addClass('bg-green-600 hover:bg-green-700 text-white').off('click').on('click', () => {
                        if (!$('#payment_proof').val()) {
                            $('#payment_proof-error').text('Bukti pembayaran wajib diupload');
                            $('#payment-proof-container').addClass('shake');
                            $('#payment-proof-container').get(0).scrollIntoView({ behavior: 'smooth', block: 'center' });
                            return;
                        }

                        // AJAX Submission
                        const btn = next;
                        const originalContent = btn.html();
                        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...');

                        const form = $('#pendirian-cv-form')[0];
                        const formData = new FormData(form);

                        $.ajax({
                            url: $(form).attr('action'),
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                $('#submission-success-modal').fadeIn();
                            },
                            error: function (xhr) {
                                btn.prop('disabled', false).html(originalContent);
                                console.error(xhr);
                                alert('Terjadi kesalahan saat mengirim data. Silakan coba lagi.');
                            }
                        });
                    });
                } else {
                    next.html('Lanjut <i class="fas fa-arrow-right ml-2"></i>').addClass('btn-primary').removeClass('bg-green-600 hover:bg-green-700 text-white').off('click').on('click', () => {
                        if (validateStep(step)) { const n = step + 1; showStep(n); updateProgressIndicator(n); updateNavigationButtons(n); }
                    });
                }
                $('#prev-step-btn').off('click').on('click', () => { if (step > 1) { const p = step - 1; showStep(p); updateProgressIndicator(p); updateNavigationButtons(p); } });
            }

            // Validation
            function validateStep(step) {
                let valid = true;
                $('.error-message').text(''); // Clear previous errors
                $('.form-input, .person-entry input, select').removeClass('shake error'); // Remove previous shakes and errors

                let firstErrorField = null;

                if (step === 1) {
                    // Step 1: Informasi Perusahaan
                    if (!$('#nama_perusahaan').val().trim()) {
                        $('#nama_perusahaan-error').text('Nama perusahaan wajib diisi');
                        $('#nama_perusahaan').addClass('shake error');
                        if (!firstErrorField) firstErrorField = '#nama_perusahaan';
                        valid = false;
                    }
                    if (!$('#province').val()) {
                        $('#province-error').text('Provinsi wajib dipilih');
                        $('#province').addClass('shake error');
                        if (!firstErrorField) firstErrorField = '#province';
                        valid = false;
                    }
                    if (!$('#city').val()) {
                        $('#city-error').text('Kota/Kabupaten wajib dipilih');
                        $('#city').addClass('shake error');
                        if (!firstErrorField) firstErrorField = '#city';
                        valid = false;
                    }
                    if (!$('#district').val()) {
                        $('#district-error').text('Kecamatan wajib dipilih');
                        $('#district').addClass('shake error');
                        if (!firstErrorField) firstErrorField = '#district';
                        valid = false;
                    }
                    if (!$('#village').val()) {
                        $('#village-error').text('Desa/Kelurahan wajib dipilih');
                        $('#village').addClass('shake error');
                        if (!firstErrorField) firstErrorField = '#village';
                        valid = false;
                    }
                    if (!$('#alamat_lengkap').val().trim()) {
                        $('#alamat_lengkap-error').text('Alamat lengkap wajib diisi');
                        $('#alamat_lengkap').addClass('shake error');
                        if (!firstErrorField) firstErrorField = '#alamat_lengkap';
                        valid = false;
                    }
                    if (!$('#kode_pos').val().trim()) {
                        $('#kode_pos-error').text('Kode pos wajib diisi');
                        $('#kode_pos').addClass('shake error');
                        if (!firstErrorField) firstErrorField = '#kode_pos';
                        valid = false;
                    }
                } else if (step === 2) {
                    // Step 2: Direktur
                    const direkturEntries = $('#direktur-container .person-entry');
                    if (direkturEntries.length === 0) {
                        $('#direktur-container').addClass('shake');
                        if (!firstErrorField) firstErrorField = '#direktur-container';
                        valid = false;
                    } else {
                        direkturEntries.each(function (index) {
                            const entry = $(this);
                            const namaInput = entry.find('input[name="direktur[' + index + '][nama]"]');
                            const ktpInput = entry.find('input[name="direktur[' + index + '][ktp]"]');
                            const namaError = namaInput.parent().find('.error-message').first();
                            const ktpError = ktpInput.parent().find('.error-message').last();
                            if (!namaInput.val().trim()) {
                                namaError.text('Nama direktur wajib diisi');
                                namaInput.addClass('shake error');
                                if (!firstErrorField) firstErrorField = namaInput;
                                valid = false;
                            }
                            if (!ktpInput.val()) {
                                ktpError.text('KTP direktur wajib diupload');
                                ktpInput.addClass('shake error');
                                if (!firstErrorField) firstErrorField = ktpInput;
                                valid = false;
                            }
                        });
                    }
                } else if (step === 3) {
                    // Step 3: Komisaris
                    const komisarisEntries = $('#komisaris-container .person-entry');
                    if (komisarisEntries.length === 0) {
                        $('#komisaris-container').addClass('shake');
                        if (!firstErrorField) firstErrorField = '#komisaris-container';
                        valid = false;
                    } else {
                        komisarisEntries.each(function (index) {
                            const entry = $(this);
                            const namaInput = entry.find('input[name="komisaris[' + index + '][nama]"]');
                            const ktpInput = entry.find('input[name="komisaris[' + index + '][ktp]"]');
                            const namaError = namaInput.parent().find('.error-message').first();
                            const ktpError = ktpInput.parent().find('.error-message').last();
                            if (!namaInput.val().trim()) {
                                namaError.text('Nama komisaris wajib diisi');
                                namaInput.addClass('shake error');
                                if (!firstErrorField) firstErrorField = namaInput;
                                valid = false;
                            }
                            if (!ktpInput.val()) {
                                ktpError.text('KTP komisaris wajib diupload');
                                ktpInput.addClass('shake error');
                                if (!firstErrorField) firstErrorField = ktpInput;
                                valid = false;
                            }
                        });
                    }
                } else if (step === 4) {
                    // Step 4: KBLI & Bank
                    if (selectedKBLIs.length === 0) {
                        $('#kbli-search-input').addClass('shake error');
                        if (!firstErrorField) firstErrorField = '#kbli-search-input';
                        valid = false;
                    }
                    if (!selectedBank) {
                        $('#selected_bank-error').text('Bank wajib dipilih');
                        $('#bank-options').addClass('shake');
                        if (!firstErrorField) firstErrorField = '#bank-options';
                        valid = false;
                    }
                } else if (step === 5) {
                    // Step 5: Pembayaran
                    if (!$('#payment_proof').val()) {
                        $('#payment_proof-error').text('Bukti pembayaran wajib diupload');
                        $('#payment-proof-container').addClass('shake');
                        if (!firstErrorField) firstErrorField = '#payment-proof-container';
                        valid = false;
                    }
                }

                if (!valid && firstErrorField) {
                    setTimeout(() => {
                        $(firstErrorField).get(0).scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }, 500);
                }

                return valid;
            }

            initializeApp();

            // Success Modal Lanjut Button
            $('#lanjut-btn').click(function () {
                window.location.href = '/pendirian/cv/processing';
            });
        });
    </script>
</body>

</html>