<?php

namespace App\Exports;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Status;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use DB;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class TransaksiKeterlambatan implements FromView
{
    use Exportable;
    
    public function view(): View
    {
        $peminjaman = Peminjaman::query()
        ->join('status', 'status.id', '=', 'peminjaman.status_id')
        ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
        ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
        ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
        ->select('buku.judul_buku','siswa.NIS','guru.NIP','guru.nama_lengkap','siswa.nama_siswa','peminjaman.*', 'status.name','status.class')
        ->where('peminjaman.tanggal_harus_kembali', '<', Carbon::now()->format('Y-m-d'))
        ->get();

        return view('laporan.transaksiKeterlambatan', ['peminjaman' => $peminjaman
        
        ]);
    }
}
