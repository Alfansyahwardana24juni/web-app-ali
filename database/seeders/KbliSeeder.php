<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\KbLi;

class KbLiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Catatan: File ini membaca data KBLI DALAM EXCEL.csv yang diunggah.
     * Data diproses untuk memastikan setiap kode KBLI 5 digit unik.
     */
    public function run(): void
    {
        // Path ke file CSV yang diunggah
        $csvFilePath = storage_path('app/KBLI DALAM EXCEL.csv');

        // Pastikan file CSV ada
        if (!file_exists($csvFilePath)) {
            // Jika file tidak ada, log pesan dan keluar.
            // Di lingkungan pengembangan, Anda mungkin perlu memindahkan file ke storage/app
            echo "Error: File CSV KBLI DALAM EXCEL.csv tidak ditemukan di " . $csvFilePath . "\n";
            return;
        }

        // Buka file CSV
        $file = fopen($csvFilePath, 'r');

        // Lewati baris header
        $header = fgetcsv($file, 0, ';'); // Delimiter: semicolon (;)

        $dataToInsert = [];
        $uniqueKBLIs = []; // Untuk menyimpan KBLI unik (kode 5 digit)

        while (($row = fgetcsv($file, 0, ';')) !== FALSE) {
            // Asumsi header: id;judul;uraian;id_resiko;kbli;id_ruang_lingkup;kd_skala_usaha;kd_resiko;sektor;...
            // Indeks kolom yang relevan:
            $kodeIndex = 4;      // 'kbli' (kode KBLI 5 digit)
            $judulIndex = 1;     // 'judul'
            $uraianIndex = 2;    // 'uraian'
            $resikoIndex = 7;    // 'kd_resiko'
            $sektorIndex = 8;    // 'sektor'

            // Ambil dan bersihkan data
            $kode = trim($row[$kodeIndex]);
            $judul = trim($row[$judulIndex]);
            $uraian = trim($row[$uraianIndex]);
            $kd_resiko = trim($row[$resikoIndex]);
            $sektor = trim($row[$sektorIndex]);

            // Filter agar hanya kode 5 digit yang valid yang diproses
            if (strlen($kode) === 5 && !empty($judul) && !isset($uniqueKBLIs[$kode])) {
                // Gunakan entri pertama untuk setiap kode 5 digit untuk memastikan keunikan
                $uniqueKBLIs[$kode] = true;

                $dataToInsert[] = [
                    'kode' => $kode,
                    'judul' => $judul,
                    'keterangan' => $uraian,
                    'kd_resiko' => $kd_resiko,
                    'sektor' => $sektor,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        fclose($file);

        // Hapus data lama untuk clean slate (opsional, tapi disarankan)
        KbLi::truncate();

        // Masukkan data KBLI dalam batch untuk efisiensi
        $chunkSize = 500;
        foreach (array_chunk($dataToInsert, $chunkSize) as $chunk) {
            DB::table('kblis')->insert($chunk);
        }

        echo "✅ Berhasil memasukkan " . count($dataToInsert) . " KBLI unik ke dalam database.\n";
    }
}