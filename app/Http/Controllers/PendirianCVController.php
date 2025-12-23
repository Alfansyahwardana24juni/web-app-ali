<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendirianCV;

class PendirianCVController extends Controller
{
    // Menampilkan halaman info Pendirian CV
    public function index()
    {
        return view('pendirian.cv.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Data kota-kota di Indonesia (contoh, Anda bisa lengkapi 98 kota)
        // Data kota-kota di Indonesia (total 98 kota, diurutkan A–Z)
        $cities = [
            'Ambon',
            'Banda Aceh',
            'Bandar Lampung',
            'Bandung',
            'Banjarmasin',
            'Baubau',
            'Bekasi',
            'Bengkulu',
            'Bitung',
            'Blitar',
            'Bogor',
            'Bojonegoro',
            'Bontang',
            'Bone',
            'Bulukumba',
            'Cianjur',
            'Cibinong (Kab. Bogor)',
            'Cikarang',
            'Cilegon',
            'Cimahi',
            'Cirebon',
            'Denpasar',
            'Depok',
            'Enrekang',
            'Garut',
            'Gorontalo',
            'Gowa',
            'Indramayu',
            'Jakarta',
            'Jayapura',
            'Jember',
            'Karawang',
            'Kediri',
            'Kendari',
            'Kupang',
            'Langsa',
            'Lembang',
            'Lhokseumawe',
            'Lubuklinggau',
            'Luwuk',
            'Magelang',
            'Majalengka',
            'Majene',
            'Makassar',
            'Malang',
            'Manado',
            'Manokwari',
            'Maros',
            'Mataram',
            'Medan',
            'Merauke',
            'Mojokerto',
            'Padang',
            'Palangkaraya',
            'Palembang',
            'Palopo',
            'Palu',
            'Pamekasan',
            'Pangkal Pinang',
            'Parepare',
            'Pasuruan',
            'Pati',
            'Pekalongan',
            'Pekanbaru',
            'Pinrang',
            'Polewali Mandar',
            'Pontianak',
            'Probolinggo',
            'Purwakarta',
            'Purwokerto',
            'Salatiga',
            'Samarinda',
            'Semarang',
            'Serang',
            'Sidrap',
            'Sidoarjo',
            'Sleman',
            'Solo (Surakarta)',
            'Sorong',
            'Soppeng',
            'Subang',
            'Sukabumi',
            'Sumedang',
            'Surabaya',
            'Tangerang',
            'Tangerang Selatan',
            'Tanjung Pinang',
            'Tasikmalaya',
            'Tegal',
            'Ternate',
            'Tidore',
            'Tolitoli',
            'Tomohon',
            'Tual',
            'Wajo',
            'Yogyakarta'
        ];

        sort($cities); // Urutkan secara alfabet

        return view('pendirian.cv.form', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_perusahaan' => 'required|string|min:5',
            'province' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'village' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'kode_pos' => 'required|string',
            'direktur.nama.*' => 'required|string',
            'direktur.ktp.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'direktur.npwp.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'komisaris.nama.*' => 'nullable|string',
            'komisaris.ktp.*' => 'required_with:komisaris.nama.*|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'komisaris.npwp.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kbli_selected' => 'required|array',
            'selected_bank' => 'nullable|string',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Proses upload file direktur
        $direkturData = [];
        if ($request->has('direktur.nama')) {
            foreach ($request->input('direktur.nama') as $key => $nama) {
                $ktpPath = $request->file('direktur.ktp')[$key]->store('ktp_direktur', 'public');
                $npwpPath = $request->hasFile('direktur.npwp.' . $key)
                    ? $request->file('direktur.npwp')[$key]->store('npwp_direktur', 'public')
                    : null;

                $direkturData[] = [
                    'nama' => $nama,
                    'ktp_path' => $ktpPath,
                    'npwp_path' => $npwpPath,
                ];
            }
        }

        // Proses upload file komisaris
        $komisarisData = [];
        if ($request->has('komisaris.nama')) {
            foreach ($request->input('komisaris.nama') as $key => $nama) {
                if (!is_null($nama)) {
                    $ktpPath = $request->file('komisaris.ktp')[$key]->store('ktp_komisaris', 'public');
                    $npwpPath = $request->hasFile('komisaris.npwp.' . $key)
                        ? $request->file('komisaris.npwp')[$key]->store('npwp_komisaris', 'public')
                        : null;

                    $komisarisData[] = [
                        'nama' => $nama,
                        'ktp_path' => $ktpPath,
                        'npwp_path' => $npwpPath,
                    ];
                }
            }
        }

        // Proses upload bukti pembayaran
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        // Simpan data ke database
        PendirianCV::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'province' => $request->province,
            'city' => $request->city,
            'district' => $request->district,
            'village' => $request->village,
            'alamat_lengkap' => $request->alamat_lengkap,
            'kode_pos' => $request->kode_pos,
            'direktur_data' => $direkturData, // Casted to array/json by model
            'komisaris_data' => $komisarisData, // Casted to array/json by model
            'kbli_selected' => $request->kbli_selected, // Casted to array/json by model
            'selected_bank' => $request->selected_bank,
            'payment_proof_path' => $paymentProofPath,
            'status' => 'pending',
        ]);

        return redirect()->route('pendirian.cv.form')->with('success', 'Data pendirian CV berhasil disimpan!');
    }
}