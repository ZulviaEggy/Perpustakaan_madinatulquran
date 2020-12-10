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

class PeminjamanFilter implements FromView
{
    use Exportable;
    private $from,$to;

    public function __construct()
    {
        $this->transaction = new Peminjaman();
    }

    public function setDate($from,$to){
        $this->from = $from.' 00:00:00';
        $this->to = $to.' 23:59:59';
       
    }
    public function view(): View
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');
       
        $this->transaction =DB::table('peminjaman')
        ->whereIn('status_id',[3])
        ->join('status', 'status.id', '=', 'peminjaman.status_id')
        ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
        ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
        ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
        ->select('buku.judul_buku','siswa.NIS','guru.NIP','guru.nama_lengkap','siswa.nama_siswa','peminjaman.*', 'status.name','status.class')
        ->orderBy('created_at','ASC')
        ->whereBetween('peminjaman.created_at', [ $this->from, $this->to])
        ->get();
        return view('laporan.peminjaman.peminjaman_excel', ['peminjaman' => $this->transaction
        ]);
    }
}
