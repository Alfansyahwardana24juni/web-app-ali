<?php

namespace App\Http\Controllers;

use App\Models\Kbli;
use Illuminate\Http\Request;

class KbliController extends Controller
{
    /**
     * Tampilkan halaman form pendirian PT
     */
    public function index()
    {
        // Load awal (misalnya 25 data pertama)
        $kblis = Kbli::orderBy('KODE')->paginate(25);

        return view('pendirian.pt.form', compact('kblis'));
    }

    /**
     * Endpoint untuk pencarian KBLI (AJAX)
     * Supports query (string) and per_page (int) parameters and returns
     * paginated results with fields: kbli, judul, uraian
     */
    public function search(Request $request)
    {
        $search = $request->input('query', '');
        $perPage = (int) $request->input('per_page', 25);

        $kbliQuery = Kbli::query();

        if (!empty($search)) {
            $kbliQuery->where('KODE', 'like', $search . '%')
                ->orWhere('JUDUL', 'like', '%' . $search . '%')
                ->orWhere('URAIAN', 'like', '%' . $search . '%');
        }

        $results = $kbliQuery
            ->select('KODE as kbli', 'JUDUL as judul', 'URAIAN as uraian')
            ->orderBy('KODE')
            ->paginate($perPage);

        return response()->json($results);
    }
}
