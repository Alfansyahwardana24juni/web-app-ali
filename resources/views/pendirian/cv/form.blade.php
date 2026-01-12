@extends('layouts.dashboard')

@section('title', 'Pendirian CV')

@section('content')

    <!-- Page head assets (kept inline) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts: Inter & Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Terapkan font Inter ke seluruh halaman */
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        }

        /* Font untuk heading */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', sans-serif;
        }

        /* Pastikan Select2 juga menggunakan font Inter */
        .select2-container .select2-selection--single,
        .select2-container--default .select2-selection--single .select2-selection__rendered,
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            font-family: 'Inter', sans-serif;
        }

        /* Style untuk Progress Bar yang Melayang di Bawah */
        /* Hapus padding-top yang lama */
        body {
            padding-top: 0;
        }

        /* Tambahkan padding-bottom ke konten utama agar tidak tertutup bar */
        .main-content-wrapper {
            padding-bottom: 210px;
        }

        /* Sticky Progress Bar */
        .progress-sticky-bar {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 40;
            background-color: white;
            border-top: 1px solid #e5e7eb;
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.08);
            padding: 1.2rem 2rem;
            border-radius: 20px 20px 0 0;
            width: 100%;
            max-width: 1100px;
        }

        /* Konten sticky */
        .progress-sticky-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        /* Container progress indicator */
        .progress-indicator-sticky-container {
            display: flex;
            justify-content: center;
            flex-grow: 1;
        }

        /* Wrapper step */
        .progress-indicator-sticky {
            display: flex;
            justify-content: center;
            position: relative;
        }

        /* Garis background */
        .progress-indicator-sticky::before {
            content: '';
            position: absolute;
            top: 1.2rem;
            left: 12%;
            right: 12%;
            height: 0.25rem;
            background-color: #e5e7eb;
            z-index: 0;
            border-radius: 2px;
        }

        /* Step */
        .progress-step-sticky {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 0.8rem;
            transition: all 0.3s ease;
        }

        .progress-step-sticky-circle {
            width: 2.2rem;
            height: 2.2rem;
            border-radius: 50%;
            background-color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #6b7280;
            margin-bottom: 0.4rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .progress-step-sticky.active .progress-step-sticky-circle {
            background-color: #4f46e5;
            color: white;
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(79, 70, 229, 0.3);
        }

        .progress-step-sticky.completed .progress-step-sticky-circle {
            background-color: #10b981;
            color: white;
        }

        .progress-step-sticky-label {
            font-size: 0.65rem;
            color: #6b7280;
            text-align: center;
            white-space: nowrap;
            font-weight: 500;
        }

        .progress-step-sticky.active .progress-step-sticky-label {
            color: #4f46e5;
            font-weight: 600;
        }

        /* Sembunyikan progress lama */
        .progress-indicator {
            display: none;
        }

        .highlight {
            background-color: #fef3c7;
            padding: 2px 4px;
            border-radius: 3px;
            font-weight: 500;
        }

        /* Animation untuk modal */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .modal-content {
            animation: fadeIn 0.3s ease-out;
        }

        @media (max-width: 1024px) {
            .progress-sticky-bar {
                max-width: 90%;
            }
        }

        @media (max-width: 768px) {
            .progress-sticky-bar {
                padding: 0.8rem 1rem;
                max-width: 100%;
            }

            .progress-indicator-sticky::before {
                left: 15%;
                right: 15%;
            }

            .progress-step-sticky {
                margin: 0 0.5rem;
            }
        }

        /* Mobile-first responsive improvements */
        @media (max-width: 640px) {

            .main-content-wrapper {
                padding-bottom: 120px;
            }

            .progress-sticky-bar {
                padding: 0.8rem 0.5rem;
            }

            .progress-step-sticky {
                margin: 0 0.25rem;
            }

            .progress-step-sticky-circle {
                width: 1.8rem;
                height: 1.8rem;
                font-size: 0.75rem;
            }

            .progress-step-sticky-label {
                font-size: 0.5rem;
            }

            .progress-indicator-sticky::before {
                left: 18%;
                right: 18%;
            }

            .person-entry {
                padding: 1rem !important;
            }

            .grid {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
            }

            input,
            select,
            button {
                font-size: 16px;
                /* Prevents zoom on iOS */
            }

            input[type="file"] {
                padding: 0.75rem 0.5rem;
            }

            button {
                margin-bottom: 0.5rem;
            }

            .overflow-x-auto {
                margin-bottom: 1rem;
            }

            .modal-content {
                width: 95%;
                margin: 5% auto;
            }
        }

        /* Enhanced form styling */
        .form-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin: 2rem auto;
            max-width: 1600px;
        }

        .form-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .form-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,133.3C960,128,1056,96,1152,90.7C1248,85,1344,107,1392,117.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            opacity: 0.2;
        }

        .form-header h2 {
            position: relative;
            z-index: 1;
            font-weight: 600;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            position: relative;
            z-index: 1;
            opacity: 0.9;
        }

        .form-body {
            padding: 2rem;
        }

        .form-section {
            background-color: #f9fafb;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #f3f4f6;
            transition: all 0.3s ease;
        }

        .form-section:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .form-section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #e5e7eb;
            display: flex;
            align-items: center;
        }

        .form-section-title i {
            margin-right: 0.75rem;
            color: #4f46e5;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .required::after {
            content: " *";
            color: #ef4444;
        }

        .form-input {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            font-size: 0.9rem;
            transition: all 0.2s ease-in-out;
            background-color: white;
        }

        .form-input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-input:disabled {
            background-color: #f3f4f6;
            color: #9ca3af;
            cursor: not-allowed;
        }

        .form-help {
            font-size: 0.8rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(79, 70, 229, 0.3);
        }

        .btn-secondary {
            background-color: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(107, 114, 128, 0.3);
        }

        .btn-danger {
            background-color: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .preview-container {
            margin-top: 0.5rem;
            position: relative;
            display: inline-block;
        }

        .preview-image {
            max-height: 120px;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .preview-remove {
            position: absolute;
            top: 0.25rem;
            right: 0.25rem;
            background-color: rgba(239, 68, 68, 0.8);
            color: white;
            border-radius: 50%;
            width: 1.5rem;
            height: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .preview-remove:hover {
            background-color: rgba(239, 68, 68, 1);
            transform: scale(1.1);
        }

        .person-entry {
            position: relative;
            transition: all 0.3s ease;
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #f3f4f6;
        }

        .person-entry:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .person-entry-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .person-entry-title {
            font-weight: 600;
            color: #1f2937;
            display: flex;
            align-items: center;
        }

        .person-entry-title i {
            margin-right: 0.5rem;
            color: #4f46e5;
        }

        .toast {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            z-index: 50;
            transform: translateY(100%);
            opacity: 0;
            transition: all 0.3s ease-in-out;
            display: flex;
            align-items: center;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast-success {
            background-color: #10b981;
            color: white;
        }

        .toast-error {
            background-color: #ef4444;
            color: white;
        }

        .toast-info {
            background-color: #3b82f6;
            color: white;
        }

        .toast i {
            margin-right: 0.75rem;
        }

        .spinner-border {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            vertical-align: text-bottom;
            border: 0.15em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner-border .75s linear infinite;
        }

        @keyframes spinner-border {
            to {
                transform: rotate(360deg);
            }
        }

        /* KBLI Table Styling */
        .kbli-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .kbli-table th {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            padding: 0.75rem;
            text-align: left;
            font-size: 0.8rem;
            font-weight: 600;
            color: #4b5563;
            border-bottom: 1px solid #e5e7eb;
        }

        .kbli-table td {
            padding: 0.75rem;
            font-size: 0.9rem;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        .kbli-table tr:last-child td {
            border-bottom: none;
        }

        .kbli-table tr:hover {
            background-color: #f9fafb;
        }

        .kbli-table .col-kode {
            width: 8%;
        }

        .kbli-table .col-judul {
            width: 20%;
        }

        .kbli-table .col-uraian {
            width: 66%;
        }

        .kbli-table .col-aksi {
            width: 6%;
            text-align: center;
        }

        /* Bank Partner Selection */
        .bank-option {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .bank-option:hover {
            border-color: #4f46e5;
            background-color: #f9fafb;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .bank-option.selected {
            border-color: #4f46e5;
            background-color: #eff6ff;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.1);
        }

        .bank-option .bank-logo {
            height: 3rem;
            object-fit: contain;
        }

        /* Search Enhancement */
        .search-container {
            position: relative;
        }

        .search-container .fa-search {
            position: absolute;
            pointer-events: none;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
        }

        .search-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: white;
            border: 1px solid #e5e7eb;
            border-top: none;
            border-radius: 0 0 8px 8px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 10;
            display: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .search-suggestion {
            padding: 0.5rem 0.75rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .search-suggestion:hover {
            background-color: #f3f4f6;
        }

        .search-suggestion.active {
            background-color: #eff6ff;
        }

        /* Payment Proof Upload */
        .payment-proof-container {
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: white;
        }

        .payment-proof-container:hover {
            border-color: #4f46e5;
            background-color: #f9fafb;
        }

        .payment-proof-container.has-file {
            border-color: #10b981;
            background-color: #f0fdf4;
        }

        /* Error Styling */
        .error-message {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 0.25rem;
            display: none;
        }

        .form-input.error {
            border-color: #ef4444;
        }

        /* Success Box */
        .success-box {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
        }

        .success-box i {
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        /* Warning Box */
        .warning-box {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
        }

        .warning-box i {
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        /* Info Box */
        .info-box {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
        }

        .info-box i {
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        @media (max-width: 640px) {
            .form-container {
                padding: 1rem;
            }

            .form-header h2 {
                font-size: 1.25rem;
            }

            .form-header p {
                font-size: 0.9rem;
            }

            .form-body .grid {
                grid-template-columns: 1fr !important;
            }

            .form-input {
                width: 100%;
            }

            .progress-sticky-bar {
                left: 0;
                transform: none;
                border-radius: 0;
                max-width: none;
                padding: 0.75rem 1rem;
            }

            .progress-step-sticky-label {
                display: none;
            }

            .kbli-table th,
            .kbli-table td {
                padding: 0.5rem;
                font-size: 0.8rem;
            }

            .kbli-table .col-kode {
                width: 10%;
            }

            .kbli-table .col-judul {
                width: 18%;
            }

            .kbli-table .col-uraian {
                width: 62%;
            }

            .kbli-table .col-aksi {
                width: 10%;
            }

            .overflow-x-auto {
                -webkit-overflow-scrolling: touch;
            }

            .bank-option {
                padding: 1rem;
            }

            .bank-option .bank-logo {
                height: 2.5rem;
            }

            #bank-options {
                grid-template-columns: 1fr;
            }
        }
    </style>
    </head>

    <body>

        <!-- Container utama diubah untuk full width dan diberi wrapper -->
        <div class="main-content-wrapper">
            <div class="form-container">
                <!-- Header -->
                <div class="form-header">
                    <h2>{{ isset($pendirianCV) ? 'Edit Pengajuan CV' : 'Form Pendirian CV' }}</h2>
                    <p>{{ isset($pendirianCV) ? 'Perbarui data pengajuan pendirian CV Anda' : 'Lengkapi formulir berikut untuk mengajukan pendirian CV' }}</p>
                </div>

                <!-- Body -->
                <div class="form-body">
                    @if(session('success'))
                        <div class="success-box">
                            <i class="fas fa-check-circle"></i>
                            <div>
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Progress Indicator Lama ( disembunyikan via CSS ) -->
                    <div class="progress-indicator mb-8">
                        <div class="progress-step active" data-step="1">
                            <div class="progress-step-circle">1</div>
                            <div class="progress-step-label">Informasi</div>
                        </div>
                        <div class="progress-step" data-step="2">
                            <div class="progress-step-circle">2</div>
                            <div class="progress-step-label">Direktur</div>
                        </div>
                        <div class="progress-step" data-step="3">
                            <div class="progress-step-circle">3</div>
                            <div class="progress-step-label">Komisaris</div>
                        </div>
                        <div class="progress-step" data-step="4">
                            <div class="progress-step-circle">4</div>
                            <div class="progress-step-label">KBLI & Bank</div>
                        </div>
                        <div class="progress-step" data-step="5">
                            <div class="progress-step-circle">5</div>
                            <div class="progress-step-label">Pembayaran</div>
                        </div>
                    </div>

                    <form
                        action="{{ isset($pendirianCV) ? route('pendirian.cv.update', $pendirianCV->id) : route('pendirian.cv.store') }}"
                        method="POST" enctype="multipart/form-data" id="pendirian-cv-form">
                        @csrf
                        @if(isset($pendirianCV))
                            @method('PUT')
                        @endif
                        <!-- Step 1: Informasi Dasar -->
                        <div class="form-section" data-step="1">
                            <h3 class="form-section-title">
                                <i class="fas fa-building"></i>
                                Informasi Dasar Perusahaan
                            </h3>

                            <div class="form-group">
                                <label for="nama_perusahaan" class="form-label required">Nama Perusahaan</label>
                                <input type="text" class="form-input" id="nama_perusahaan" name="nama_perusahaan" required
                                    value="{{ old('nama_perusahaan', $pendirianCV->nama_perusahaan ?? '') }}">
                                <p class="form-help">Minimal 2 suku kata.</p>
                                <div class="error-message" id="nama_perusahaan-error"></div>
                            </div>

                            <!-- Lokasi Section -->
                            <div class="border-t pt-4 mt-4">
                                <h4 class="text-md font-medium text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2 text-indigo-500"></i>
                                    Alamat Lengkap Perusahaan
                                </h4>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="form-group">
                                        <label for="province" class="form-label required">Provinsi</label>
                                        <select class="form-input" id="province" name="province" required>
                                            <option value="">-- Pilih Provinsi --</option>
                                        </select>
                                        <div class="error-message" id="province-error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="city" class="form-label required">Kota/Kabupaten</label>
                                        <select class="form-input" id="city" name="city" required disabled>
                                            <option value="">-- Pilih Kota --</option>
                                        </select>
                                        <div class="error-message" id="city-error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="district" class="form-label required">Kecamatan</label>
                                        <select class="form-input" id="district" name="district" required disabled>
                                            <option value="">-- Pilih Kecamatan --</option>
                                        </select>
                                        <div class="error-message" id="district-error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="village" class="form-label required">Desa/Kelurahan</label>
                                        <select class="form-input" id="village" name="village" required disabled>
                                            <option value="">-- Pilih Desa --</option>
                                        </select>
                                        <div class="error-message" id="village-error"></div>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <label for="alamat_lengkap" class="form-label required">Alamat Lengkap</label>
                                    <textarea class="form-input" id="alamat_lengkap" name="alamat_lengkap" rows="3" required
                                        placeholder="Jalan, nomor rumah, RT/RW, dll.">{{ old('alamat_lengkap', $pendirianCV->alamat_lengkap ?? '') }}</textarea>
                                    <div class="error-message" id="alamat_lengkap-error"></div>
                                </div>

                                <div class="form-group">
                                    <label for="kode_pos" class="form-label required">Kode Pos</label>
                                    <input type="text" class="form-input" id="kode_pos" name="kode_pos" required
                                        placeholder="Contoh: 12345"
                                        value="{{ old('kode_pos', $pendirianCV->kode_pos ?? '') }}">
                                    <div class="error-message" id="kode_pos-error"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Direktur -->
                        <div class="form-section hidden" data-step="2">
                            <h3 class="form-section-title">
                                <i class="fas fa-user-tie"></i>
                                Informasi Direktur
                            </h3>
                            <p class="text-sm text-gray-600 mb-4">Tambahkan informasi lengkap untuk setiap direktur
                                perusahaan.</p>

                            <div id="direktur-container" class="space-y-4">
                                <!-- Direktur awal akan dirender oleh JS -->
                            </div>

                            <button type="button" class="btn btn-secondary btn-sm mt-4" id="add-direktur">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Direktur
                            </button>
                        </div>

                        <!-- Step 3: Komisaris -->
                        <div class="form-section hidden" data-step="3">
                            <h3 class="form-section-title">
                                <i class="fas fa-users"></i>
                                Informasi Komisaris
                            </h3>
                            <p class="text-sm text-gray-600 mb-4">Tambahkan informasi lengkap untuk setiap komisaris
                                perusahaan.</p>

                            <div id="komisaris-container" class="space-y-4">
                                <!-- Komisaris awal akan dirender oleh JS -->
                            </div>

                            <button type="button" class="btn btn-secondary btn-sm mt-4" id="add-komisaris">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Komisaris
                            </button>
                        </div>

                        <!-- Step 4: KBLI & Rekanan Bank -->
                        <div class="form-section hidden" data-step="4">
                            <h3 class="form-section-title">
                                <i class="fas fa-list-alt"></i>
                                KBLI (Klasifikasi Baku Lapangan Usaha Indonesia)
                            </h3>
                            <p class="text-sm text-gray-600 mb-4">Pilih KBLI yang sesuai dengan bidang usaha Anda.</p>

                            <div>
                                <div class="mb-4">
                                    <label for="kbli-search-input" class="form-label">Cari KBLI</label>
                                    <div class="search-container">
                                        <input type="text" id="kbli-search-input" class="form-input pl-10"
                                            placeholder="Cari berdasarkan kode, judul, atau uraian (min. 3 karakter)...">
                                        <i
                                            class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                        <div class="search-suggestions" id="kbli-search-suggestions"></div>
                                    </div>
                                </div>

                                <div
                                    class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 space-y-2 sm:space-y-0">
                                    <div class="flex items-center space-x-2">
                                        <label for="kbli-per-page" class="text-sm text-gray-700">Tampilkan</label>
                                        <select id="kbli-per-page" class="form-input w-auto">
                                            <option value="10">10</option>
                                            <option value="25" selected>25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                        <span class="text-sm text-gray-700">hasil</span>
                                    </div>
                                    <div id="kbli-search-summary" class="text-sm text-gray-600">Menampilkan 0 hingga 0 dari
                                        0 hasil</div>
                                </div>

                                <div class="overflow-x-auto mb-4">
                                    <table class="kbli-table">
                                        <thead>
                                            <tr>
                                                <th class="col-kode cursor-pointer hover:bg-gray-100" id="sort-kode">
                                                    <div class="flex items-center space-x-1">
                                                        <span>KODE</span>
                                                        <span class="text-xs">↑↓</span>
                                                    </div>
                                                </th>
                                                <th class="col-judul cursor-pointer hover:bg-gray-100 kbli-detail-trigger"
                                                    id="sort-judul">
                                                    <div class="flex items-center space-x-1">
                                                        <span>JUDUL</span>
                                                        <span class="text-xs">↑↓</span>
                                                    </div>
                                                </th>
                                                <th class="col-uraian">URAIAN</th>
                                                <th class="col-aksi">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody id="kbli-results" class="bg-white divide-y divide-gray-200">
                                            <tr>
                                                <td colspan="4" class="py-4 text-center text-gray-500" id="kbli-no-data">
                                                    Memuat data KBLI...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div id="kbli-pagination" class="flex justify-center mt-4"></div>
                            </div>

                            <div class="mt-6">
                                <h4 class="text-md font-medium text-gray-900 mb-2 flex items-center">
                                    <i class="fas fa-check-circle mr-2 text-green-500"></i>
                                    KBLI yang Dipilih (<span id="selected-kbli-count">0</span>)
                                </h4>
                                <div class="overflow-x-auto">
                                    <table class="kbli-table">
                                        <thead class="bg-blue-50">
                                            <tr>
                                                <th class="col-kode">NO</th>
                                                <th class="col-kode">KODE</th>
                                                <th class="col-judul">JUDUL</th>
                                                <th class="col-uraian">URAIAN</th>
                                                <th class="col-aksi">HAPUS</th>
                                            </tr>
                                        </thead>
                                        <tbody id="selected-kbli-body" class="bg-white divide-y divide-gray-200">
                                            <tr>
                                                <td colspan="5" class="py-4 text-center text-gray-500">Belum ada KBLI yang
                                                    dipilih.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="bg-amber-50 border-l-4 border-amber-500 rounded-r-lg shadow-sm p-5 mb-6">
                                <div class="flex items-start gap-4">

                                    <div class="flex-shrink-0 text-amber-500 mt-1">
                                        <i class="fas fa-exclamation-triangle fa-lg"></i>
                                    </div>

                                    <div class="w-full">
                                        <h3 class="text-lg font-bold text-gray-800 mb-2">Informasi Biaya Tambahan KBLI</h3>

                                        <div
                                            class="inline-flex items-center bg-white border border-amber-200 rounded-md px-3 py-1 mb-3 shadow-sm">
                                            <span class="text-xs text-gray-500 uppercase tracking-wide font-bold mr-2">Batas
                                                Gratis</span>
                                            <span class="text-sm font-bold text-amber-700">5 KBLI</span>
                                        </div>

                                        <div id="kbli-doc-options" class="hidden animate-fade-in-down">

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
                                            <p class="text-sm font-semibold text-gray-700 mb-3 block">
                                                Pilih dokumen untuk kelebihan KBLI:
                                            </p>

                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                <label
                                                    class="relative flex items-center p-3 border rounded-lg cursor-pointer hover:bg-amber-50 transition-colors border-gray-200 has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50/50">
                                                    <input type="radio" name="kbli_doc_option_radio" value="akta"
                                                        class="h-4 w-4 text-amber-600 border-gray-300 focus:ring-amber-500">
                                                    <div class="ml-3">
                                                        <span class="block text-sm font-bold text-gray-900">Akta Saja</span>
                                                        <span class="block text-xs text-gray-500">Biaya: Rp15.000 /
                                                            KBLI</span>
                                                    </div>
                                                </label>

                                                <label
                                                    class="relative flex items-center p-3 border rounded-lg cursor-pointer hover:bg-amber-50 transition-colors border-gray-200 has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50/50">
                                                    <input type="radio" name="kbli_doc_option_radio" value="both" checked
                                                        class="h-4 w-4 text-amber-600 border-gray-300 focus:ring-amber-500">
                                                    <div class="ml-3">
                                                        <span class="block text-sm font-bold text-gray-900">Akta +
                                                            NIB</span>
                                                        <span class="block text-xs text-gray-500">Biaya: Rp115.000 /
                                                            KBLI</span>
                                                    </div>
                                                </label>
                                            </div>

                                            <input type="hidden" id="kbli_doc_option" name="kbli_doc_option" value="">
                                            <input type="hidden" id="include_akta" name="include_akta" value="0">
                                            <input type="hidden" id="include_nib" name="include_nib" value="0">
                                        </div>

                                        <div
                                            class="mt-4 pt-3 border-t border-amber-200/60 flex justify-between items-center">
                                            <div class="text-sm text-gray-600">
                                                <p>Kelebihan: <span id="excess-kbli-count" class="font-bold text-gray-800">0
                                                        Kode</span></p>
                                                <p class="text-xs text-gray-500 mt-0.5">Rincian: <span
                                                        id="kbli-cost-breakdown">-</span></p>
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

                            <input type="hidden" name="kbli_selected" id="kbli_selected" value="[]">

                            <!-- Rekanan Bank Section -->
                            <div class="mt-8 border-t pt-6">
                                <h3 class="form-section-title">
                                    <i class="fas fa-university"></i>
                                    Pilih Rekanan Bank
                                </h3>
                                <p class="text-sm text-gray-600 mb-4">Silakan pilih salah satu bank rekanan kami untuk
                                    proses pembukaan rekening perusahaan anda.</p>

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="bank-options">
                                    <!-- Bank options will be populated by JavaScript based on location -->
                                </div>

                                <input type="hidden" name="selected_bank" id="selected_bank" value="">
                                <div class="error-message" id="selected_bank-error"></div>
                            </div>
                        </div>

                        <!-- Step 5: Upload Bukti Pembayaran -->
                        <div class="form-section hidden" data-step="5">
                            <h3 class="form-section-title">
                                <i class="fas fa-credit-card"></i>
                                Pembayaran & Upload Bukti
                            </h3>

                            <!-- Payment Summary -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                                <h4 class="text-lg font-semibold text-blue-900 mb-4">Ringkasan Pembayaran</h4>
                                <div id="payment-summary" class="text-blue-800 space-y-2">
                                    <!-- Summary will be filled by JavaScript -->
                                </div>
                            </div>

                            <!-- Payment Instructions -->
                            <div class="bg-amber-50 border border-amber-200 rounded-lg p-6 mb-6">
                                <h4 class="font-semibold text-amber-900 mb-3 flex items-center">
                                    <i class="fas fa-info-circle mr-2 text-amber-600"></i>
                                    Instruksi Pembayaran
                                </h4>
                                <ol class="text-sm text-amber-800 space-y-2 list-decimal list-inside">
                                    <li>Transfer biaya sesuai nominal di atas ke rekening yang telah ditentukan</li>
                                    <li>Simpan bukti transfer (screenshot atau cetak) sebagai bukti pembayaran</li>
                                    <li>Upload bukti pembayaran di bawah ini dalam format JPG, PNG, atau PDF</li>
                                    <li>Klik tombol "Ajukan Pendirian" untuk mengirimkan pengajuan Anda</li>
                                </ol>
                            </div>

                            <!-- Payment Proof Upload -->
                            <div class="form-group">
                                <label class="form-label required">Bukti Pembayaran</label>
                                <div class="payment-proof-container" id="payment-proof-container">
                                    <div class="mb-4">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">Klik untuk upload atau seret file ke sini</p>
                                    <p class="text-xs text-gray-500">Format: JPG, PNG, PDF (Maks. 5MB)</p>
                                    <input type="file" id="payment_proof" name="payment_proof" class="hidden"
                                        accept="image/*,.pdf">
                                    <button type="button" class="btn btn-primary mt-2" id="upload-payment-proof-btn">
                                        <i class="fas fa-upload mr-2"></i>Pilih File
                                    </button>
                                </div>

                                <div id="payment-proof-preview" class="mt-4 hidden">
                                    <div
                                        class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-check-circle text-green-500 text-2xl mr-3"></i>
                                            <div>
                                                <p class="font-medium text-gray-900" id="payment-proof-name">File berhasil
                                                    diupload</p>
                                                <p class="text-sm text-gray-500" id="payment-proof-size">0 KB</p>
                                            </div>
                                        </div>
                                        <button type="button" class="text-red-500 hover:text-red-700"
                                            id="remove-payment-proof">
                                            <i class="fas fa-times-circle text-xl"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="error-message" id="payment_proof-error"></div>
                            </div>

                            <!-- Submission Summary -->
                            <div class="info-box mt-6">
                                <i class="fas fa-list-check"></i>
                                <div>
                                    <h4 class="text-md font-medium mb-2">Ringkasan Pengajuan</h4>
                                    <div id="submission-summary" class="text-sm space-y-1">
                                        <!-- Ringkasan akan diisi oleh JavaScript -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Sukses Pengajuan -->
                        <div id="submission-success-modal" style="display: none;"
                            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                            <!-- ... (existing content) ... -->
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

                        <!-- Modal Konfirmasi Edit -->
                        <div id="confirm-edit-modal" style="display: none;"
                            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                            <div class="bg-white rounded-lg shadow-2xl p-8 max-w-md w-full mx-4">
                                <div class="text-center mb-6">
                                    <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-100 rounded-full mb-4">
                                        <i class="fas fa-exclamation-triangle text-3xl text-yellow-600"></i>
                                    </div>
                                </div>
                                <h2 class="text-2xl font-bold text-center text-gray-900 mb-2">Konfirmasi Perubahan</h2>
                                <p class="text-center text-gray-600 mb-6 leading-relaxed">
                                    Apakah Anda yakin ingin menyimpan perubahan pada data pengajuan <strong id="confirm-company-name"></strong> ini?
                                </p>
                                <div class="flex gap-4">
                                    <button type="button" id="cancel-edit-btn"
                                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-4 rounded-lg transition duration-200">
                                        Batal
                                    </button>
                                    <button type="button" id="confirm-edit-submit-btn"
                                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200">
                                        Ya, Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="progress-sticky-bar">
            <div class="progress-sticky-content">
                <button type="button" id="prev-step-btn" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </button>

                <div class="progress-indicator-sticky-container">
                    <div class="progress-indicator-sticky">
                        <div class="progress-step-sticky active" data-step="1">
                            <div class="progress-step-sticky-circle">1</div>
                            <div class="progress-step-sticky-label">Informasi</div>
                        </div>
                        <div class="progress-step-sticky" data-step="2">
                            <div class="progress-step-sticky-circle">2</div>
                            <div class="progress-step-sticky-label">Direktur</div>
                        </div>
                        <div class="progress-step-sticky" data-step="3">
                            <div class="progress-step-sticky-circle">3</div>
                            <div class="progress-step-sticky-label">Komisaris</div>
                        </div>
                        <div class="progress-step-sticky" data-step="4">
                            <div class="progress-step-sticky-circle">4</div>
                            <div class="progress-step-sticky-label">KBLI & Bank</div>
                        </div>
                        <div class="progress-step-sticky" data-step="5">
                            <div class="progress-step-sticky-circle">5</div>
                            <div class="progress-step-sticky-label">Pembayaran</div>
                        </div>
                    </div>
                </div>

                <button type="button" id="next-step-btn" class="btn btn-primary">
                    Lanjutkan
                    <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <!-- Select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $(document).ready(function () {
                // --- GLOBAL VARIABLES & CONFIGURATION ---
                const MAX_KBLI_FREE = 5;
                const COST_PER_EXCESS = 0;
                const AKTA_FEE = 15000;
                const NIB_FEE = 100000;
                let kbliDocOption = 'both';
                let selectedKBLIs = [];
                let kbliDetailsCache = {};
                let currentKBLIPage = 1;
                let lastKBLISearchQuery = '';
                let selectedBank = ''; // Will be set from editData if exists
                let searchSuggestions = [];
                let activeSuggestionIndex = -1;

                // Edit Mode Data
                const isEdit = {{ isset($pendirianCV) ? 'true' : 'false' }};
                const editData = @json($pendirianCV ?? null);
                if (isEdit && editData) {
                    // Pre-load selected KBLIs from database
                    try {
                            // editData.kbli_selected is already an array because of Model casting
                            selectedKBLIs = editData.kbli_selected || [];
                            // Save to localStorage so existing logic works (or just set variable)
                            localStorage.setItem('selectedKBLIs', JSON.stringify(selectedKBLIs));

                            // Set Bank
                            selectedBank = editData.selected_bank || '';
                            $('#selected_bank').val(selectedBank);

                            // Set KBLI Doc Option
                            if (editData.kbli_doc_option) {
                                kbliDocOption = editData.kbli_doc_option;
                                $('#kbli_doc_option').val(kbliDocOption);
                                 // Radio button check will be handled when updateFinancialSummary is called or we set it here
                                 // But updateFinancialSummary reads from global variables or inputs?
                                 // Let's set the radio manually too
                            }

                        } catch (e) {
                            console.error('Error parsing edit data:', e);
                        }
                    }

                    // --- INITIALIZATION ---
                    function initializeApp() {
                        // Load saved KBLI from localStorage
                        const savedKBLIs = localStorage.getItem('selectedKBLIs');
                        if (savedKBLIs) {
                            try {
                                selectedKBLIs = JSON.parse(savedKBLIs);
                                updateSelectedKBLIList();
                                updateFinancialSummary();
                            } catch (e) {
                                console.error('Error parsing saved KBLIs:', e);
                                localStorage.removeItem('selectedKBLIs'); // Clear corrupted data
                            }
                        }

                        // Setup initial form elements
                        initializePersonForms(); // Will now check editData
                        initializeLocationDropdowns();
                        initializePaymentProofUpload();

                        if (isEdit && editData && editData.payment_proof_path) {
                            const container = $('#payment-proof-container');
                            const preview = $('#payment-proof-preview');
                            const nameEl = $('#payment-proof-name');

                            nameEl.text('File tersimpan: ' + editData.payment_proof_path.split('/').pop());
                            $('#payment-proof-size').text('(File Lama)');
                            preview.removeClass('hidden');
                            container.addClass('has-file');

                            // Disable required on file input since we have one
                            // Check validation logic to allow empty file input if editing
                        }

                        // PERUBAHAN: JavaScript - Panggil fungsi untuk menyesuaikan lebar sticky bar
                        updateStickyBarWidth();

                        // Inisialisasi state awal
                        let currentStep = 1;
                        showStep(currentStep);
                        updateProgressIndicator(currentStep);
                        updateNavigationButtons(currentStep);

                        // Load initial KBLI data - ubah default ke 25 item
                        loadAllKBLIs(1, parseInt($('#kbli-per-page').val()));
                    }

                    // --- LOKASI DEPENDENT DROPDOWN ---
                    function initializeLocationDropdowns() {
                        const provinceSelect = $('#province');
                        const citySelect = $('#city');
                        const districtSelect = $('#district');
                        const villageSelect = $('#village');

                        // Fungsi untuk mengisi dropdown
                        const populateDropdown = (dropdown, data) => {
                            dropdown.empty().append('<option value="">-- Pilih --</option>');
                            if (data) {
                                $.each(data, function (key, value) {
                                    dropdown.append('<option value="' + key + '">' + value + '</option>');
                                });
                            }
                            // Don't trigger change here to avoid loop if we manage manually
                        };

                        // Fungsi untuk melakukan fetch data
                        const fetchData = (url, id, targetDropdown, siblingDropdowns, callback = null) => {
                            if (!id) {
                                targetDropdown.prop('disabled', true);
                                populateDropdown(targetDropdown, null);
                                siblingDropdowns.forEach(sibling => {
                                    sibling.prop('disabled', true);
                                    populateDropdown(sibling, null);
                                });
                                return;
                            }

                            $.ajax({
                                url: url,
                                type: 'GET',
                                data: {
                                    id: id
                                },
                                success: function (data) {
                                    console.log('Data fetched:', url, data);
                                    populateDropdown(targetDropdown, data);
                                    targetDropdown.prop('disabled', false);
                                    if (callback) callback();
                                },
                                error: function (xhr) {
                                    console.error('Error fetching location data:', xhr);
                                    showToast('Gagal memuat data lokasi. Silakan coba lagi.', 'error');
                                }
                            });
                        };

                        // Load data Provinsi saat halaman dimuat
                        $.ajax({
                            url: '{{ route("provinces") }}',
                            type: 'GET',
                            success: function (data) {
                                console.log('Provinces loaded:', data);
                                populateDropdown(provinceSelect, data);
                                provinceSelect.prop('disabled', false);

                                // Auto select province if edit mode
                                if (isEdit && editData && editData.province) {
                                    provinceSelect.val(editData.province).trigger('change');
                                }
                            },
                            error: function (xhr) {
                                console.error('Error loading provinces:', xhr);
                                showToast('Gagal memuat data provinsi. Silakan refresh halaman.', 'error');
                            }
                        });

                        // Event Listener untuk Provinsi
                        provinceSelect.on('change', function () {
                            const provinceId = $(this).val();
                            console.log('Province selected:', provinceId);
                            if (provinceId) {
                                fetchData('{{ route("cities") }}', provinceId, citySelect, [districtSelect,
                                    villageSelect
                                ], () => {
                                    // Auto select city
                                    if (isEdit && editData && editData.city && !citySelect.data('init')) {
                                        citySelect.val(editData.city).trigger('change');
                                        citySelect.data('init', true);
                                    }
                                });
                                updateBankOptions();
                            }
                        });

                        // Event Listener untuk Kota
                        citySelect.on('change', function () {
                            const cityId = $(this).val();
                            console.log('City selected:', cityId);
                            if (cityId) {
                                fetchData('{{ route("districts") }}', cityId, districtSelect, [villageSelect], () => {
                                    // Auto select district
                                    if (isEdit && editData && editData.district && !districtSelect.data('init')) {
                                        districtSelect.val(editData.district).trigger('change');
                                        districtSelect.data('init', true);
                                    }
                                });
                                updateBankOptions();
                            }
                        });

                        // Event Listener untuk Kecamatan
                        districtSelect.on('change', function () {
                            const districtId = $(this).val();
                            console.log('District selected:', districtId);
                            if (districtId) {
                                fetchData('{{ route("villages") }}', districtId, villageSelect, [], () => {
                                    // Auto select village
                                    if (isEdit && editData && editData.village && !villageSelect.data('init')) {
                                        villageSelect.val(editData.village); // No more children
                                        villageSelect.data('init', true);
                                    }
                                });
                            }
                        });
                    }

                    // --- PAYMENT PROOF UPLOAD ---
                    function initializePaymentProofUpload() {
                        const container = $('#payment-proof-container');
                        const input = $('#payment_proof');
                        const btn = $('#upload-payment-proof-btn');
                        const preview = $('#payment-proof-preview');
                        const removeBtn = $('#remove-payment-proof');
                        const nameEl = $('#payment-proof-name');
                        const sizeEl = $('#payment-proof-size');

                        // Direct click handler untuk tombol - paling penting
                        btn.on('click', function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            // Gunakan native JavaScript untuk memastikan file dialog terbuka
                            document.getElementById('payment_proof').click();
                            return false;
                        });

                        // Click pada container (bukan pada tombol atau elemen interaktif lainnya)
                        container.on('click', function (e) {
                            // Abaikan click jika target adalah tombol atau child dari tombol
                            const target = $(e.target);
                            if (target.closest('button').length === 0) {
                                input.click();
                            }
                        });

                        // Handle file selection
                        input.on('change', function () {
                            const file = this.files[0];
                            if (file) {
                                // Validate file size (5MB max)
                                if (file.size > 5 * 1024 * 1024) {
                                    $('#payment_proof-error').text('Ukuran file terlalu besar. Maksimal 5MB.')
                                        .show();
                                    input.val('');
                                    return;
                                }

                                // Validate file type
                                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
                                if (!allowedTypes.includes(file.type)) {
                                    $('#payment_proof-error').text(
                                        'Format file tidak didukung. Gunakan JPG, PNG, atau PDF.').show();
                                    input.val('');
                                    return;
                                }

                                // Display file info
                                nameEl.text(file.name);
                                sizeEl.text(formatFileSize(file.size));
                                preview.removeClass('hidden');
                                container.addClass('has-file');
                                $('#payment_proof-error').hide();
                            }
                        });

                        // Handle file removal
                        removeBtn.on('click', function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            input.val('');
                            preview.addClass('hidden');
                            container.removeClass('has-file');
                            return false;
                        });

                        // Drag and drop functionality
                        container.on('dragover', function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            $(this).addClass('border-blue-500 bg-blue-50');
                        });

                        container.on('dragleave', function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            $(this).removeClass('border-blue-500 bg-blue-50');
                        });

                        container.on('drop', function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            $(this).removeClass('border-blue-500 bg-blue-50');

                            const files = e.originalEvent.dataTransfer.files;
                            if (files.length > 0) {
                                input[0].files = files;
                                input.trigger('change');
                            }
                        });
                    }

                    function formatFileSize(bytes) {
                        if (bytes === 0) return '0 Bytes';
                        const k = 1024;
                        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                        const i = Math.floor(Math.log(bytes) / Math.log(k));
                        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                    }

                    // --- BANK PARTNER SELECTION ---
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
                            const isSelected = (bank === selectedBank) ? 'selected' : '';
                            const bankOption = $(`
                                        <div class="bank-option ${isSelected}" data-bank="${bank}">
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

                    // --- HELPER FUNCTIONS ---
                    function showToast(message, type = 'info') {
                        $('.toast').remove();
                        let icon = '';

                        if (type === 'success') {
                            icon = '<i class="fas fa-check-circle"></i>';
                        } else if (type === 'error') {
                            icon = '<i class="fas fa-exclamation-circle"></i>';
                        } else {
                            icon = '<i class="fas fa-info-circle"></i>';
                        }

                        const toast = $(`<div class="toast toast-${type}">${icon}<span>${message}</span></div>`);
                        $('body').append(toast);
                        setTimeout(() => toast.addClass('show'), 10);
                        setTimeout(() => {
                            toast.removeClass('show');
                            setTimeout(() => toast.remove(), 300);
                        }, 3000);
                    }

                    function escapeRegExp(string) {
                        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                    }

                    function highlightText(text, query) {
                        if (!query || query.length < 3) return text;
                        const escaped = escapeRegExp(query);
                        const regex = new RegExp('(' + escaped + ')', 'gi');
                        return text.replace(regex, '<span class="highlight">$1</span>');
                    }

                    // --- MULTI-STEP FORM LOGIC ---
                    function showStep(step) {
                        $('.form-section').addClass('hidden');
                        $(`.form-section[data-step="${step}"]`).removeClass('hidden');
                        if (step === 5) {
                            updateSubmissionSummary();
                            updatePaymentSummary();
                        }
                        if (step === 4) updateBankOptions();
                    }

                    function updateProgressIndicator(step) {
                        // Update progress bar di sticky
                        $('.progress-step-sticky').removeClass('active completed');
                        for (let i = 1; i < step; i++) {
                            $(`.progress-step-sticky[data-step="${i}"]`).addClass('completed');
                        }
                        $(`.progress-step-sticky[data-step="${step}"]`).addClass('active');
                    }

                    // --- UPDATE NAVIGATION BUTTONS ---
                    function updateNavigationButtons(step) {
                        const prevBtn = $('#prev-step-btn');
                        const nextBtn = $('#next-step-btn');

                        prevBtn.prop('disabled', step === 1);

                        // Step 5 adalah langkah pembayaran (langkah terakhir sebelum submit)
                        if (step === 5) {
                            // Ubah tombol menjadi tombol submit atau simpan
                            const btnText = isEdit ? 'Simpan Perubahan' : 'Ajukan Pendirian';
                            const btnIcon = isEdit ? 'fas fa-save' : 'fas fa-paper-plane';
                            
                            nextBtn.html(`<i class="${btnIcon} mr-2"></i>${btnText}`)
                                .attr('type', 'button') // Tetap 'button' agar tidak trigger 'submit' otomatis
                                .attr('form', 'pendirian-cv-form')
                                .off('click')
                                .on('click', function() {
                                    // Trigger submit event secara manual agar divalidasi oleh handler form.submit
                                    $('#pendirian-cv-form').trigger('submit');
                                });
                        } else {
                            // Logika normal untuk step 1, 2, 3, 4
                            nextBtn.html('Lanjutkan<i class="fas fa-arrow-right ml-2"></i>')
                                .attr('type', 'button')
                                .off('click')
                                .on('click', handleNext);
                        }
                    }



                    function handleNext() {
                        const currentStep = $('.progress-step-sticky.active').data('step');
                        if (validateStep(currentStep)) {
                            const nextStep = currentStep + 1;
                            showStep(nextStep);
                            updateProgressIndicator(nextStep);
                            updateNavigationButtons(nextStep);
                        }
                    }

                    function handlePrev() {
                        const currentStep = $('.progress-step-sticky.active').data('step');
                        const prevStep = currentStep - 1;
                        showStep(prevStep);
                        updateProgressIndicator(prevStep);
                        updateNavigationButtons(prevStep);
                    }

                    // Event Listener untuk tombol di sticky bar
                    $('#next-step-btn').on('click', handleNext);
                    $('#prev-step-btn').on('click', handlePrev);

                    function validateStep(step) {
                        let isValid = true;
                        $('.error-message').hide();
                        $('.form-input').removeClass('error');

                        if (step === 1) {
                            const namaPerusahaan = $('#nama_perusahaan').val().trim();
                            const province = $('#province').val();
                            const city = $('#city').val();
                            const district = $('#district').val();
                            const village = $('#village').val();
                            const alamatLengkap = $('#alamat_lengkap').val().trim();
                            const kodePos = $('#kode_pos').val().trim();

                            if (!namaPerusahaan || namaPerusahaan.split(/\s+/).length < 2) {
                                $('#nama_perusahaan-error').text('Nama perusahaan harus memiliki minimal 2 suku kata.')
                                    .show();
                                $('#nama_perusahaan').addClass('error');
                                isValid = false;
                            } else if (!province) {
                                $('#province-error').text('Silakan pilih provinsi.').show();
                                $('#province').addClass('error');
                                isValid = false;
                            } else if (!city) {
                                $('#city-error').text('Silakan pilih kota/kabupaten.').show();
                                $('#city').addClass('error');
                                isValid = false;
                            } else if (!district) {
                                $('#district-error').text('Silakan pilih kecamatan.').show();
                                $('#district').addClass('error');
                                isValid = false;
                            } else if (!village) {
                                $('#village-error').text('Silakan pilih desa/kelurahan.').show();
                                $('#village').addClass('error');
                                isValid = false;
                            } else if (!alamatLengkap) {
                                $('#alamat_lengkap-error').text('Silakan isi alamat lengkap perusahaan.').show();
                                $('#alamat_lengkap').addClass('error');
                                isValid = false;
                            } else if (!kodePos) {
                                $('#kode_pos-error').text('Silakan isi kode pos.').show();
                                $('#kode_pos').addClass('error');
                                isValid = false;
                            }
                        } else if (step === 2) {
                            // Validate director information
                            let hasValidDirector = false;
                            $('#direktur-container .person-entry').each(function () {
                                const nama = $(this).find('input[name*="[nama]"]').val().trim();
                                const ktp = $(this).find('input[name*="[ktp]"]').val();
                                const ktpRequired = $(this).find('input[name*="[ktp]"]').prop('required');

                                if (!nama) {
                                    $(this).find('input[name*="[nama]"]').addClass('error');
                                    isValid = false;
                                }

                                if (!ktp && ktpRequired) {
                                    $(this).find('input[name*="[ktp]"]').addClass('error');
                                    isValid = false;
                                }

                                if (nama && (ktp || !ktpRequired)) {
                                    hasValidDirector = true;
                                }
                            });

                            if (!hasValidDirector) {
                                showToast('Setidaknya satu direktur harus memiliki nama dan KTP yang valid.', 'error');
                                isValid = false;
                            }
                        } else if (step === 3) {
                            // Validate commissioner information
                            let hasValidCommissioner = false;
                            $('#komisaris-container .person-entry').each(function () {
                                const nama = $(this).find('input[name*="[nama]"]').val().trim();
                                const ktp = $(this).find('input[name*="[ktp]"]').val();
                                const ktpRequired = $(this).find('input[name*="[ktp]"]').prop('required');

                                if (!nama) {
                                    // If name is empty, we only validate if OTHER fields are filled or if it's the first one?
                                    // Actually logic was: if name present, KTP required. Or if it's required (but it's not required by HTML except name).
                                    // Original logic: if !nama -> error. 
                                    // Wait, komisaris name is optional in Store validation 'nullable|string'.
                                    // But in JS validation:
                                    /*
                                    if (!nama) { $(this).find('input[name*="[nama]"]').addClass('error'); isValid = false; }
                                    */
                                    // Ah, the original JS validation FORCES one komisaris or validates all fields if present.

                                    // Let's check original logic again.
                                    // It seems it iterates all entries. If any entry has missing name, it errors.
                                    // But Store validation says 'nullable'.
                                    // However, in the form we add empty entries. If user leaves it empty, should we error?
                                    // If it's the FIRST one (index 0), maybe we require it if we want at least one?
                                    // But `hasValidCommissioner` logic implies we want AT LEAST ONE valid commissioner.

                                    // Actually, if the field is optional, we shouldn't error on empty name unless we filled other fields?
                                    // Let's stick to original logic which seemed to enforce name.
                                    $(this).find('input[name*="[nama]"]').addClass('error');
                                    isValid = false;
                                }

                                if (!ktp && ktpRequired) {
                                    $(this).find('input[name*="[ktp]"]').addClass('error');
                                    isValid = false;
                                }

                                if (nama && (ktp || !ktpRequired)) {
                                    hasValidCommissioner = true;
                                }
                            });

                            if (!hasValidCommissioner) {
                                showToast('Setidaknya satu komisaris harus memiliki nama dan KTP yang valid.', 'error');
                                isValid = false;
                            }
                        } else if (step === 4) {
                            // Validate KBLI selection
                            if (selectedKBLIs.length === 0) {
                                showToast('Pilih setidaknya satu KBLI untuk melanjutkan.', 'error');
                                isValid = false;
                            }

                            // Validate document choices based on count
                            const kbliCount = selectedKBLIs.length;
                            if (kbliCount > MAX_KBLI_FREE) {
                                const opt = $('#kbli_doc_option').val();
                                if (!opt || (opt !== 'akta' && opt !== 'both')) {
                                    showToast('Silakan pilih opsi dokumen untuk kelebihan KBLI (Akta atau Akta + NIB).', 'error');
                                    isValid = false;
                                }
                            }

                            // Validate bank selection
                            if (!selectedBank) {
                                $('#selected_bank-error').text('Silakan pilih rekanan bank.').show();
                                isValid = false;
                            }
                        } else if (step === 5) {
                            // Validate payment proof
                            const paymentProof = $('#payment_proof').val();
                            const hasExisting = $('#payment-proof-container').hasClass('has-file');

                            if (!paymentProof && !hasExisting) {
                                $('#payment_proof-error').text('Silakan upload bukti pembayaran.').show();
                                showToast('Silakan upload bukti pembayaran untuk melanjutkan.', 'error');
                                isValid = false;
                            }
                        }

                        return isValid;
                    }



                    // --- PERSON FORM (DIREKTUR/KOMISARIS) LOGIC ---
                    function createPersonTemplate(type, index, data = null) {
                        const title = type.charAt(0).toUpperCase() + type.slice(1);
                        const namaValue = data ? data.nama : '';

                        let ktpPreviewHtml = '';
                        let ktpRequired = 'required';
                        let existingKtpInput = '';

                        if (data && data.ktp_path) {
                            ktpRequired = '';
                            const fileName = data.ktp_path.split('/').pop();
                            ktpPreviewHtml = `
                                    <div class="mt-2 p-2 bg-gray-100 rounded text-sm flex items-center">
                                        <i class="fas fa-file-alt mr-2 text-gray-500"></i>
                                        <span class="truncate flex-1">${fileName}</span>
                                        <a href="/storage/${data.ktp_path}" target="_blank" class="text-blue-600 hover:text-blue-800 ml-2 text-xs font-bold">LIHAT</a>
                                    </div>
                                `;
                            existingKtpInput = `<input type="hidden" name="${type}[${index}][existing_ktp]" value="${data.ktp_path}">`;
                        }

                        let npwpPreviewHtml = '';
                        let existingNpwpInput = '';
                        if (data && data.npwp_path) {
                            const fileName = data.npwp_path.split('/').pop();
                            npwpPreviewHtml = `
                                    <div class="mt-2 p-2 bg-gray-100 rounded text-sm flex items-center">
                                        <i class="fas fa-file-alt mr-2 text-gray-500"></i>
                                        <span class="truncate flex-1">${fileName}</span>
                                         <a href="/storage/${data.npwp_path}" target="_blank" class="text-blue-600 hover:text-blue-800 ml-2 text-xs font-bold">LIHAT</a>
                                    </div>
                                `;
                            existingNpwpInput = `<input type="hidden" name="${type}[${index}][existing_npwp]" value="${data.npwp_path}">`;
                        }

                        return `
                            <div class="person-entry" data-type="${type}" data-index="${index}">
                                <div class="person-entry-header">
                                    <h4 class="person-entry-title">
                                        <i class="fas fa-user"></i>
                                        ${title} #${index + 1}
                                    </h4>
                                    ${index > 0 ? `<button type="button" class="remove-person text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>` : ''}
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="${type}_${index}_nama" class="form-label required">Nama Lengkap</label>
                                        <input type="text" id="${type}_${index}_nama" name="${type}[${index}][nama]" class="form-input" required value="${namaValue}">
                                        <div class="error-message" id="${type}_${index}_nama-error"></div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="${type}_${index}_ktp" class="form-label ${ktpRequired ? 'required' : ''}">Upload KTP${ktpRequired ? '' : ' (Biarkan kosong jika tidak ubah)'}</label>
                                        <input type="file" id="${type}_${index}_ktp" name="${type}[${index}][ktp]" class="form-input" accept="image/*,.pdf" ${ktpRequired}>
                                        ${existingKtpInput}
                                        ${ktpPreviewHtml}
                                        <div class="mt-1 preview-container">
                                            <img src="" alt="KTP Preview" class="preview-image hidden">
                                            <button type="button" class="preview-remove hidden"><i class="fas fa-times"></i></button>
                                        </div>
                                        <div class="error-message" id="${type}_${index}_ktp-error"></div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="${type}_${index}_npwp" class="form-label">Upload NPWP (Opsional)</label>
                                        <input type="file" id="${type}_${index}_npwp" name="${type}[${index}][npwp]" class="form-input" accept="image/*,.pdf">
                                        ${existingNpwpInput}
                                        ${npwpPreviewHtml}
                                        <div class="mt-1 preview-container">
                                            <img src="" alt="NPWP Preview" class="preview-image hidden">
                                            <button type="button" class="preview-remove hidden"><i class="fas fa-times"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    }

                    function initializePersonForms() {
                        $('#direktur-container').empty();
                        let direkturData = (isEdit && editData.direktur_data) ? editData.direktur_data : [];
                        if (direkturData.length === 0) direkturData = [null];

                        direkturData.forEach((d, i) => {
                            $('#direktur-container').append(createPersonTemplate('direktur', i, d));
                        });

                        $('#komisaris-container').empty();
                        let komisarisData = (isEdit && editData.komisaris_data) ? editData.komisaris_data : [];
                        if (komisarisData.length === 0) komisarisData = [null];

                        komisarisData.forEach((d, i) => {
                            $('#komisaris-container').append(createPersonTemplate('komisaris', i, d));
                        });

                        setupPersonFormEvents();
                    }

                    function setupPersonFormEvents() {
                        $(document).on('click', '#add-direktur', function () {
                            const count = $('#direktur-container .person-entry').length;
                            $('#direktur-container').append(createPersonTemplate('direktur', count));
                        });

                        $(document).on('click', '#add-komisaris', function () {
                            const count = $('#komisaris-container .person-entry').length;
                            $('#komisaris-container').append(createPersonTemplate('komisaris', count));
                        });

                        $(document).on('click', '.remove-person', function () {
                            $(this).closest('.person-entry').remove();
                            updatePersonIndices('direktur');
                            updatePersonIndices('komisaris');
                        });

                        $(document).on('change', 'input[type="file"]', function () {
                            const file = this.files[0];
                            const previewContainer = $(this).siblings('.preview-container');
                            const previewImage = previewContainer.find('.preview-image');
                            const removeBtn = previewContainer.find('.preview-remove');

                            if (file && file.type.startsWith('image/')) {
                                const reader = new FileReader();
                                reader.onload = function (e) {
                                    previewImage.attr('src', e.target.result).removeClass('hidden');
                                    removeBtn.removeClass('hidden');
                                };
                                reader.readAsDataURL(file);
                            } else {
                                previewImage.addClass('hidden');
                                removeBtn.addClass('hidden');
                            }
                        });

                        $(document).on('click', '.preview-remove', function () {
                            const container = $(this).closest('.preview-container');
                            const input = container.siblings('input[type="file"]');
                            input.val('');
                            container.find('.preview-image, .preview-remove').addClass('hidden');
                        });
                    }

                    function updatePersonIndices(type) {
                        $(`#${type}-container .person-entry`).each(function (index) {
                            const $entry = $(this);
                            $entry.attr('data-index', index);
                            $entry.find('h4').html(
                                `<i class="fas fa-user"></i>${type.charAt(0).toUpperCase() + type.slice(1)} #${index + 1}`
                            );
                            $entry.find('input, label').each(function () {
                                const $el = $(this);
                                const name = $el.attr('name');
                                const forAttr = $el.attr('for');
                                if (name) $el.attr('name', name.replace(/\[\d+\]/, `[${index}]`));
                                if (forAttr) $el.attr('for', forAttr.replace(/_\d+/, `_${index}`));
                            });
                        });
                    }

                    // --- KBLI FUNCTIONALITY ---
                    function renderKBLIResults(items, query) {
                        const tbody = $('#kbli-results');
                        tbody.empty();
                        if (!items || items.length === 0) {
                            tbody.html(
                                `<tr><td colspan="4" class="py-4 text-center text-gray-500">Tidak ada hasil untuk "${query || 'semua data'}"</td></tr>`
                            );
                            return;
                        }
                        items.forEach(item => {
                            const kbli = item.kbli || '';
                            const judul = item.judul || '';
                            const uraian = item.uraian || '';

                            kbliDetailsCache[kbli] = {
                                kbli: kbli,
                                judul,
                                uraian
                            };
                            const isSelected = selectedKBLIs.some(k => k.kbli === kbli);
                            const btnLabel = isSelected ? 'Dipilih' : 'Pilih';
                            const btnDisabled = isSelected ? 'disabled' : '';
                            const btnClass = isSelected ? 'bg-gray-300 text-gray-700 cursor-not-allowed' :
                                'bg-blue-600 text-white hover:bg-blue-700';

                            const row = $(`
                                    <tr data-kbli="${kbli}">
                                        <td class="col-kode">${kbli}</td>
                                        <td class="col-judul kbli-detail-trigger cursor-pointer">${highlightText(judul, query)}</td>
                                        <td class="col-uraian">${highlightText(uraian, query)}</td>
                                        <td class="col-aksi">
                                            <button type="button" class="inline-flex items-center px-3 py-1 text-sm rounded ${btnClass} kbli-select-btn" data-kbli="${kbli}" ${btnDisabled}>${btnLabel}</button>
                                        </td>
                                    </tr>
                                `);
                            tbody.append(row);
                        });
                    }

                    function renderKBLIPagination(data) {
                        const paginationDiv = $('#kbli-pagination');
                        paginationDiv.empty();
                        if (!data || data.total <= data.per_page) return;

                        const createPageButton = (page, text, enabled) => {
                            const btnClass = enabled ?
                                'bg-white border border-gray-300 text-blue-600 hover:bg-blue-50' :
                                'bg-gray-100 text-gray-400 cursor-not-allowed';
                            return `<button type="button" class="px-3 py-1 mx-1 rounded-lg text-sm transition duration-150 kbli-page-btn ${btnClass}" data-page="${page}" ${!enabled ? 'disabled' : ''}>${text}</button>`;
                        };

                        paginationDiv.append(createPageButton(data.current_page - 1, 'Previous', data.current_page > 1));

                        const maxVisible = 7;
                        let start = Math.max(1, data.current_page - Math.floor(maxVisible / 2));
                        let end = Math.min(data.last_page, start + maxVisible - 1);
                        if (end - start < maxVisible - 1) start = Math.max(1, end - maxVisible + 1);

                        if (start > 1) {
                            paginationDiv.append(createPageButton(1, '1', true));
                            if (start > 2) paginationDiv.append($('<span class="px-2">...</span>'));
                        }
                        for (let i = start; i <= end; i++) {
                            const isActive = i === data.current_page;
                            const activeClass = isActive ? 'bg-blue-500 text-white' :
                                'bg-white border border-gray-300 text-blue-600 hover:bg-blue-50';
                            paginationDiv.append(
                                `<button type="button" class="px-3 py-1 mx-1 rounded-lg text-sm transition duration-150 kbli-page-btn ${activeClass}" data-page="${i}">${i}</button>`
                            );
                        }
                        if (end < data.last_page) {
                            if (end < data.last_page - 1) paginationDiv.append($('<span class="px-2">...</span>'));
                            paginationDiv.append(createPageButton(data.last_page, data.last_page, true));
                        }
                        paginationDiv.append(createPageButton(data.current_page + 1, 'Next', data.current_page < data
                            .last_page));
                    }

                    function updateKBLISummary(data) {
                        const summary = $('#kbli-search-summary');
                        if (data && data.data && data.data.length > 0) {
                            summary.text(`Menampilkan ${data.from} hingga ${data.to} dari ${data.total} hasil`);
                        } else {
                            summary.text('Menampilkan 0 hingga 0 dari 0 hasil');
                        }
                    }

                    function performKBLISearch(query, page = 1, perPage = 25) {
                        const tbody = $('#kbli-results');
                        tbody.html(
                            '<tr><td colspan="4" class="py-8 text-center"><span class="spinner-border spinner-border-sm mr-2"></span>Memuat data...</td></tr>'
                        );

                        // PERUBAHAN: Gunakan URL yang benar
                        const baseUrl = "/api/kbli/search";
                        const url = `${baseUrl}?query=${encodeURIComponent(query)}&page=${page}&per_page=${perPage}`;

                        $.ajax({
                            url: url,
                            method: 'GET',
                            success: function (data) {
                                console.log('KBLI data received:', data); // Debug: log data yang diterima
                                renderKBLIResults(data.data || [], query);
                                renderKBLIPagination(data);
                                updateKBLISummary(data);
                                lastKBLISearchQuery = query;
                            },
                            error: function (xhr) {
                                console.error('Error loading KBLI:', xhr);
                                console.log('Response text:', xhr.responseText); // Debug: log response text
                                tbody.html(
                                    `<tr><td colspan="4" class="py-4 text-center text-red-500">Gagal memuat data KBLI. Silakan coba lagi.</td></tr>`
                                );
                                $('#kbli-pagination').empty();
                                updateKBLISummary({
                                    data: []
                                });
                            }
                        });
                    }

                    function loadAllKBLIs(page = 1, perPage = 25) {
                        // PERUBAHAN: Kirim query kosong untuk mendapatkan semua data
                        performKBLISearch('', page, perPage);
                    }

                    // --- EVENT HANDLERS FOR KBLI ---
                    let searchTimeout;
                    $('#kbli-search-input').on('input', function () {
                        clearTimeout(searchTimeout);
                        const query = $(this).val().trim();
                        searchTimeout = setTimeout(() => {
                            currentKBLIPage = 1;
                            const perPage = parseInt($('#kbli-per-page').val());
                            if (query.length >= 3) {
                                performKBLISearch(query, 1, perPage);
                            } else {
                                // PERUBAHAN: Panggil loadAllKBLIs jika query kurang dari 3 karakter
                                loadAllKBLIs(1, perPage);
                            }
                        }, 400);
                    });

                    // Enhanced search with suggestions
                    $('#kbli-search-input').on('focus', function () {
                        const query = $(this).val().trim();
                        if (query.length >= 3) {
                            showSearchSuggestions(query);
                        }
                    });

                    $('#kbli-search-input').on('keydown', function (e) {
                        const suggestionsContainer = $('#kbli-search-suggestions');

                        if (e.key === 'ArrowDown') {
                            e.preventDefault();
                            activeSuggestionIndex = Math.min(activeSuggestionIndex + 1, searchSuggestions.length -
                                1);
                            updateActiveSuggestion();
                        } else if (e.key === 'ArrowUp') {
                            e.preventDefault();
                            activeSuggestionIndex = Math.max(activeSuggestionIndex - 1, 0);
                            updateActiveSuggestion();
                        } else if (e.key === 'Enter') {
                            e.preventDefault();
                            if (activeSuggestionIndex >= 0 && activeSuggestionIndex < searchSuggestions.length) {
                                $(this).val(searchSuggestions[activeSuggestionIndex]);
                                suggestionsContainer.hide();
                                performKBLISearch(searchSuggestions[activeSuggestionIndex], 1, parseInt($(
                                    '#kbli-per-page').val()));
                            } else {
                                const query = $(this).val().trim();
                                if (query.length >= 3) {
                                    performKBLISearch(query, 1, parseInt($('#kbli-per-page').val()));
                                }
                            }
                        } else if (e.key === 'Escape') {
                            suggestionsContainer.hide();
                        }
                    });

                    function showSearchSuggestions(query) {
                        // In a real implementation, you would fetch suggestions from the server
                        // For now, we'll use a mock implementation
                        searchSuggestions = [
                            query + ' suggestion 1',
                            query + ' suggestion 2',
                            query + ' suggestion 3'
                        ];

                        const suggestionsContainer = $('#kbli-search-suggestions');
                        suggestionsContainer.empty();

                        searchSuggestions.forEach((suggestion, index) => {
                            const suggestionElement = $(`<div class="search-suggestion">${suggestion}</div>`);
                            suggestionElement.on('click', function () {
                                $('#kbli-search-input').val(suggestion);
                                suggestionsContainer.hide();
                                performKBLISearch(suggestion, 1, parseInt($('#kbli-per-page').val()));
                            });
                            suggestionsContainer.append(suggestionElement);
                        });

                        suggestionsContainer.show();
                        activeSuggestionIndex = -1;
                    }

                    function updateActiveSuggestion() {
                        const suggestions = $('.search-suggestion');
                        suggestions.removeClass('active');

                        if (activeSuggestionIndex >= 0 && activeSuggestionIndex < suggestions.length) {
                            $(suggestions[activeSuggestionIndex]).addClass('active');
                        }
                    }

                    $(document).on('click', function (e) {
                        if (!$(e.target).closest('.search-container').length) {
                            $('#kbli-search-suggestions').hide();
                        }
                    });

                    $('#kbli-per-page').on('change', function () {
                        const perPage = parseInt($(this).val());
                        const query = $('#kbli-search-input').val().trim();
                        currentKBLIPage = 1;
                        if (query.length >= 3) {
                            performKBLISearch(query, 1, perPage);
                        } else {
                            loadAllKBLIs(1, perPage);
                        }
                    });

                    $(document).on('click', '.kbli-select-btn', function () {
                        const kbli = $(this).data('kbli');
                        if (!$(this).prop('disabled')) {
                            addKBLI(kbli);
                        }
                    });

                    $(document).on('click', '.kbli-detail-trigger', function () {
                        const kbli = $(this).closest('tr').data('kbli');
                        showKBLIDetailModal(kbli);
                    });

                    $(document).on('click', '.kbli-page-btn', function () {
                        const page = $(this).data('page');
                        if (page !== undefined && !$(this).prop('disabled')) {
                            currentKBLIPage = page;
                            const query = $('#kbli-search-input').val().trim();
                            const perPage = parseInt($('#kbli-per-page').val());
                            if (query.length >= 3) {
                                performKBLISearch(query, page, perPage);
                            } else {
                                loadAllKBLIs(page, perPage);
                            }
                        }
                    });

                    // --- KBLI SELECTION & REMOVAL ---
                    function addKBLI(kbli) {
                        if (!kbliDetailsCache[kbli] || selectedKBLIs.some(k => k.kbli === kbli)) return;
                        selectedKBLIs.push(kbliDetailsCache[kbli]);
                        updateSelectedKBLIList();
                        updateFinancialSummary();
                        $(`tr[data-kbli="${kbli}"] button.kbli-select-btn`).text('Dipilih').prop('disabled', true)
                            .removeClass('bg-blue-600 text-white hover:bg-blue-700').addClass(
                                'bg-gray-300 text-gray-700 cursor-not-allowed');
                        localStorage.setItem('selectedKBLIs', JSON.stringify(selectedKBLIs));
                    }

                    function removeKBLI(kbli) {
                        selectedKBLIs = selectedKBLIs.filter(k => k.kbli !== kbli);
                        updateSelectedKBLIList();
                        updateFinancialSummary();
                        $(`tr[data-kbli="${kbli}"] button.kbli-select-btn`).text('Pilih').prop('disabled', false)
                            .removeClass('bg-gray-300 text-gray-700 cursor-not-allowed').addClass(
                                'bg-blue-600 text-white hover:bg-blue-700');
                        // Jika jumlah sekarang kurang dari batas, aktifkan kembali tombol 'Pilih' yang belum dipilih
                        if (selectedKBLIs.length < MAX_KBLI_FREE) {
                            $('.kbli-select-btn').each(function () {
                                const btnKbli = $(this).data('kbli');
                                if (!selectedKBLIs.some(k => k.kbli === btnKbli)) {
                                    $(this).text('Pilih').prop('disabled', false)
                                        .removeClass('bg-gray-300 text-gray-700 cursor-not-allowed')
                                        .addClass('bg-blue-600 text-white hover:bg-blue-700');
                                }
                            });
                        }
                        localStorage.setItem('selectedKBLIs', JSON.stringify(selectedKBLIs));
                    }

                    function updateSelectedKBLIList() {
                        const tbody = $('#selected-kbli-body');
                        $('#selected-kbli-count').text(selectedKBLIs.length);

                        if (selectedKBLIs.length === 0) {
                            tbody.html(
                                `<tr><td colspan="5" class="py-4 text-center text-gray-500">Belum ada KBLI yang dipilih.</td></tr>`
                            );
                            return;
                        }

                        tbody.empty();
                        selectedKBLIs.forEach((kbli, index) => {
                            const row = $(`
                                    <tr>
                                        <td class="col-kode">${index + 1}</td>
                                        <td class="col-kode">${kbli.kbli}</td>
                                        <td class="col-judul">${kbli.judul}</td>
                                        <td class="col-uraian">${kbli.uraian}</td>
                                        <td class="col-aksi">
                                            <button type="button" class="text-red-600 hover:text-red-900 kbli-remove-btn" data-kbli="${kbli.kbli}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `);
                            tbody.append(row);
                        });
                        $('#kbli_selected').val(JSON.stringify(selectedKBLIs));
                    }

                    $(document).on('click', '.kbli-remove-btn', function () {
                        const kbli = $(this).data('kbli');
                        removeKBLI(kbli);
                    });

                    // Document option radio change
                    $(document).on('change', 'input[name="kbli_doc_option_radio"]', function () {
                        const val = $(this).val();
                        $('#kbli_doc_option').val(val);
                        kbliDocOption = val;
                        updateFinancialSummary();
                    });

                    // Update payment summary with cost details
                    function updatePaymentSummary() {
                        const paymentSummaryDiv = $('#payment-summary');
                        const kbliCount = selectedKBLIs.length;
                        const excessCount = Math.max(0, kbliCount - MAX_KBLI_FREE);

                        let summaryHTML = '';

                        if (kbliCount === 0) {
                            summaryHTML = '<p class="text-amber-600">⚠️ Tidak ada KBLI yang dipilih</p>';
                        } else if (kbliCount <= MAX_KBLI_FREE) {
                            summaryHTML = `
                                        <div class="flex justify-between items-center py-2 border-b border-blue-200">
                                            <span>Layanan Dasar (hingga ${MAX_KBLI_FREE} KBLI)</span>
                                            <strong>Rp0</strong>
                                        </div>
                                        <div class="mt-3 pt-3 border-t border-blue-200">
                                            <div class="flex justify-between items-center">
                                                <span class="font-semibold">Total Biaya Tambahan</span>
                                                <strong class="text-lg text-blue-900">Rp0</strong>
                                            </div>
                                        </div>
                                    `;
                        } else {
                            const docOption = $('#kbli_doc_option').val() || 'both';
                            let costPerUnit = 0;
                            let costDetails = '';

                            if (docOption === 'akta') {
                                costPerUnit = AKTA_FEE;
                                costDetails = `Akta untuk ${excessCount} KBLI`;
                            } else {
                                costPerUnit = AKTA_FEE + NIB_FEE;
                                costDetails = `Akta + NIB untuk ${excessCount} KBLI`;
                            }

                            const totalCharge = excessCount * costPerUnit;

                            summaryHTML = `
                                        <div class="flex justify-between items-center py-2 border-b border-blue-200">
                                            <span>Layanan Dasar (${MAX_KBLI_FREE} KBLI pertama)</span>
                                            <strong>Rp0</strong>
                                        </div>
                                        <div class="flex justify-between items-center py-2 border-b border-blue-200">
                                            <span>${costDetails}</span>
                                            <strong>Rp${totalCharge.toLocaleString('id-ID')}</strong>
                                        </div>
                                        <div class="mt-3 pt-3 border-t border-blue-200">
                                            <div class="flex justify-between items-center">
                                                <span class="font-semibold">Total Biaya Tambahan</span>
                                                <strong class="text-lg text-blue-900">Rp${totalCharge.toLocaleString('id-ID')}</strong>
                                            </div>
                                        </div>
                                    `;
                        }

                        paymentSummaryDiv.html(summaryHTML);
                    }

                    // Update submission summary to include doc costs
                    function updateSubmissionSummary() {
                        const namaPerusahaan = $('#nama_perusahaan').val();
                        const provinceText = $('#province option:selected').text();
                        const cityText = $('#city option:selected').text();
                        const direkturCount = $('#direktur-container .person-entry').length;
                        const komisarisCount = $('#komisaris-container .person-entry').length;
                        const kbliCount = selectedKBLIs.length;
                        const bankName = selectedBank || 'Belum dipilih';

                        let summaryHTML = `
                                <p><strong>Nama Perusahaan:</strong> ${namaPerusahaan}</p>
                                <p><strong>Lokasi:</strong> ${provinceText}, ${cityText}</p>
                                <p><strong>Jumlah Direktur:</strong> ${direkturCount}</p>
                                <p><strong>Jumlah Komisaris:</strong> ${komisarisCount}</p>
                                <p><strong>Jumlah KBLI:</strong> ${kbliCount}</p>
                                <p><strong>Rekanan Bank:</strong> ${bankName}</p>
                            `;

                        if (kbliCount > 0) {
                            const excessCount = Math.max(0, kbliCount - MAX_KBLI_FREE);

                            // First 5 KBLI are free (Rp0). Charges apply only when count > MAX_KBLI_FREE
                            if (kbliCount <= MAX_KBLI_FREE) {
                                // No additional charges
                                summaryHTML += `<p class="mt-2"><strong>Rincian Biaya:</strong> Rp0 (hingga ${MAX_KBLI_FREE} KBLI gratis)</p>`;
                                summaryHTML += `<p class="text-xl font-extrabold mt-2"><strong>Total Biaya Tambahan:</strong> Rp0</p>`;
                            } else {
                                const docOption = $('#kbli_doc_option').val() || 'both';
                                const perUnit = (docOption === 'akta') ? AKTA_FEE : (AKTA_FEE + NIB_FEE);
                                let parts = [];
                                if (docOption === 'akta') {
                                    parts.push(`Akta Rp${AKTA_FEE.toLocaleString('id-ID')}`);
                                } else {
                                    parts.push(`Akta Rp${AKTA_FEE.toLocaleString('id-ID')}`, `NIB Rp${NIB_FEE.toLocaleString('id-ID')}`);
                                }

                                const totalCharge = excessCount * perUnit;
                                summaryHTML += `<p class="mt-2"><strong>Rincian Biaya per Unit:</strong> ${parts.join(', ')}</p>`;
                                summaryHTML += `<p class="mt-1">Kelebihan: <strong>${excessCount} × Rp${perUnit.toLocaleString('id-ID')} = Rp${totalCharge.toLocaleString('id-ID')}</strong></p>`;
                                summaryHTML += `<p class="text-xl font-extrabold mt-2"><strong>Total Biaya Tambahan:</strong> Rp${totalCharge.toLocaleString('id-ID')}</p>`;
                            }
                        }
                        $('#submission-summary').html(summaryHTML);
                    }

                    function updateFinancialSummary() {
                        const count = selectedKBLIs.length;
                        const excessCount = Math.max(0, count - MAX_KBLI_FREE);
                        let includeAkta = false;
                        let includeNib = false;

                        if (count === 0) {
                            $('#kbli-doc-options').addClass('hidden');
                            $('#kbli_doc_option').val('');
                            $('#include_akta').val(0);
                            $('#include_nib').val(0);
                        } else if (count <= MAX_KBLI_FREE) {
                            // First 5 KBLI are free (Rp0)
                            $('#kbli-doc-options').addClass('hidden');
                            $('#kbli_doc_option').val('');
                            includeAkta = false;
                            includeNib = false;
                            $('#include_akta').val(0);
                            $('#include_nib').val(0);
                        } else {
                            // More than free limit: show options and apply charges
                            $('#kbli-doc-options').removeClass('hidden');
                            let opt = $('#kbli_doc_option').val();
                            if (!opt) {
                                opt = kbliDocOption || 'both';
                                $('#kbli_doc_option').val(opt);
                                $(`input[name="kbli_doc_option_radio"][value="${opt}"]`).prop('checked', true);
                            } else {
                                $(`input[name="kbli_doc_option_radio"][value="${opt}"]`).prop('checked', true);
                            }
                            kbliDocOption = opt;
                            includeAkta = true;
                            includeNib = (opt === 'both');
                            $('#include_akta').val(includeAkta ? 1 : 0);
                            $('#include_nib').val(includeNib ? 1 : 0);
                        }

                        const perUnit = (includeAkta ? AKTA_FEE : 0) + (includeNib ? NIB_FEE : 0);
                        const totalCharge = (count <= MAX_KBLI_FREE) ? 0 : (excessCount * perUnit);

                        $('#excess-kbli-count').text(`${excessCount} KBLI`);
                        let breakdownParts = [];
                        if (count > MAX_KBLI_FREE) {
                            if (includeAkta) breakdownParts.push(`Akta: Rp${AKTA_FEE.toLocaleString('id-ID')}`);
                            if (includeNib) breakdownParts.push(`NIB: Rp${NIB_FEE.toLocaleString('id-ID')}`);

                        }
                        $('#kbli-cost-breakdown').text(breakdownParts.join(', ') || '-');
                        $('#total-kbli-charge').text(`Rp${totalCharge.toLocaleString('id-ID')}`);

                        // Update payment summary jika sudah di step 5
                        if ($('.form-section[data-step="5"]').is(':not(.hidden)')) {
                            updatePaymentSummary();
                        }
                    }

                    function showKBLIDetailModal(kbli) {
                        if (!kbliDetailsCache[kbli]) return;
                        const kbliData = kbliDetailsCache[kbli];
                        if ($('#kbli-detail-modal').length === 0) {
                            $('body').append(`
                                    <div id="kbli-detail-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
                                        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white modal-content">
                                            <div class="mt-3">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900 text-center">Detail KBLI</h3>
                                                <div class="mt-2 px-7 py-3">
                                                    <p class="text-sm text-gray-700"><strong>Kode:</strong> <span id="modal-kode"></span></p>
                                                    <p class="text-sm text-gray-700 mt-2"><strong>Judul:</strong> <span id="modal-judul"></span></p>
                                                    <p class="text-sm text-gray-700 mt-2"><strong>Uraian:</strong></p>
                                                    <p class="text-sm text-gray-600 mt-1" id="modal-uraian"></p>
                                                </div>
                                                <div class="items-center px-4 py-3">
                                                    <button id="close-modal" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `);
                            $(document).on('click', '#close-modal, #kbli-detail-modal', function (e) {
                                if (e.target === this) $('#kbli-detail-modal').addClass('hidden');
                            });
                        }
                        $('#modal-kode').text(kbliData.kbli);
                        $('#modal-judul').text(kbliData.judul);
                        $('#modal-uraian').text(kbliData.uraian);
                        $('#kbli-detail-modal').removeClass('hidden');
                    }

                    // --- FINAL FORM SUBMISSION ---
                    function submitFormViaAjax() {
                        const submitBtn = $('#next-step-btn');
                        const originalText = submitBtn.html();
                        submitBtn.prop('disabled', true).html(
                            '<span class="spinner-border spinner-border-sm mr-2"></span> Mengirim...');

                        const form = document.getElementById('pendirian-cv-form');
                        const formData = new FormData(form);
                        
                        $.ajax({
                            url: $(form).attr('action'),
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                localStorage.removeItem('selectedKBLIs');
                                // Tampilkan modal sukses
                                $('#submission-success-modal').fadeIn(300);
                                $('#confirm-edit-modal').fadeOut(300);

                                // Set redirect URL di tombol "Lanjut"
                                $('#lanjut-btn').data('redirect', response.redirect || '/dashboard');
                            },
                            error: function (xhr) {
                                let errorMessage = 'Terjadi kesalahan saat mengirim formulir.';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                                    errorMessage = Object.values(xhr.responseJSON.errors).flat().join(
                                        '<br>');
                                }
                                showToast(errorMessage, 'error');
                                submitBtn.prop('disabled', false).html(originalText);
                                $('#confirm-edit-modal').fadeOut(300);
                            }
                        });
                    }

                    $('#pendirian-cv-form').on('submit', function (e) {
                        e.preventDefault();

                        // Validate all steps before submission
                        let allValid = true;
                        for (let i = 1; i <= 5; i++) {
                            if (!validateStep(i)) {
                                allValid = false;
                                showStep(i);
                                updateProgressIndicator(i);
                                updateNavigationButtons(i);
                                break;
                            }
                        }

                        if (!allValid) return;

                        if (isEdit) {
                            $('#confirm-company-name').text($('#nama_perusahaan').val());
                            $('#confirm-edit-modal').fadeIn(300);
                        } else {
                            submitFormViaAjax();
                        }
                    });

                    // Confirm and Cancel buttons for Edit Modal
                    $('#confirm-edit-submit-btn').on('click', function() {
                        submitFormViaAjax();
                    });

                    $('#cancel-edit-btn').on('click', function() {
                        $('#confirm-edit-modal').fadeOut(300);
                    });

                    // Handle tombol "Lanjut" di modal
                    $('#lanjut-btn').on('click', function () {
                        const redirectUrl = $(this).data('redirect') || '/dashboard';
                        window.location.href = redirectUrl;
                    });

                    // Update posisi sticky bar saat resize
                    function updateStickyBarWidth() {
                        const bar = $('.progress-sticky-bar');

                        // Tetap berada di tengah secara otomatis
                        bar.css({
                            left: '50%',
                            transform: 'translateX(-50%)'
                        });
                    }

                    // Jalankan saat load & saat resize
                    $(document).ready(updateStickyBarWidth);
                    $(window).resize(updateStickyBarWidth);


                    // Event listener untuk resize window (dengan debounce)
                    let resizeTimeout;
                    $(window).on('resize', function () {
                        clearTimeout(resizeTimeout);
                        resizeTimeout = setTimeout(function () {
                            updateStickyBarWidth();
                        }, 250); // Debounce selama 250ms untuk performa
                    });


                    // --- START THE APP ---
                    initializeApp();
                });
            </script>
@endsection