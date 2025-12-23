<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Hanya cek untuk user yang sudah login
        if (Auth::check()) {
            // Timeout dalam detik (20 menit = 1200 detik)
            $timeout = config('session.lifetime') * 60;

            // Ambil waktu last activity dari session
            $lastActivity = session('last_activity_time');

            if ($lastActivity) {
                // Hitung selisih waktu dalam detik
                $inactiveTime = time() - $lastActivity;

                // Jika sudah melebihi timeout, logout user
                if ($inactiveTime > $timeout) {
                    Auth::logout();

                    // Hapus semua session data
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    // PENTING: Return redirect langsung tanpa next()
                    return redirect()->route('user.login')
                        ->with('session_expired', 'Sesi Anda telah berakhir karena tidak aktif. Silakan login kembali.');
                }
            } else {
                // Set initial last activity jika belum ada
                session(['last_activity_time' => time()]);
            }

            // Update last activity time setiap request
            session(['last_activity_time' => time()]);
        }

        return $next($request);
    }
}