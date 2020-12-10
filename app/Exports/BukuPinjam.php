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

class BukuPinjam implements FromView
{
    use Exportable;
    
    public function view(): View
    {
        $datas =DB::table('peminjaman')
        ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
        ->select('buku.kode_buku','buku.judul_buku','buku.penulis','buku.penerbit','buku.tahun_terbit','buku.ISBN', DB::raw('count(*) as count'))
        ->groupBy('buku.kode_buku', 'buku.judul_buku','buku.penulis','buku.penerbit','buku.tahun_terbit','buku.ISBN')
        ->orderBy('count','DESC')
        ->get();

        return view('laporan.buku_excel_dipinjam', ['datas' => $datas
        
        ]);
    }
}
