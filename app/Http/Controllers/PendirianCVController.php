<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Laravolt\Indonesia\Facade as Indonesia;
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
            'direktur.*.nama' => 'required|string',
            'direktur.*.ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'direktur.*.npwp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'komisaris.*.nama' => 'nullable|string',
            'komisaris.*.ktp' => 'required_with:komisaris.*.nama|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'komisaris.*.npwp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kbli_selected' => 'required|string', // Terima string JSON
            'kbli_doc_option' => 'nullable|string',
            'selected_bank' => 'nullable|string',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Proses upload file direktur
        $direkturData = [];
        $direkturInput = $request->input('direktur') ?? [];

        foreach ($direkturInput as $key => $data) {
            // Validation ensures 'nama' exists for required fields, but good to be safe
            if (empty($data['nama']))
                continue;

            $ktpPath = null;
            if ($request->hasFile("direktur.$key.ktp")) {
                $ktpPath = $request->file("direktur.$key.ktp")->store('ktp_direktur', 'public');
            }

            $npwpPath = null;
            if ($request->hasFile("direktur.$key.npwp")) {
                $npwpPath = $request->file("direktur.$key.npwp")->store('npwp_direktur', 'public');
            }

            $jabatan = count($direkturData) === 0 ? 'Direktur Utama' : 'Direktur';

            $direkturData[] = [
                'nama' => $data['nama'],
                'jabatan' => $jabatan,
                'ktp_path' => $ktpPath,
                'npwp_path' => $npwpPath,
            ];
        }

        // Proses upload file komisaris
        $komisarisData = [];
        $komisarisInput = $request->input('komisaris') ?? [];

        foreach ($komisarisInput as $key => $data) {
            if (empty($data['nama']))
                continue;

            $ktpPath = null;
            if ($request->hasFile("komisaris.$key.ktp")) {
                $ktpPath = $request->file("komisaris.$key.ktp")->store('ktp_komisaris', 'public');
            }

            $npwpPath = null;
            if ($request->hasFile("komisaris.$key.npwp")) {
                $npwpPath = $request->file("komisaris.$key.npwp")->store('npwp_komisaris', 'public');
            }

            $jabatan = count($komisarisData) === 0 ? 'Komisaris Utama' : 'Komisaris';

            $komisarisData[] = [
                'nama' => $data['nama'],
                'jabatan' => $jabatan,
                'ktp_path' => $ktpPath,
                'npwp_path' => $npwpPath,
            ];
        }

        // Proses upload bukti pembayaran
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        // Simpan data ke database
        $pendirianCV = PendirianCV::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'province' => $request->province,
            'city' => $request->city,
            'district' => $request->district,
            'village' => $request->village,
            'alamat_lengkap' => $request->alamat_lengkap,
            'kode_pos' => $request->kode_pos,
            'direktur_data' => $direkturData,
            'komisaris_data' => $komisarisData,
            'kbli_selected' => json_decode($request->kbli_selected, true),
            'kbli_doc_option' => $request->kbli_doc_option,
            'selected_bank' => $request->selected_bank,
            'payment_proof_path' => $paymentProofPath,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data pendirian CV berhasil disimpan!',
            'redirect' => route('pendirian.cv.processing')
        ]);
    }

    /**
     * Tampilkan halaman pengajuan sedang diproses
     */
    public function processing()
    {
        // Ambil data pengajuan CV yang statusnya pending atau processing
        $pendirianCVs = PendirianCV::whereIn('status', ['pending', 'processing'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pendirian.cv.processing', compact('pendirianCVs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pendirianCV = PendirianCV::findOrFail($id);

        // Data kota-kota di Indonesia (sama dengan di create)
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

        sort($cities);

        return view('pendirian.cv.form', compact('cities', 'pendirianCV'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pendirianCV = PendirianCV::findOrFail($id);

        // Validasi input
        $request->validate([
            'nama_perusahaan' => 'required|string|min:5',
            'province' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'village' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'kode_pos' => 'required|string',
            'direktur.*.nama' => 'required|string',
            'direktur.*.ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Nullable on update
            'direktur.*.npwp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'komisaris.*.nama' => 'nullable|string',
            'komisaris.*.ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Nullable on update
            'komisaris.*.npwp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kbli_selected' => 'required|string', // Terima string JSON
            'kbli_doc_option' => 'nullable|string',
            'selected_bank' => 'nullable|string',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Proses upload file direktur
        $direkturData = [];
        // Use existing data fallback or handle new structure
        $existingDirekturData = $pendirianCV->direktur_data ?? [];

        if ($request->has('direktur')) {
            foreach ($request->input('direktur') as $key => $data) {
                if (!isset($data['nama']))
                    continue;

                // Attempt to find existing data match by key or handle re-ordering (using key is risky but acceptable per user context)
                // Better approach: look for existing ID if we had one, but we used array key.
                // Fallback: look at index in existing array.
                $existingKtp = $existingDirekturData[$key]['ktp_path'] ?? null;
                $existingNpwp = $existingDirekturData[$key]['npwp_path'] ?? null;

                $ktpPath = $existingKtp;
                if ($request->hasFile("direktur.$key.ktp")) {
                    $ktpPath = $request->file("direktur.$key.ktp")->store('ktp_direktur', 'public');
                }

                $npwpPath = $existingNpwp;
                if ($request->hasFile("direktur.$key.npwp")) {
                    $npwpPath = $request->file("direktur.$key.npwp")->store('npwp_direktur', 'public');
                }

                $jabatan = count($direkturData) === 0 ? 'Direktur Utama' : 'Direktur';

                $direkturData[] = [
                    'nama' => $data['nama'],
                    'jabatan' => $jabatan,
                    'ktp_path' => $ktpPath,
                    'npwp_path' => $npwpPath,
                ];
            }
        }

        // Proses upload file komisaris
        $komisarisData = [];
        $existingKomisarisData = $pendirianCV->komisaris_data ?? [];

        if ($request->has('komisaris')) {
            foreach ($request->input('komisaris') as $key => $data) {
                if (empty($data['nama']))
                    continue;

                $existingKtp = $existingKomisarisData[$key]['ktp_path'] ?? null;
                $existingNpwp = $existingKomisarisData[$key]['npwp_path'] ?? null;

                $ktpPath = $existingKtp;
                if ($request->hasFile("komisaris.$key.ktp")) {
                    $ktpPath = $request->file("komisaris.$key.ktp")->store('ktp_komisaris', 'public');
                }

                $npwpPath = $existingNpwp;
                if ($request->hasFile("komisaris.$key.npwp")) {
                    $npwpPath = $request->file("komisaris.$key.npwp")->store('npwp_komisaris', 'public');
                }

                $jabatan = count($komisarisData) === 0 ? 'Komisaris Utama' : 'Komisaris';

                $komisarisData[] = [
                    'nama' => $data['nama'],
                    'jabatan' => $jabatan,
                    'ktp_path' => $ktpPath,
                    'npwp_path' => $npwpPath,
                ];
            }
        }

        // Proses upload bukti pembayaran
        $paymentProofPath = $pendirianCV->payment_proof_path;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        // Update data ke database
        $pendirianCV->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'province' => $request->province,
            'city' => $request->city,
            'district' => $request->district,
            'village' => $request->village,
            'alamat_lengkap' => $request->alamat_lengkap,
            'kode_pos' => $request->kode_pos,
            'direktur_data' => $direkturData,
            'komisaris_data' => $komisarisData,
            'kbli_selected' => json_decode($request->kbli_selected, true),
            'kbli_doc_option' => $request->kbli_doc_option,
            'selected_bank' => $request->selected_bank,
            'payment_proof_path' => $paymentProofPath,
            // Status usually stays same or resets to specific status on edit? Keeping it same or processing.
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data pendirian CV berhasil diperbarui!',
            'redirect' => route('pendirian.cv.processing')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pendirian = PendirianCV::findOrFail($id);

        // Fetch location names using Laravolt Indonesia
        // We use try-catch or null coalescing in case ID is invalid or not found
        try {
            $provinceName = $pendirian->province ? (Indonesia::findProvince($pendirian->province)->name ?? $pendirian->province) : '-';
        } catch (\Exception $e) {
            $provinceName = $pendirian->province;
        }

        try {
            $cityName = $pendirian->city ? (Indonesia::findCity($pendirian->city)->name ?? $pendirian->city) : '-';
        } catch (\Exception $e) {
            $cityName = $pendirian->city;
        }

        try {
            $districtName = $pendirian->district ? (Indonesia::findDistrict($pendirian->district)->name ?? $pendirian->district) : '-';
        } catch (\Exception $e) {
            $districtName = $pendirian->district;
        }

        try {
            $villageName = $pendirian->village ? (Indonesia::findVillage($pendirian->village)->name ?? $pendirian->village) : '-';
        } catch (\Exception $e) {
            $villageName = $pendirian->village;
        } // villages might be integers or strings depending on version

        return view('pendirian.cv.show', compact('pendirian', 'provinceName', 'cityName', 'districtName', 'villageName'));
    }
}