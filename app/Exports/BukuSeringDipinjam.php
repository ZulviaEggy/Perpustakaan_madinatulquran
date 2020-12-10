<?php

namespace App\Exports;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Status;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;
use Carbon\Carbon;

class BukuSeringDipinjam implements FromView
{
    use Exportable;
    private $from,$to;

    public function __construct()
    {
        $this->datas = new Peminjaman();
    }

    public function setDate($from,$to){
        $this->from = $from.' 00:00:00';
        $this->to = $to.' 23:59:59';
       
    }
    public function view(): View
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');
       
        $this->datas =DB::table('peminjaman')
        ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
        ->select('buku.kode_buku','buku.judul_buku','buku.penulis','buku.penerbit','buku.tahun_terbit','buku.ISBN', DB::raw('count(*) as count'))
        ->groupBy('buku.kode_buku', 'buku.judul_buku','buku.penulis','buku.penerbit','buku.tahun_terbit','buku.ISBN')
        ->orderBy('count','DESC')
        ->whereBetween('peminjaman.tanggal_peminjaman', [ $this->from, $this->to])
        ->get();

        return view('laporan.buku_excel_dipinjam', ['datas' => $this->datas
        ]);
    }
}
