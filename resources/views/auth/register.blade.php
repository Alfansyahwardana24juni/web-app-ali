@extends('layouts.app')

@section('title', 'Pendaftaran')

@section('content')
@push('styles')
<!-- Menggunakan Font dari Google Fonts untuk tipografi profesional -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap"
    rel="stylesheet">
<style>
:root {
    --color-primary: #0F172A;
    --color-primary-light: #1E293B;
    --color-accent: #F59E0B;
    --color-accent-hover: #D97706;
    --color-text-primary: #334155;
    --color-text-secondary: #64748B;
    --color-border: #E2E8F0;
    --color-background: #F8FAFC;
    --font-body: 'Roboto', sans-serif;
    --font-heading: 'Roboto', sans-serif;
}

body {
    font-family: var(--font-body);
    background: var(--color-background);
}

.register-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
}

.register-card {
    display: flex;
    width: 100%;
    max-width: 1200px;
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(15, 23, 42, 0.1);
}

/* Panel Kiri: Brand & Benefits */
.brand-panel {
    flex: 1;
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    padding: 4rem 3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.brand-panel::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(245, 158, 11, 0.1) 0%, transparent 70%);
    animation: pulse 15s ease-in-out infinite;
}

@keyframes pulse {

    0%,
    100% {
        transform: scale(1) rotate(0deg);
    }

    50% {
        transform: scale(1.1) rotate(180deg);
    }
}

.brand-content {
    position: relative;
    z-index: 1;
}

.logo-container {
    background: white;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2.5rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease;
}

.logo-container:hover {
    transform: scale(1.05);
}

.logo-text {
    font-size: 3rem;
    font-weight: 700;
    color: var(--color-primary);
    font-family: var(--font-heading);
    line-height: 1;
}

.logo-subtext {
    font-size: 0.75rem;
    color: var(--color-text-secondary);
    font-weight: 500;
    margin-top: 0.25rem;
}

.welcome-title {
    font-family: var(--font-heading);
    font-size: 2.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.welcome-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 2rem;
}

.login-link-box {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 2.5rem;
    border: 2px solid var(--color-accent);
    border-radius: 50px;
    color: white;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    background: transparent;
}

.login-link-box:hover {
    background: var(--color-accent);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
}

.benefits-list {
    margin-top: 3rem;
    text-align: left;
}

.benefit-item {
    display: flex;
    align-items: start;
    color: rgba(255, 255, 255, 0.85);
    margin-bottom: 1.25rem;
    font-size: 0.95rem;
}

.benefit-icon {
    width: 24px;
    height: 24px;
    background: var(--color-accent);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.75rem;
    flex-shrink: 0;
    margin-top: 0.125rem;
}

.benefit-icon svg {
    width: 14px;
    height: 14px;
    color: white;
}

.benefit-text {
    flex: 1;
}

.benefit-title {
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: white;
}

.benefit-desc {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.75);
}

/* Panel Kanan: Form Register */
.form-panel {
    flex: 1.2;
    padding: 4rem 3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    max-height: 100vh;
    overflow-y: auto;
}

.form-header {
    margin-bottom: 2rem;
}

.back-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--color-text-secondary);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 1.5rem;
    transition: color 0.2s ease;
}

.back-button:hover {
    color: var(--color-primary);
}

.back-button svg {
    width: 18px;
    height: 18px;
}

.form-title {
    font-family: var(--font-heading);
    font-size: 2rem;
    font-weight: 700;
    color: var(--color-primary);
    margin-bottom: 0.5rem;
}

.form-subtitle {
    color: var(--color-text-secondary);
    font-size: 0.95rem;
}

.alert {
    padding: 1rem;
    border-radius: 10px;
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
}

.alert-error {
    background: #FEE2E2;
    border: 1px solid #FCA5A5;
    color: #991B1B;
}

.alert-error ul {
    margin: 0;
    padding-left: 1.25rem;
}

.form-group {
    margin-bottom: 1.25rem;
}

.form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--color-text-primary);
    margin-bottom: 0.5rem;
}

.required {
    color: #EF4444;
}

.form-input {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid var(--color-border);
    border-radius: 10px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    font-family: var(--font-body);
}

.form-input:focus {
    outline: none;
    border-color: var(--color-accent);
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
}

.form-input.error {
    border-color: #EF4444;
}

.input-wrapper {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--color-text-secondary);
    cursor: pointer;
    padding: 0.25rem;
    transition: color 0.2s ease;
}

.toggle-password:hover {
    color: var(--color-text-primary);
}

.toggle-password svg {
    width: 20px;
    height: 20px;
}

.input-hint {
    font-size: 0.75rem;
    color: var(--color-text-secondary);
    margin-top: 0.375rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.btn-primary {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, var(--color-accent) 0%, var(--color-accent-hover) 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: var(--font-body);
    margin-top: 0.5rem;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
}

.btn-primary:active {
    transform: translateY(0);
}

.footer-text {
    text-align: center;
    color: var(--color-text-secondary);
    font-size: 0.75rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--color-border);
}

/* Chat Button */
.chat-button {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    border: none;
    border-radius: 50%;
    color: white;
    cursor: pointer;
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
    transition: all 0.3s ease;
    z-index: 1000;
}

.chat-button:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
}

.chat-button svg {
    width: 28px;
    height: 28px;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 968px) {
    .register-card {
        flex-direction: column;
        max-width: 600px;
    }

    .brand-panel {
        padding: 3rem 2rem;
        min-height: auto;
    }

    .welcome-title {
        font-size: 2rem;
    }

    .benefits-list {
        display: none;
    }

    .form-panel {
        padding: 3rem 2rem;
        max-height: none;
    }

    .logo-container {
        width: 120px;
        height: 120px;
        margin-bottom: 2rem;
    }

    .logo-text {
        font-size: 2.5rem;
    }
}

@media (max-width: 640px) {
    .register-container {
        padding: 1rem;
    }

    .brand-panel {
        padding: 2rem 1.5rem;
    }

    .form-panel {
        padding: 2rem 1.5rem;
    }

    .welcome-title {
        font-size: 1.75rem;
    }

    .welcome-subtitle {
        font-size: 1rem;
    }

    .form-title {
        font-size: 1.75rem;
    }

    .chat-button {
        width: 50px;
        height: 50px;
        bottom: 1.5rem;
        right: 1.5rem;
    }

    .chat-button svg {
        width: 24px;
        height: 24px;
    }
}

/* Custom Scrollbar for Form Panel */
.form-panel::-webkit-scrollbar {
    width: 6px;
}

.form-panel::-webkit-scrollbar-track {
    background: var(--color-background);
}

.form-panel::-webkit-scrollbar-thumb {
    background: var(--color-border);
    border-radius: 3px;
}

.form-panel::-webkit-scrollbar-thumb:hover {
    background: var(--color-text-secondary);
}
</style>

<div class="register-container">
    <div class="register-card">
        <!-- Panel Kiri: Brand & Benefits -->
        <div class="brand-panel">
            <!-- Background Image & Gradient Overlay -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('img/Ba-Ali.jpg') }}" alt="Brand Ambassador PT Akses Legal Indonesia"
                    class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-br from-slate-900/80 via-slate-900/60 to-slate-900/80">
                </div>
            </div>
            <div class="brand-content">
                <div class="logo-container">
                    <img src="{{ asset('img/LogoAliBiruPanjang.png') }}" alt="Logo Akses Legal Indonesia">

                </div>

                <h1 class="welcome-title">Bergabunglah Bersama Kami</h1>
                <p class="welcome-subtitle">
                    Buat akun Anda sekarang dan nikmati kemudahan dalam mengurus legalitas bisnis Anda secara online.
                </p>

                <a href="{{ route('user.login') }}" class="login-link-box">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 18px; height: 18px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Sudah Punya Akun?
                </a>

                <div class="benefits-list">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="benefit-text">
                            <div class="benefit-title">Proses Cepat & Efisien</div>
                            <div class="benefit-desc">Pendaftaran PT, CV, Yayasan dalam hitungan hari</div>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="benefit-text">
                            <div class="benefit-title">Konsultan Hukum Berpengalaman</div>
                            <div class="benefit-desc">Didampingi oleh tim profesional bersertifikat</div>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="benefit-text">
                            <div class="benefit-title">Harga Transparan</div>
                            <div class="benefit-desc">Tidak ada biaya tersembunyi, semua jelas</div>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="benefit-text">
                            <div class="benefit-title">Aman & Terpercaya</div>
                            <div class="benefit-desc">Data Anda dilindungi dengan sistem keamanan terbaik</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Kanan: Form Register -->
        <div class="form-panel">
            <div class="form-header">
                <a href="{{ route('user.login') }}" class="back-button">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Login
                </a>
                <h2 class="form-title">Buat Akun Baru</h2>
                <p class="form-subtitle">Lengkapi data diri Anda untuk memulai</p>
            </div>

            @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('user.register.post') }}">
                @csrf

                <!-- Nama -->
                <div class="form-group">
                    <label for="name" class="form-label">
                        <span class="required">*</span> Nama Lengkap
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="form-input @error('name') error @enderror" placeholder="Masukkan nama lengkap Anda"
                        required>
                </div>

                <!-- Email & No Telepon -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <span class="required">*</span> Email
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="form-input @error('email') error @enderror" placeholder="nama@email.com" required>
                    </div>

                    <div class="form-group">
                        <label for="no_telepon" class="form-label">
                            <span class="required">*</span> No Telepon
                        </label>
                        <input type="tel" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}"
                            class="form-input @error('no_telepon') error @enderror" placeholder="08xxxxxxxxxx" required>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="form-group">
                    <label for="alamat" class="form-label">
                        <span class="required">*</span> Alamat Lengkap
                    </label>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}"
                        class="form-input @error('alamat') error @enderror" placeholder="Jalan, Kota, Provinsi"
                        required>
                </div>

                <!-- Password & Konfirmasi Password -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <span class="required">*</span> Password
                        </label>
                        <div class="input-wrapper">
                            <input type="password" name="password" id="password"
                                class="form-input @error('password') error @enderror" placeholder="Minimal 8 karakter"
                                required minlength="8">
                            <button type="button" onclick="togglePassword('password')" class="toggle-password">
                                <svg id="eye-icon-password" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <p class="input-hint">Minimal 8 karakter</p>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">
                            <span class="required">*</span> Ulangi Password
                        </label>
                        <div class="input-wrapper">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-input" placeholder="Ketik ulang password" required minlength="8">
                            <button type="button" onclick="togglePassword('password_confirmation')"
                                class="toggle-password">
                                <svg id="eye-icon-password_confirmation" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-primary">
                    Daftar Sekarang
                </button>
            </form>

            <!-- Footer -->
            <p class="footer-text">
                © 2021 PT Akses Legal Indonesia - All Right Reserved.
            </p>
        </div>
    </div>
</div>

<!-- Chat Button -->
<button class="chat-button" onclick="alert('Fitur chat akan segera tersedia!')">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
    </svg>
</button>

<script>
function togglePassword(fieldId) {
    const passwordInput = document.getElementById(fieldId);
    const eyeIcon = document.getElementById('eye-icon-' + fieldId);

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML =
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
    } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML =
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
    }
}

// Validasi password match
document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');

    if (passwordConfirmation) {
        passwordConfirmation.addEventListener('input', function() {
            if (this.value !== password.value) {
                this.setCustomValidity('Password tidak cocok');
            } else {
                this.setCustomValidity('');
            }
        });

        password.addEventListener('input', function() {
            if (passwordConfirmation.value !== '') {
                if (passwordConfirmation.value !== this.value) {
                    passwordConfirmation.setCustomValidity('Password tidak cocok');
                } else {
                    passwordConfirmation.setCustomValidity('');
                }
            }
        });
    }
});
</script>
@endsection