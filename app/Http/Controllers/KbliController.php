<?php

namespace App\Http\Controllers;

use App\Models\Kbli; // Perbaikan: gunakan nama model yang konsisten
use Illuminate\Http\Request;

class KbLiController extends Controller
{
    /**
     * Endpoint API untuk pencarian KBLI berdasarkan kolom:
     * - kbli (kode)
     * - judul
     * - uraian
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 25);

        // Query pencarian sesuai struktur tabel di phpMyAdmin
        $kbliQuery = Kbli::query();

        // Jika query kosong atau 'all', tampilkan semua data
        if (empty($query) || $query === 'all') {
            // Tidak perlu filter, ambil semua data
        } else if (strlen($query) >= 2) {
            // Filter berdasarkan query
            $kbliQuery->where(function ($q) use ($query) {
                $q->where('kbli', 'like', $query . '%')
                    ->orWhere('judul', 'like', '%' . $query . '%')
                    ->orWhere('uraian', 'like', '%' . $query . '%');
            });
        } else {
            // Jika query terlalu pendek, kembalikan array kosong
            return response()->json([
                'data' => [],
                'current_page' => 1,
                'last_page' => 1,
                'per_page' => $perPage,
                'total' => 0,
                'from' => 0,
                'to' => 0,
            ]);
        }

        // Dapatkan hasil dengan pagination
        $results = $kbliQuery->select('kbli', 'judul', 'uraian', 'id_resiko', 'kd_resiko')
            ->orderBy('kbli', 'asc')
            ->paginate($perPage);

        return response()->json($results);
    }
}