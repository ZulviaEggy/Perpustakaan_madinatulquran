<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buku;
use App\Models\Guru;
use App\User;
use App\Models\Role;
use App\Models\Siswa;
use App\Models\Peminjaman;
use App\Models\Kategori;
use App\Models\Noted;
use Auth;
use Session;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        if(in_array(Auth::user()->role_id,[6])){
            $peminjaman = DB::table('peminjaman')->whereIn('status_id',[1,3])
                    ->where('nip', Auth::user()->nip)
                    ->join('status', 'status.id', '=', 'peminjaman.status_id')
                    ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
                    ->select('buku.*','peminjaman.*', 'status.name','status.class')
                    ->get();
                    $buku = Buku::get();
                    $guru = Guru::get();  
                    
                    $usulan = Noted::where('nip', Auth::user()->nip)->get();
                    $datas  =  Peminjaman::where('nip', Auth::user()->nip)
                    
                            ->join('status', 'status.id', '=', 'peminjaman.status_id')
                            ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
                            ->select('buku.*','peminjaman.*', 'status.name','status.class')
                            ->paginate(4);  
                    $terbaru = Buku::with('kategori')
                                ->orderBy('created_at','DESC')
                                ->take(10)
                                ->paginate(3); 
                    if ($request->ajax()) {
                      
                        return view('user.table', compact('datas'));
                    } 
                      
                return view('user.dashboard', compact('peminjaman', 'buku','terbaru','datas','guru','usulan'));

        } elseif(in_array(Auth::user()->role_id,[5])) {
            $peminjaman = DB::table('peminjaman')->whereIn('status_id',[1,3])
                ->where('nis', Auth::user()->nis)
                ->join('status', 'status.id', '=', 'peminjaman.status_id')
                ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
                ->select('buku.*','peminjaman.*', 'status.name','status.class')
                ->get();
            $buku    = Buku::get();
            $siswa = Siswa::get();
            $usulan  = Noted::where('nis', Auth::user()->nis)->get();
            $datas   =  Peminjaman::where('nis', Auth::user()->nis)
                    ->join('status', 'status.id', '=', 'peminjaman.status_id')
                    ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
                    ->select('buku.*','peminjaman.*', 'status.name','status.class')
                    ->paginate(4);  
            $terbaru = Buku::with('kategori')
                        ->orderBy('created_at','DESC')
                        ->take(10)
                        ->paginate(3); 
            if ($request->ajax()) {
              
                return view('user.table', compact('terbaru'));
            } 
              
        return view('user.dashboard', compact('peminjaman', 'buku','terbaru','datas','siswa','usulan'));
    } else{
        $peminjaman = Peminjaman::get();
        $buku      = Buku::get();
        $siswa = Siswa::get();
        $guru = Guru::get();
        $user  = DB::table('users')
            ->join('users_privilege', 'users_privilege.id', '=', 'users.role_id')
            ->select('users_privilege.*')
            ->paginate( 20 );
        $datas = Peminjaman::where('status_id', '=','3')->get();
        $datas2 = Peminjaman::where('status_id', '=','2')->get();
        $terbaru    = Buku::with('kategori')
                    ->orderBy('created_at','DESC')
                    ->take(3)
                    ->get();

        $label = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
        $kategori = Kategori::all();
    
        foreach($kategori as $kat){
            $produk[] = $kat->nama_kategori;
      
        $query = DB::select('select sum(jumlah) as jumlah from buku where kategori_id='.$kat['id']);
       
        foreach($query as $sum){
            $jumlah_produk3[] = $sum->jumlah;
          }
        }

        for($bulan = 1;$bulan < 13;$bulan++)
        {
            $query2 = DB::select('select sum(status_id = 3) as status_id from peminjaman where MONTH(tanggal_peminjaman)='.$bulan);
            foreach($query2 as $sum2){
                $jumlah_produk[] = $sum2->status_id;
              }

            $query3 =DB::select('select sum(status_id = 2) as status_id from peminjaman where MONTH(tanggal_peminjaman)='.$bulan);
            foreach($query3 as $sum3){
                $jumlah_produk2[] = $sum3->status_id;
              }
            $query4 =DB::select('select sum(status_id = 1) as status_id from peminjaman where MONTH(tanggal_peminjaman)='.$bulan);
            foreach($query4 as $sum4){
                $jumlah_produk4[] = $sum4->status_id;
                }
        }

        for($month = 1;$month < 13;$month++)
        {
            $noted = DB::select('select sum(status = "Diproses") as status from noted where MONTH(tanggal_usulan)='.$month);
            foreach($noted as $usul){
                $jumlah_usul[] = $usul->status;
              }
              $noted2 = DB::select('select sum(status = "Ditolak") as status from noted where MONTH(tanggal_usulan)='.$month);
            foreach($noted2 as $usul2){
                $jumlah_usul2[] = $usul2->status;
              }
              $noted3 = DB::select('select sum(status = "Disetujui") as status from noted where MONTH(tanggal_usulan)='.$month);
            foreach($noted3 as $usul3){
                $jumlah_usul3[] = $usul3->status;
              }
        }
        
    //dd(json_encode($jumlah_produk3));
        return view('index',[ 'peminjaman' => $peminjaman, 'buku' => $buku, 'siswa' => $siswa, 'guru' => $guru,'user' => $user,'datas' =>$datas,'datas2' =>$datas2,'terbaru'=>$terbaru,'label' =>$label,'produk'=>$produk,'kategori'=>$kategori,'jumlah_produk3' =>$jumlah_produk3,'jumlah_produk' =>$jumlah_produk,'jumlah_produk2' =>$jumlah_produk2,'jumlah_produk4' =>$jumlah_produk4,'jumlah_usul' => $jumlah_usul, 'jumlah_usul2' => $jumlah_usul2,'jumlah_usul3' => $jumlah_usul3]);
        }
    }
}

