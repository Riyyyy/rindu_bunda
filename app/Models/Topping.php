<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Import DB untuk menjalankan query manual (Auto Numbering)
use Illuminate\Support\Facades\DB;

class Topping extends Model
{
    use HasFactory;

    // Mendefinisikan kolom primary key khusus (karena bukan `id`)
    protected $primaryKey = 'id_topping';

    // Mendefinisikan nama tabel secara spesifik
    protected $table = 'topping';

    // Mengizinkan semua kolom diisi (Mass Assignment)
    protected $guarded = [];

    /**
     * Fungsi untuk generate kode topping otomatis
     * Hasil: TP001, TP002, dst.
     */
    public static function getKodeTopping()
    {
        // Query untuk mengambil kode topping tertinggi, default ke TP000 jika tabel kosong
        $sql = "SELECT IFNULL(MAX(kode_topping), 'TPG0000') as kode_topping 
                FROM topping";
        $kodetopping = DB::select($sql);

        // Ambil hasil dari query
        $kd = 'TP000'; // Nilai default awal
        foreach ($kodetopping as $kdtp) {
            $kd = $kdtp->kode_topping;
        }

        // Mengambil 4 digit terakhir (angka)
        $noawal = substr($kd, -4);
        
        // Menambahkan 1 ke angka tersebut
        $noakhir = (int)$noawal + 1; 

        // Gabungkan kembali: TPG + Angka yang sudah diberi padding nol di kiri (4 digit)
        $noakhir = 'TPG' . str_pad($noakhir, 4, "0", STR_PAD_LEFT); 
        
        return $noakhir;
    }

    /**
     * Mutator: Otomatis membersihkan titik pada harga sebelum simpan ke DB
     * Contoh: Input "5.000" menjadi 5000 di database
     */
    public function setHargaToppingAttribute($value)
    {
        // Hapus semua karakter non-digit (Rp, titik, koma, dsb) agar tersimpan sebagai angka bersih
        $this->attributes['harga_topping'] = preg_replace('/[^0-9]/', '', (string) $value);
    }
}