<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Status;
use App\Models\Siswa;
use App\Models\Guru;
use App\User;
use File;
use Auth;
use Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;


class PeminjamanController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
       
    }
    public function index(Request $request)
    {
       
        $peminjaman = DB::table('peminjaman')
            ->join('status', 'status.id', '=', 'peminjaman.status_id')
            ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
            ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
            ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
            ->select('buku.judul_buku','siswa.NIS','guru.NIP','guru.nama_lengkap','siswa.nama_siswa','peminjaman.*', 'status.name','status.class')
            ->orderBy('kode_pinjam','ASC')
            ->get();

            $status = Status::all();
            if (request()->status_id != '') {
                $peminjaman =  $peminjaman->where('status_id', request()->status_id);
            }

        return view('page.transaksi.peminjaman',  compact('peminjaman','status','request'));
    }
    public function indexPengembalian(Request $request, $id)
    {
       
        $buku = Buku::find($id);
        $status = Status::all();
        $user = User::all();
        $pinjam = Peminjaman::find($id);
        return view('page.transaksi.pengembalian',  compact('buku', 'status','user','pinjam'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $status = Status::get();
        $user = User::get();
        $siswa = Siswa::get();
        $guru = Guru::get();
        $book = Buku::get();
        $getRow = Peminjaman::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "TR00001";
        
        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $kode = "TR0000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $kode = "TR000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $kode = "TR00".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $kode = "TR0".''.($lastId->id + 1);
            } else {
                    $kode = "TR".''.($lastId->id + 1);
            }
        }

        $buku = Buku::where('jumlah', '>', 0)->get();
        return view('page.transaksi.tambah_peminjaman', [ 'book' => $book, 'status' => $status, 'buku' => $buku, 'user' => $user, 'siswa' =>$siswa,'guru' => $guru,'kode' =>$kode]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Buku $buku)
    {
        date_default_timezone_set('Asia/Jakarta');
        $validatedData = $request->validate([
            'buku_id'               => 'required',
            'kode_pinjam'           => 'required',
            'tanggal_peminjaman'    => 'required',
            'tanggal_harus_kembali' => 'required',
            'jenis_identitas'       => 'required'
           
        ],
        [
            'buku_id.required'  => 'Book can not be empty!',
            'kode_pinjam.required'  => 'Transaction code can not be empty!',
            'jenis_identitas.required' => 'Type of member can not be empty!'
        ]);
      
        $buku = Buku::where(['kode_buku' => $request->get('buku_id') ]);
        $value = $buku->value('jumlah');
        if ($value > 0){
        $pinjam = Peminjaman::create([
            
        'buku_id'           => $request->get('buku_id'),
        'kode_pinjam'       => $request->get('kode_pinjam'),
        'status_id'         => '3',
        'nis'               => $request->get('nis'),
        'nip'               => $request->get('nip'),
        'tanggal_peminjaman' => date("Y-m-d", strtotime(request('tanggal_peminjaman'))),
        'tanggal_harus_kembali' => date("Y-m-d", strtotime(request('tanggal_harus_kembali'))),
        ]);
        
        $pinjam 
            ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
            ->where('buku.kode_buku', $pinjam->buku_id)
            ->update(['buku.jumlah' =>($value - 1),
                ]);  
                $pinjam->save();
            alert()->success('Success.','Data saved successfully!');
        } else {
           
            alert()->warning('Oopss..', 'Book does not exist!');
        }  
     
        return redirect()->route('peminjaman.index');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pinjam =  DB::table('peminjaman')
        ->join('status', 'status.id', '=', 'peminjaman.status_id')
        ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
        ->leftJoin('siswa', 'siswa.NIS', '=', 'peminjaman.nis') 
        ->leftJoin('guru', 'guru.NIP', '=', 'peminjaman.nip')
        ->select('buku.*','siswa.*','guru.NIP','guru.nama_lengkap','peminjaman.*', 'status.name','status.class')
        ->where('peminjaman.id',$id)
        ->first();
        return view('page.transaksi.show', [ 'pinjam' => $pinjam ]);
    }

    public function showBook($id)
    {
        $book = Buku::with('kategori')->find($id);
        $buku = Buku::find($id);
        $status = Status::all();
        $user = User::all();
        $pinjam = Peminjaman::find($id);
        return view('user.show_book', [ 'book' => $book,'status' => $status, 'buku' => $buku, 'user' => $user, 'pinjam' => $pinjam ]);
    }
      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //var_dump('bazinga');
        //die();
        $validatedData = $request->validate([
            'buku_id'               => 'required|min:1|max:64',
            'status_id'             => 'required',
            'kode_pinjam'           => 'required',
            'tanggal_peminjaman'    => 'required',
            'keterlambatan'         => 'required',
            'denda'                 => 'required',
            'tanggal_harus_kembali' => 'required'
          
        ]);
        $pinjam = Peminjaman::find($id);
        $pinjam->buku_id     = $request->input('buku_id');
        $pinjam->kode_pinjam    = $request->input('kode_pinjam');
        $pinjam->status_id   = $request->input('status_id');
        $pinjam->nis   = $request->input('nis');
        $pinjam->nip   = $request->input('nip');
        $pinjam->tanggal_peminjaman = date("Y-m-d", strtotime(request('tanggal_peminjaman')));
        $pinjam->tanggal_harus_kembali =date("Y-m-d", strtotime(request('tanggal_harus_kembali')));
        $pinjam->keterlambatan     = $request->input('keterlambatan');
        $pinjam->denda    = $request->input('denda');
        $pinjam->save();
        alert()->success('Success.','Data saved successfully!');
        return redirect()->route('peminjaman.index');
      }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perpanjangan($id)
    {
        $buku = Buku::find($id);
        $status = Status::all();
        $user = User::all();
        $siswa = Siswa::find($id);
        $pinjam = Peminjaman::find($id);

        return view('page.transaksi.tambah_perpanjangan', [ 'status' => $status, 'buku' => $buku, 'user' => $user, 'pinjam' => $pinjam,'siswa'=>$siswa]);
    }
      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePerpanjangan(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $validatedData = $request->validate([
            'buku_id'               => 'required|min:1|max:64',
            'kode_pinjam'           => 'required',
            'tanggal_peminjaman'    => 'required',
            'keterlambatan'         => 'required',
            'denda'                 => 'required',
            'tanggal_harus_kembali' => 'required'
          
        ],
        [
            'buku_id.required'          => 'Book can not be empty!',
            'kode_pinjam.required'      => 'Transaction code can not be empty!',
            'keterlambatan.required'    => 'Late return of book can not be empty!',
            'denda.required'            => 'Fines can not be empty!',
        ]);

        $pinjam = Peminjaman::find($id);
        $pinjam->buku_id            = $request->input('buku_id');
        $pinjam->kode_pinjam        = $request->input('kode_pinjam');
        $pinjam->status_id          = $request->input('status_id');
        $pinjam->nis                = $request->input('nis');
        $pinjam->nip                = $request->input('nip');
        $pinjam->tanggal_peminjaman = date("Y-m-d", strtotime(request('tanggal_peminjaman')));
        $pinjam->tanggal_harus_kembali = date("Y-m-d", strtotime(request('tanggal_harus_kembali')));
        $pinjam->keterlambatan     = $request->input('keterlambatan');
        $pinjam->denda    = $request->input('denda');
        $pinjam->update(['status_id' => '1']);
        $pinjam->save();
        alert()->success('Success.','Data saved successfully!');
        return redirect()->route('peminjaman.index');
      }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tambahPengembalian($id)
    {
        $buku = Buku::find($id);
        $status = Status::all();
        $user = User::all();
        $pinjam = Peminjaman::find($id);
        
        return view('page.transaksi.tambah_pengembalian', [ 'status' => $status, 'buku' => $buku, 'user' => $user, 'pinjam' => $pinjam ]);
    }
      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePengembalian(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $validatedData = $request->validate([
            'buku_id'                   => 'required|min:1|max:64',
            'kode_pinjam'               => 'required',
            'tanggal_peminjaman'        => 'required',
            'keterlambatan'             => 'required',
            'denda'                     => 'required',
            'tanggal_harus_kembali'     => 'required',
            'kondisi_buku'              => 'required|in:baik,hilang,rusak',
            'denda_buku'                => 'required'
          
        ],
        [
            'buku_id.required'          => 'Book can not be empty!',
            'kode_pinjam.required'      => 'Transaction code can not be empty!',
            'keterlambatan.required'    => 'Late return of book can not be empty!',
            'denda.required'            => 'Fines can not be empty!',
            'kondisi_buku.required'     => 'Book condition can not be empty!',
            'denda_buku.required'       => 'Book fines can not be empty!',
        ]);

        $pinjam = Peminjaman::find($id);
    
        $pinjam->buku_id                = $request->input('buku_id');
        $pinjam->kode_pinjam            = $request->input('kode_pinjam');
        $pinjam->status_id              = $request->input('status_id');
        $pinjam->nis                    = $request->input('nis');
        $pinjam->nip                    = $request->input('nip');
        $pinjam->tanggal_peminjaman     = date("Y-m-d", strtotime(request('tanggal_peminjaman')));
        $pinjam->tanggal_harus_kembali  = date("Y-m-d", strtotime(request('tanggal_harus_kembali')));
        $pinjam->keterlambatan          = $request->input('keterlambatan');
        $pinjam->denda                  = $request->input('denda');
        $pinjam->kondisi_buku           = $request->input('kondisi_buku');
        $pinjam->denda_buku             = $request->input('denda_buku');
        $buku   = Buku::where('kode_buku',$request->buku_id);
        $value  = $buku->value('jumlah');
        $pinjam->update([
            'status_id' => '2'
            ]);
        $pinjam 
        ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
        ->where('buku.kode_buku', $pinjam->buku_id)
        ->update([ 'buku.jumlah'=>($value + 1),
            ]);
        $pinjam->save();
        alert()->success('Success.','Book returned successfully!');
        return redirect()->route('peminjaman.index');
      }

 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $pinjam = Peminjaman::find($id);
        if($pinjam){
            $pinjam->delete();
        }
        alert()->success('Success.','Data has been deleted!');
        return redirect()->route('peminjaman.index');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("peminjaman")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Transaksi Deleted successfully."]);
    }

    public function transaksiUser()
    {
        if(Auth::user()->role_id == 6){
        $peminjaman = DB::table('peminjaman')->where('nip', Auth::user()->nip)
            ->join('status', 'status.id', '=', 'peminjaman.status_id')
            ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
            ->select('buku.*','peminjaman.*', 'status.name','status.class')
            ->get();     
        return view('user.transaksi_user',  compact('peminjaman'));
    } elseif(Auth::user()->role_id == 5) {
        $peminjaman = DB::table('peminjaman')->where('nis', Auth::user()->nis)
            ->join('status', 'status.id', '=', 'peminjaman.status_id')
            ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
            ->select('buku.*','peminjaman.*', 'status.name','status.class')
            ->get();     
        return view('user.transaksi_user',  compact('peminjaman'));
    }
  }
  public function DetailtransaksiUser($id)
  {
      if(Auth::user()->role_id == 6){
        $book = Buku::with('kategori')->find($id);
        $pinjam = DB::table('peminjaman')->where('nip', Auth::user()->nip)
          ->join('status', 'status.id', '=', 'peminjaman.status_id')
          ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
          ->select('buku.*','peminjaman.*', 'status.name','status.class')
          ->where('peminjaman.kode_pinjam',$id)
          ->first(); 
      return view('user.detail_transaksi',  compact('pinjam','book'));
  } elseif(Auth::user()->role_id == 5) {
        $pinjam = DB::table('peminjaman')->where('nis', Auth::user()->nis)
          ->join('status', 'status.id', '=', 'peminjaman.status_id')
          ->join('buku', 'buku.kode_buku', '=', 'peminjaman.buku_id')
          ->select('buku.*','peminjaman.*', 'status.name','status.class')
          ->where('peminjaman.kode_pinjam',$id)
          ->first();  
      return view('user.detail_transaksi',  compact('pinjam'));
  }
}

}
