@extends('layouts.app')

@section('title', 'Masuk - Portal Klien PT Akses Legal Indonesia')
@section('content')
@push('styles')
<!-- Menggunakan Font dari Google Fonts untuk tipografi profesional -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap"
    rel="stylesheet">
<style>
/* Definisi Variabel CSS untuk Konsistensi Tema */
:root {
    --color-primary: #0F172A;
    /* Navy Blue - Otoritas, Profesionalisme */
    --color-primary-light: #1E293B;
    --color-accent: #F59E0B;
    /* Amber - Kepercayaan, Premium, Sukses */
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

.login-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
}

.login-card {
    display: flex;
    width: 100%;
    max-width: 1100px;
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(15, 23, 42, 0.1);
}

/* Panel Kiri: Brand & Welcome */
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

.signup-link-box {
    display: inline-block;
    padding: 0.875rem 2.5rem;
    border: 2px solid var(--color-accent);
    border-radius: 50px;
    color: white;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    background: transparent;
}

.signup-link-box:hover {
    background: var(--color-accent);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
}

.features-list {
    margin-top: 3rem;
    text-align: left;
}

.feature-item {
    display: flex;
    align-items: center;
    color: rgba(255, 255, 255, 0.85);
    margin-bottom: 1rem;
    font-size: 0.95rem;
}

.feature-icon {
    width: 24px;
    height: 24px;
    background: var(--color-accent);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.75rem;
    flex-shrink: 0;
}

.feature-icon svg {
    width: 14px;
    height: 14px;
    color: white;
}

/* Panel Kanan: Form Login */
.form-panel {
    flex: 1;
    padding: 4rem 3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.form-header {
    margin-bottom: 2.5rem;
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

.alert-success {
    background: #D1FAE5;
    border: 1px solid #6EE7B7;
    color: #065F46;
}

.alert-error {
    background: #FEE2E2;
    border: 1px solid #FCA5A5;
    color: #991B1B;
}

.form-group {
    margin-bottom: 1.5rem;
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

.checkbox-wrapper {
    display: flex;
    align-items: center;
    margin-bottom: 2rem;
}

.checkbox-input {
    width: 18px;
    height: 18px;
    border: 2px solid var(--color-border);
    border-radius: 4px;
    cursor: pointer;
    accent-color: var(--color-accent);
}

.checkbox-label {
    margin-left: 0.5rem;
    font-size: 0.9rem;
    color: var(--color-text-secondary);
    cursor: pointer;
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
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
}

.btn-primary:active {
    transform: translateY(0);
}

.divider {
    text-align: center;
    margin: 1.5rem 0;
    position: relative;
}

.divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: var(--color-border);
}

.divider-text {
    position: relative;
    display: inline-block;
    padding: 0 1rem;
    background: white;
    color: var(--color-text-secondary);
    font-size: 0.875rem;
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
@media (max-width: 968px) {
    .login-card {
        flex-direction: column;
        max-width: 500px;
    }

    .brand-panel {
        padding: 3rem 2rem;
        min-height: auto;
    }

    .welcome-title {
        font-size: 2rem;
    }

    .features-list {
        display: none;
    }

    .form-panel {
        padding: 3rem 2rem;
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
    .login-container {
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
</style>

<div class="login-container">
    <div class="login-card">
        <!-- Panel Kiri: Brand & Welcome -->
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

                <h1 class="welcome-title">Halo, Selamat Datang!</h1>
                <p class="welcome-subtitle">
                    Daftarkan diri Anda dan mulai gunakan layanan legal kami untuk membuat PT, CV, Yayasan, dan
                    legalitas bisnis lainnya.
                </p>

                <a href="{{ route('user.register') }}" class="signup-link-box">
                    Daftar Sekarang
                </a>

                <div class="features-list">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span>Proses Cepat & Mudah</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span>Konsultasi Hukum Profesional</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span>Harga Transparan & Terjangkau</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span>Terpercaya & Aman</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Kanan: Form Login -->
        <div class="form-panel">
            <div class="form-header">
                <h2 class="form-title">Masuk</h2>
                <p class="form-subtitle">Masukkan email dan password Anda untuk melanjutkan</p>
            </div>
            @if(session('session_expired'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                {{ session('session_expired') }}
            </div>
            @endif
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('user.login.post') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        <span class="required">*</span> Email
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="form-input @error('email') error @enderror" placeholder="nama@email.com" required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">
                        <span class="required">*</span> Password
                    </label>
                    <div class="input-wrapper">
                        <input type="password" name="password" id="password"
                            class="form-input @error('password') error @enderror" placeholder="Masukkan password Anda"
                            required minlength="8">
                        <button type="button" onclick="togglePassword()" class="toggle-password">
                            <svg id="eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="checkbox-wrapper">
                    <input type="checkbox" name="remember" id="remember" class="checkbox-input">
                    <label for="remember" class="checkbox-label">Ingat saya</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-primary">
                    Masuk
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
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');

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
</script>
@endsection