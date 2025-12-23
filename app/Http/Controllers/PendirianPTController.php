<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendirianPTController extends Controller
{
    public function index()
    {
        return view('pendirian.pt.index');
    }

    public function create()
    {
        $cities = [
            'Ambon', 'Banda Aceh', 'Bandar Lampung', 'Bandung', 'Banjarmasin', 'Baubau', 'Bekasi', 'Bengkulu',
            'Bitung', 'Blitar', 'Bogor', 'Bojonegoro', 'Bontang', 'Bone', 'Bulukumba', 'Cianjur',
            'Cibinong (Kab. Bogor)', 'Cikarang', 'Cilegon', 'Cimahi', 'Cirebon', 'Denpasar', 'Depok', 'Enrekang',
            'Garut', 'Gorontalo', 'Gowa', 'Indramayu', 'Jakarta', 'Jayapura', 'Jember', 'Karawang', 'Kediri',
            'Kendari', 'Kupang', 'Langsa', 'Lembang', 'Lhokseumawe', 'Lubuklinggau', 'Luwuk', 'Magelang',
            'Majalengka', 'Majene', 'Makassar', 'Malang', 'Manado', 'Manokwari', 'Maros', 'Mataram', 'Medan',
            'Merauke', 'Mojokerto', 'Padang', 'Palangkaraya', 'Palembang', 'Palopo', 'Palu', 'Pamekasan',
            'Pangkal Pinang', 'Parepare', 'Pasuruan', 'Pati', 'Pekalongan', 'Pekanbaru', 'Pinrang',
            'Polewali Mandar', 'Pontianak', 'Probolinggo', 'Purwakarta', 'Purwokerto', 'Salatiga', 'Samarinda',
            'Semarang', 'Serang', 'Sidrap', 'Sidoarjo', 'Sleman', 'Solo (Surakarta)', 'Sorong', 'Soppeng',
            'Subang', 'Sukabumi', 'Sumedang', 'Surabaya', 'Tangerang', 'Tangerang Selatan', 'Tanjung Pinang',
            'Tasikmalaya', 'Tegal', 'Ternate', 'Tidore', 'Tolitoli', 'Tomohon', 'Tual', 'Wajo', 'Yogyakarta'
        ];

        sort($cities);

        return view('pendirian.pt.form', compact('cities'));
    }

    public function store(Request $request)
    {
        return redirect()->route('pendirian.pt.form')->with('success', 'Form PT dikirim (draft)');
    }
}

