<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';

    protected $guarded = [];

    /**
     * Fungsi untuk generate kode transaksi otomatis
     * Hasil: TRS0001, TRS0002, dst.
     */
    public static function getKodeTransaksi()
    {
        // Query untuk mengambil kode transaksi tertinggi, default ke TRS0000 jika tabel kosong
        $sql = "SELECT IFNULL(MAX(kode_transaksi), 'TRS0000') as kode_transaksi 
                FROM transaksi";
        $kodetransaksi = \Illuminate\Support\Facades\DB::select($sql);

        // Ambil hasil dari query
        $kd = 'TRS0000'; // Nilai default awal
        foreach ($kodetransaksi as $kdtr) {
            $kd = $kdtr->kode_transaksi;
        }

        // Mengambil 4 digit terakhir (angka)
        $noawal = substr($kd, -4);
        
        // Menambahkan 1 ke angka tersebut
        $noakhir = (int)$noawal + 1; 

        // Gabungkan kembali: TRS + Angka yang sudah diberi padding nol di kiri (4 digit)
        $noakhir = 'TRS' . str_pad($noakhir, 4, "0", STR_PAD_LEFT); 
        
        return $noakhir;
    }

    /**
     * Mutator: Otomatis membersihkan titik pada total sebelum simpan ke DB
     * Contoh: Input "5.000" menjadi 5000 di database
     */
    public function setTotalAttribute($value)
    {
        // Hapus semua karakter non-digit (Rp, titik, koma, dsb) agar tersimpan sebagai angka bersih
        $this->attributes['total'] = preg_replace('/[^0-9]/', '', (string) $value);
    }
}
