<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Status;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use DB;
use Excel;
use PDF;
use App\Exports\BukuExport;
use App\Exports\BukuExportKosong;
use App\Exports\BukuSeringDipinjam;
use App\Exports\BukuPinjam;
use App\Exports\TransaksiExport;
use App\Exports\TransaksiKeterlambatan;
use App\Exports\TransaksiPeminjamanExport;
use App\Exports\PeminjamanFilter;
use App\Exports\PerpanjanganFilter;
use App\Exports\PengembalianFilter;
use App\Exports\TransaksiFilter;
use App\Exports\BukuFilter;
use App\Exports\TransaksiPerpanjanganExport;
use App\Exports\TransaksiPengembalianExport;
use RealRashid\SweetAlert\Facades\Alert;


class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function buku()
    {   $datas = Buku::all();
        return view('laporan.buku', ['datas' => $datas]);
    }
    public function transaksiPerpus()
    {   $datas = Buku::all();
        return view('laporan.transaksi_pinjam', ['datas' => $datas]);
    }

    public function bukuPdf()
    {
        $datas = Buku::all();
        $pdf = PDF::loadView('laporan.buku_pdf', compact('datas'))->setPaper('a4','landscape');
        // alert()->success('Berhasil.','Data telah dieksport!');
        return $pdf->download('laporan_buku_'.date('Y-m-d_H-i-s').'.pdf');
    }

    public function bukuKosong()
    {
        $datas = Buku::where('jumlah', '=', 0)->get();
        $pdf = PDF::loadView('laporan.buku_pdf', compact('datas'))->setPaper('a4','landscape');
        // alert()->success('Berhasil.','Data telah dieksport!');
        return $pdf->download('laporan_buku_'.date('Y-m-d_H-i-s').'.pdf');
    }

    public function bukuDipinjam()
    {
        
    $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
    $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

    //JIKA USER MELAKUKAN FILTER MANUAL, MAKA PARAMETER DATE AKAN TERISI
    if (request()->date != '') {
        //MAKA FORMATTING TANGGALNYA BERDASARKAN FILTER USER
        $date = explode(' - ' ,request()->date);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
    }
        $datas  = DB::table('peminjaman')
        ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
        ->select('buku.kode_buku','buku.judul_buku','buku.penulis','buku.penerbit','buku.tahun_terbit','buku.ISBN', DB::raw('count(*) as count'))
        ->groupBy('buku.kode_buku', 'buku.judul_buku','buku.penulis','buku.penerbit','buku.tahun_terbit','buku.ISBN')
        ->orderBy('count','DESC')
        ->whereBetween('tanggal_peminjaman', [$start, $end])
        ->get();

        return view('laporan.laporan_buku_pinjam', compact('datas'));
     
    }
    public function bukuPinjamTanggal($daterange)
{

    $date = explode('+', $daterange); //EXPLODE TANGGALNYA UNTUK MEMISAHKAN START & END
    //DEFINISIKAN VARIABLENYA DENGAN FORMAT TIMESTAMPS
    $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
    $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

    //KEMUDIAN BUAT QUERY BERDASARKAN RANGE CREATED_AT YANG TELAH DITETAPKAN RANGENYA DARI $START KE $END
    
    $datas  = DB::table('peminjaman')
    ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
    ->select('buku.kode_buku','buku.judul_buku','buku.penulis','buku.penerbit','buku.tahun_terbit','buku.ISBN', DB::raw('count(*) as count'))
    ->groupBy('buku.kode_buku', 'buku.judul_buku','buku.penulis','buku.penerbit','buku.tahun_terbit','buku.ISBN')
    ->orderBy('count','DESC')
    ->whereBetween('peminjaman.tanggal_peminjaman', [$start, $end])
    ->get();

    //BUAT QUERY KE DB MENGGUNAKAN WHEREBETWEEN DARI TANGGAL FILTER
    $pdf = PDF::loadView('laporan.laporan_buku_pinjam', compact('datas', 'date'))->setPaper('a4','landscape');
    //GENERATE PDF-NYA
    return $pdf->stream();
}


    public function barcodePdf($id)
    {
        $book = Buku::find($id);
        $pdf = PDF::loadView('laporan.barcode_pdf', compact('book'))->setPaper('a4','portrait');
        return $pdf->download('barcode_'.date('Y-m-d_H-i-s').'.pdf');
    }

    public function bukuExcel(Request $request)
    {
        $nama = 'laporan_buku_'.date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
        $excel->sheet('Laporan Data Buku', function ($sheet) use ($request) {
        $sheet->mergeCells('A1:H1');

       // $sheet->setAllBorders('thin');
        $sheet->row(1, function ($row) {
            $row->setFontFamily('Calibri');
            $row->setFontSize(11);
            $row->setAlignment('center');
            $row->setFontWeight('bold');
        });

        $sheet->row(1, array('LAPORAN DATA BUKU'));

        $sheet->row(2, function ($row) {
            $row->setFontFamily('Calibri');
            $row->setFontSize(11);
            $row->setFontWeight('bold');
        });

        $datas = Buku::all();

       // $sheet->appendRow(array_keys($datas[0]));
        $sheet->row($sheet->getHighestRow(), function ($row) {
            $row->setFontWeight('bold');
        });

         $datasheet = array();
         $datasheet[0]  =   array("NO", "KODE BUKU", "JUDUL", "PENULIS", "PENERBIT",  "KATEGORI","RAK","TAHUN TERBIT","ISBN","JUMLAH");
         $i=1;

        foreach ($datas as $data) {

           // $sheet->appendrow($data);
          $datasheet[$i] = array($i,
                        $data['id'],
                        $data['kode_buku'],
                        $data['judul_buku'],
                        $data['kategori_id'],
                        $data['tahun_terbit'],
                        $data['edisi'],
                        $data['penulis'],
                        $data['penerbit'],
                        $data['ISBN'],
                        $data['jumlah']
                    );
          
          $i++;
        }

        $sheet->fromArray($datasheet);
    });

})->export('xlsx');

}
function export()
{
    $nama = 'laporan_buku_'.date('Y-m-d_H-i-s').'.xlsx';
    return Excel::download(new BukuExport, $nama);
}
function exportKosong()
{
    $nama = 'laporan_buku_kosong_'.date('Y-m-d_H-i-s').'.xlsx';
    return Excel::download(new BukuExportKosong, $nama);
}
function exportDipinjam()
{
    $nama = 'laporan_buku_sering_dipinjam'.date('Y-m-d_H-i-s').'.xlsx';
    return Excel::download(new BukuPinjam, $nama);
}

function exportFilterBuku(Request $request,$daterange)
{

    $datas =new BukuFilter();
    $date = explode('+', $daterange); 
    $datas->setDate(
        $request->from = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01',
        $request->to = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59'
    );
    $nama = 'laporan_buku_'.date('Y-m-d_H-i-s').'.xlsx';
    // alert()->success('Berhasil.','Data telah dieksport!');
    return Excel::download($datas, $nama);
}

function exportFilterBukuDipinjam(Request $request,$daterange)
{

    $datas =new BukuSeringDipinjam();
    $date = explode('+', $daterange); 
    $datas->setDate(
        $request->from = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01',
        $request->to = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59'
    );
    $nama = 'laporan_buku_sering_dipinjam'.date('Y-m-d_H-i-s').'.xlsx';
    // alert()->success('Berhasil.','Data telah dieksport!');
    return Excel::download($datas, $nama);
}

public function transaksi(Request $request)
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');
    
        if (request()->date != '') {
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }
    
        $datas = Peminjaman::whereBetween('created_at', [$start, $end])->get();
   
        $peminjaman =DB::table('peminjaman')
            ->join('status', 'status.id', '=', 'peminjaman.status_id')
            ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
            ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
            ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
            ->select('buku.judul_buku','siswa.NIS','guru.NIP','guru.nama_lengkap','siswa.nama_siswa','peminjaman.*', 'status.name','status.class')
            ->orderBy('created_at','ASC')
            ->get();

        $status = Status::all();
        if (request()->status_id != '') {
            $peminjaman =  $peminjaman->where('status_id', request()->status_id);
        }
        return view('laporan.transaksi', ['peminjaman' => $peminjaman,'status'=>$status,'request'=>$request,'datas'=>$datas]);
    }
    
public function transaksiPeminjaman(Request $request)
{
    $status = Status::all();
    $peminjaman =DB::table('peminjaman')
        ->whereIn('status_id',[3])
        ->join('status', 'status.id', '=', 'peminjaman.status_id')
        ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
        ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
        ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
        ->select('buku.judul_buku','siswa.NIS','guru.NIP','guru.nama_lengkap','siswa.nama_siswa','peminjaman.*', 'status.name','status.class')
        ->orderBy('created_at','ASC')
        ->get();

    if (request()->status_id != '') {
        $peminjaman =  $peminjaman->where('status_id', request()->status_id);
    }
    // alert()->success('Berhasil.','Data telah dieksport!');
    return view('laporan.peminjaman.transaksi_peminjaman', ['peminjaman' => $peminjaman,'status'=>$status]);
}
    
public function transaksiPengembalian()
{
    $peminjaman =DB::table('peminjaman')
        ->whereIn('status_id',[2])
        ->join('status', 'status.id', '=', 'peminjaman.status_id')
        ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
        ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
        ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
        ->select('buku.judul_buku','siswa.NIS','guru.NIP','guru.nama_lengkap','siswa.nama_siswa','peminjaman.*', 'status.name','status.class')
        ->orderBy('created_at','ASC')
        ->get();

    // alert()->success('Berhasil.','Data telah dieksport!');
    return view('laporan.pengembalian.transaksi_pengembalian', ['peminjaman' => $peminjaman]);
}
   
public function transaksiPerpanjangan()
{
    $peminjaman =DB::table('peminjaman')
        ->whereIn('status_id',[1])
        ->join('status', 'status.id', '=', 'peminjaman.status_id')
        ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
        ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
        ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
        ->select('buku.judul_buku','siswa.NIS','guru.NIP','guru.nama_lengkap','siswa.nama_siswa','peminjaman.*', 'status.name','status.class')
        ->orderBy('created_at','ASC')
        ->get();

    // alert()->success('Berhasil.','Data telah dieksport!');
    return view('laporan.perpanjangan.transaksi_perpanjangan', ['peminjaman' => $peminjaman]);
}


    public function transaksiPdf(Request $request)
    {
       
        $peminjaman = Peminjaman::query()  
            ->join('status', 'status.id', '=', 'peminjaman.status_id')
            ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
            ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
            ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
            ->select('buku.judul_buku','siswa.NIS','guru.NIP','guru.nama_lengkap','siswa.nama_siswa','peminjaman.*', 'status.name','status.class')
            ->orderBy('created_at','ASC')
            ->get();

        if (request()->status_id != '') {
            $peminjaman =  $peminjaman->where('status_id', request()->status_id);
        }
        

        // if(Auth::user()->level == 'user')
        // {
        //     $q->where('anggota_id', Auth::user()->anggota->id);
        // }

        // $peminjaman = $peminjaman->get();

       // return view('laporan.transaksi_pdf', compact('datas'));
       $pdf = PDF::loadView('laporan.transaksi_pdf', compact('peminjaman'))->setPaper('a4','landscape');
       return $pdf->download('laporan_transaksi_'.date('Y-m-d_H-i-s').'.pdf');
    }

    public function transaksiPdfFilter(Request $request)
    {
      
        $peminjaman = Peminjaman::query()  
            ->join('status', 'status.id', '=', 'peminjaman.status_id')
            ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
            ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
            ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
            ->select('buku.judul_buku','siswa.NIS','guru.NIP','guru.nama_lengkap','siswa.nama_siswa','peminjaman.*', 'status.name','status.class')
            ->orderBy('status_id','ASC')
            ->get();

        if (request()->status_id != '') {
            $peminjaman =  $peminjaman->where('status_id', request()->status_id);
        }
        

        // if(Auth::user()->level == 'user')
        // {
        //     $q->where('anggota_id', Auth::user()->anggota->id);
        // }

        // $peminjaman = $peminjaman->get();

       // return view('laporan.transaksi_pdf', compact('datas'));
       $pdf = PDF::loadView('laporan.transaksi_pdf', compact('peminjaman'))->setPaper('a4','landscape');
       return $pdf->download('laporan_transaksi_'.date('Y-m-d_H-i-s').'.pdf');
    }

    public function transaksiPdfPeminjaman(Request $request)
    {
      
        $peminjaman = Peminjaman::query()
            ->whereIn('status_id',[3])
            ->join('status', 'status.id', '=', 'peminjaman.status_id')
            ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
            ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
            ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
            ->select('buku.judul_buku','siswa.NIS','guru.NIP','guru.nama_lengkap','siswa.nama_siswa','peminjaman.*', 'status.name','status.class')
            ->orderBy('created_at','ASC')
            ->get();

        if($request->get('status_id')) 
        {
             if($request->get('status_id') == 3) {
                $peminjaman->where('status_id', 3);
            
            }
        }

        // if(Auth::user()->level == 'user')
        // {
        //     $q->where('anggota_id', Auth::user()->anggota->id);
        // }

        // $peminjaman = $peminjaman->get();

       // return view('laporan.transaksi_pdf', compact('datas'));
       $pdf = PDF::loadView('laporan.peminjaman.transaksi_peminjamanPdf', compact('peminjaman'))->setPaper('a4','landscape');
       return $pdf->download('laporan_transaksi_'.date('Y-m-d_H-i-s').'.pdf');
    }

    public function transaksiPdfPengembalian(Request $request)
    {
      
      
        $peminjaman = Peminjaman::query()
            ->whereIn('status_id',[2])
            ->join('status', 'status.id', '=', 'peminjaman.status_id')
            ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
            ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
            ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
            ->select('buku.judul_buku','siswa.NIS','guru.NIP','guru.nama_lengkap','siswa.nama_siswa','peminjaman.*', 'status.name','status.class')
            ->orderBy('created_at','ASC')
            ->get();

        // if(Auth::user()->level == 'user')
        // {
        //     $q->where('anggota_id', Auth::user()->anggota->id);
        // }

        // $peminjaman = $peminjaman->get();

       // return view('laporan.transaksi_pdf', compact('datas'));
       $pdf = PDF::loadView('laporan.pengembalian.transaksi_pengembalianPdf', compact('peminjaman'))->setPaper('a4','landscape');
       return $pdf->download('laporan_transaksi_'.date('Y-m-d_H-i-s').'.pdf');
    }

    public function transaksiPdfPerpanjangan(Request $request)
    {
       
      
        $peminjaman = Peminjaman::query()
            ->whereIn('status_id',[1])
            ->join('status', 'status.id', '=', 'peminjaman.status_id')
            ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
            ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
            ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
            ->select('buku.judul_buku','siswa.NIS','guru.NIP','guru.nama_lengkap','siswa.nama_siswa','peminjaman.*', 'status.name','status.class')
            ->orderBy('created_at','ASC')
            ->get();

       

        // if(Auth::user()->level == 'user')
        // {
        //     $q->where('anggota_id', Auth::user()->anggota->id);
        // }

        // $peminjaman = $peminjaman->get();

       // return view('laporan.transaksi_pdf', compact('datas'));
       $pdf = PDF::loadView('laporan.perpanjangan.transaksi_perpanjanganPdf', compact('peminjaman'))->setPaper('a4','landscape');
       return $pdf->download('laporan_transaksi_'.date('Y-m-d_H-i-s').'.pdf');
    }


function export2()
{
    $nama = 'laporan_transaksi_'.date('Y-m-d_H-i-s').'.xlsx';
    return Excel::download(new TransaksiExport, $nama);
}

function exportFilter(Request $request,$daterange)
{

    $peminjaman =new TransaksiFilter();
    $date = explode('+', $daterange); 
    $peminjaman->setDate(
        $request->from = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01',
        $request->to = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59'
    );
    $nama = 'laporan_transaksi_peminjaman'.date('Y-m-d_H-i-s').'.xlsx';
    // alert()->success('Berhasil.','Data telah dieksport!');
    return Excel::download($peminjaman, $nama);
}

function exportPeminjaman(Request $request)
{
    $nama = 'laporan_transaksi_peminjaman'.date('Y-m-d_H-i-s').'.xlsx';
    return Excel::download(new TransaksiPeminjamanExport, $nama);
}

function exportFilterPeminjaman(Request $request,$daterange)
{

    $peminjaman =new PeminjamanFilter();
    $date = explode('+', $daterange); 
    $peminjaman->setDate(
        $request->from = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01',
        $request->to = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59'
    );
    $nama = 'laporan_transaksi_peminjaman'.date('Y-m-d_H-i-s').'.xlsx';
    // alert()->success('Berhasil.','Data telah dieksport!');
    return Excel::download($peminjaman, $nama);
}


function exportPerpanjangan()
{
    $nama = 'laporan_transaksi_perpanjangan'.date('Y-m-d_H-i-s').'.xlsx';
    return Excel::download(new TransaksiPerpanjanganExport, $nama);
}

function exportFilterPerpanjangan(Request $request,$daterange)
{

    $peminjaman =new PerpanjanganFilter();
    $date = explode('+', $daterange); 
    $peminjaman->setDate(
        $request->from = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01',
        $request->to = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59'
    );
    $nama = 'laporan_transaksi_perpanjangan'.date('Y-m-d_H-i-s').'.xlsx';
    // alert()->success('Berhasil.','Data telah dieksport!');
    return Excel::download($peminjaman, $nama);
}

function exportPengembalian()
{
    $nama = 'laporan_transaksi_pengembalian'.date('Y-m-d_H-i-s').'.xlsx';
    return Excel::download(new TransaksiPengembalianExport, $nama);
}

function exportFilterPengembalian(Request $request,$daterange)
{

    $peminjaman =new PengembalianFilter();
    $date = explode('+', $daterange); 
    $peminjaman->setDate(
        $request->from = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01',
        $request->to = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59'
    );
    $nama = 'laporan_transaksi_perpanjangan'.date('Y-m-d_H-i-s').'.xlsx';
    // alert()->success('Berhasil.','Data telah dieksport!');
    return Excel::download($peminjaman, $nama);
}

public function exportTanggal(Request $request)
{
   
    $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
    $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

    //JIKA USER MELAKUKAN FILTER MANUAL, MAKA PARAMETER DATE AKAN TERISI
    if (request()->date != '') {
        //MAKA FORMATTING TANGGALNYA BERDASARKAN FILTER USER
        $date = explode(' - ' ,request()->date);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
    }

    //BUAT QUERY KE DB MENGGUNAKAN WHEREBETWEEN DARI TANGGAL FILTER
    $peminjaman = Peminjaman::query()
        ->whereIn('status_id',[3])
        ->join('status', 'status.id', '=', 'peminjaman.status_id')
        ->whereBetween('created_at', [$start, $end])
        ->get();
    //KEMUDIAN LOAD VIEW
   
    return view('laporan.peminjaman.transaksi_peminjaman', compact('peminjaman'));
}

public function orderReportPdf($daterange)
{
    $date = explode('+', $daterange); //EXPLODE TANGGALNYA UNTUK MEMISAHKAN START & END
    //DEFINISIKAN VARIABLENYA DENGAN FORMAT TIMESTAMPS
    $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
    $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

    //KEMUDIAN BUAT QUERY BERDASARKAN RANGE CREATED_AT YANG TELAH DITETAPKAN RANGENYA DARI $START KE $END
    $peminjaman = Peminjaman::query()
        ->whereIn('status_id',[3])
        ->join('status', 'status.id', '=', 'peminjaman.status_id')
        ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
        ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
        ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
        ->select('buku.judul_buku','siswa.NIS','guru.NIP','guru.nama_lengkap','siswa.nama_siswa','peminjaman.*', 'status.name','status.class')
        ->whereBetween('peminjaman.created_at', [$start, $end])
        ->get();
    
    //LOAD VIEW UNTUK PDFNYA DENGAN MENGIRIMKAN DATA DARI HASIL QUERY
    $pdf = PDF::loadView('laporan.peminjaman.peminjaman_pdf', compact('peminjaman', 'date'))->setPaper('a4','landscape');
    //GENERATE PDF-NYA
    return $pdf->stream();
}

public function bukuExportTanggal()
{
   
    $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
    $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

    //JIKA USER MELAKUKAN FILTER MANUAL, MAKA PARAMETER DATE AKAN TERISI
    if (request()->date != '') {
        //MAKA FORMATTING TANGGALNYA BERDASARKAN FILTER USER
        $date = explode(' - ' ,request()->date);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
    }

    //BUAT QUERY KE DB MENGGUNAKAN WHEREBETWEEN DARI TANGGAL FILTER
    $datas = Buku::whereBetween('created_at', [$start, $end])->get();
    //KEMUDIAN LOAD VIEW
    return view('laporan.peminjaman.transaksi_peminjaman', compact('datas'));
}


public function bukuReportPdf($daterange)
{
    $date = explode('+', $daterange); //EXPLODE TANGGALNYA UNTUK MEMISAHKAN START & END
    //DEFINISIKAN VARIABLENYA DENGAN FORMAT TIMESTAMPS
    $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
    $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

    //KEMUDIAN BUAT QUERY BERDASARKAN RANGE CREATED_AT YANG TELAH DITETAPKAN RANGENYA DARI $START KE $END
    $datas = Buku::whereBetween('created_at', [$start, $end])->get();
    
    //LOAD VIEW UNTUK PDFNYA DENGAN MENGIRIMKAN DATA DARI HASIL QUERY
    $pdf = PDF::loadView('laporan.buku2_pdf', compact('datas', 'date'))->setPaper('a4','landscape');
    //GENERATE PDF-NYA
    return $pdf->stream();
}


public function transaksiReportPdf($daterange)
{
    $date = explode('+', $daterange); //EXPLODE TANGGALNYA UNTUK MEMISAHKAN START & END
    //DEFINISIKAN VARIABLENYA DENGAN FORMAT TIMESTAMPS
    $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
    $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

    //KEMUDIAN BUAT QUERY BERDASARKAN RANGE CREATED_AT YANG TELAH DITETAPKAN RANGENYA DARI $START KE $END
    $peminjaman = Peminjaman::query()
        ->join('status', 'status.id', '=', 'peminjaman.status_id')
        ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
        ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
        ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
        ->select('buku.judul_buku','siswa.NIS','guru.NIP','guru.nama_lengkap','siswa.nama_siswa','peminjaman.*', 'status.name','status.class')
        ->whereBetween('peminjaman.created_at', [$start, $end])
        ->get();
    
    //LOAD VIEW UNTUK PDFNYA DENGAN MENGIRIMKAN DATA DARI HASIL QUERY
    $pdf = PDF::loadView('laporan.transaksi_pdf', compact('peminjaman', 'date'))->setPaper('a4','landscape');
    //GENERATE PDF-NYA
    return $pdf->stream();
}

public function transaksiPerpanjanganReportPdf($daterange)
{
    $date = explode('+', $daterange); //EXPLODE TANGGALNYA UNTUK MEMISAHKAN START & END
    //DEFINISIKAN VARIABLENYA DENGAN FORMAT TIMESTAMPS
    $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
    $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

    //KEMUDIAN BUAT QUERY BERDASARKAN RANGE CREATED_AT YANG TELAH DITETAPKAN RANGENYA DARI $START KE $END
    $peminjaman = Peminjaman::query()
        ->whereIn('status_id',[1])
        ->join('status', 'status.id', '=', 'peminjaman.status_id')
        ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
        ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
        ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
        ->select('buku.judul_buku','siswa.NIS','guru.NIP','guru.nama_lengkap','siswa.nama_siswa','peminjaman.*', 'status.name','status.class')
        ->whereBetween('peminjaman.created_at', [$start, $end])
        ->get();
    
    //LOAD VIEW UNTUK PDFNYA DENGAN MENGIRIMKAN DATA DARI HASIL QUERY
    $pdf = PDF::loadView('laporan.perpanjangan.perpanjangan_pdf', compact('peminjaman', 'date'))->setPaper('a4','landscape');
    //GENERATE PDF-NYA
    return $pdf->stream();

}
public function transaksiPengembalianReportPdf($daterange)
{
    $date = explode('+', $daterange); //EXPLODE TANGGALNYA UNTUK MEMISAHKAN START & END
    //DEFINISIKAN VARIABLENYA DENGAN FORMAT TIMESTAMPS
    $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
    $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

    //KEMUDIAN BUAT QUERY BERDASARKAN RANGE CREATED_AT YANG TELAH DITETAPKAN RANGENYA DARI $START KE $END
    $peminjaman = Peminjaman::query()
        ->whereIn('status_id',[2])
        ->join('status', 'status.id', '=', 'peminjaman.status_id')
        ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
        ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
        ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
        ->select('buku.judul_buku','siswa.NIS','guru.NIP','guru.nama_lengkap','siswa.nama_siswa','peminjaman.*', 'status.name','status.class')
        ->whereBetween('peminjaman.created_at', [$start, $end])
        ->get();
    
    //LOAD VIEW UNTUK PDFNYA DENGAN MENGIRIMKAN DATA DARI HASIL QUERY
    $pdf = PDF::loadView('laporan.pengembalian.pengembalian_pdf', compact('peminjaman', 'date'))->setPaper('a4','landscape');
    //GENERATE PDF-NYA
    return $pdf->stream();
    }
    
    public function transaksiPdfTerlambat()
    {
      
            $peminjaman = Peminjaman::query()
            ->join('status', 'status.id', '=', 'peminjaman.status_id')
            ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
            ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
            ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
            ->select('buku.judul_buku','siswa.NIS','guru.NIP','guru.nama_lengkap','siswa.nama_siswa','peminjaman.*', 'status.name','status.class')
            ->where('peminjaman.tanggal_harus_kembali', '<', Carbon::now()->format('Y-m-d'))
            ->get();

            $pdf = PDF::loadView('laporan.transaksi_pdf2', compact('peminjaman'))->setPaper('a4','landscape');
            return $pdf->download('laporan_buku_'.date('Y-m-d_H-i-s').'.pdf');
        
    
    }
    
function exportKeterlambatan()
{
    $nama = 'laporan_transaksi_keterlambatan'.date('Y-m-d_H-i-s').'.xlsx';
    return Excel::download(new TransaksiKeterlambatan, $nama);
}

}
