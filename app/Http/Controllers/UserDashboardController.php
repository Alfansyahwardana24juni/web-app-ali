<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        // Ambil data carousel yang aktif dari database
        $carousels = Carousel::active()->ordered()->get();

        // Tampilkan view dashboard.blade.php dengan data carousel
        return view('dashboard', compact('carousels'));
    }
}