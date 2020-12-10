<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buku;
use App\Models\Kategori;
use File;
use Excel;
use App\Models\Noted;
use App\Exports\BukuExport;
use App\Imports\BukuImport;
use App\Exports\FormatBukuExport;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exceptions\BukuValidationException;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $buku = DB::table('buku')->value('kategori_id');
        if ($buku != NULL){
            $buku = DB::table('buku')
            ->join('kategori_buku', 'kategori_buku.id', '=', 'buku.kategori_id')
            ->select('buku.*', 'kategori_buku.nama_kategori','kategori_buku.rak')
            ->orderBy('judul_buku','ASC')
            ->get();
       } else {
        $buku = DB::table('buku')            
        ->select('buku.kode_buku')
        ->get();
       }

       $kategori = Kategori::all();
       if (request()->kategori_id != '') {
           $buku =  $buku->where('kategori_id', request()->kategori_id);
       }
        return view('page.buku.list_buku', compact('buku','kategori','request'));
    }

    public function bukuUser(Request $request)
    {   
        $buku = DB::table('buku')->value('kategori_id');
        $terbaru    = Buku::with('kategori')
        ->orderBy('created_at','DESC')
        ->get();
        if ($buku != NULL){
            $buku = DB::table('buku')
            ->join('kategori_buku', 'kategori_buku.id', '=', 'buku.kategori_id')
            ->select('buku.*', 'kategori_buku.nama_kategori','kategori_buku.rak')
            ->orderBy('judul_buku','ASC')
            ->get();
       } else {
        $buku = DB::table('buku')            
        ->select('buku.kode_buku')
        ->orderBy('judul_buku','ASC')
        ->get();
       }
       $kategori = Kategori::all();
       if (request()->kategori_id != '') {
           $buku =  $buku->where('kategori_id', request()->kategori_id);
       }
        return view('user.koleksi_buku', compact('buku','terbaru','kategori','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategorie = Kategori::all();
        return view('page.buku.create_book', [ 'kategorie' => $kategorie]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_buku'        => 'required|min:1|max:64|unique:buku',
            'judul_buku'       => 'required',
            'tahun_terbit'     => 'required',
            'penulis'          => 'required',
            'penerbit'         => 'required',
            'jumlah'           => 'required',
            'ISBN'             => 'required',
            'kategori_id'      => 'required',
            'kota_terbit'      => 'required',
            'deskripsi'        => 'max:255',
        ],
        [
            'kode_buku.required'    => 'Book code can not be empty!',
            'kode_buku.unique'      => 'Book code has already been taken!',
            'kode_buku.max'         => 'Book code must more less 64 character',
            'judul_buku.required'   => 'Book title can not be empty!',
            'tahun_terbit.required' => 'Year of publication can not be empty!',
            'penulis.required'      => 'Author can not be empty!',
            'penerbit.required'     => 'Book publisher can not be empty!',
            'jumlah.required'       => 'Number of book can not be empty!',
            'ISBN.required'         => 'ISBN can not be empty!',
            'kategori_id.required'  => 'Category can not be empty!',
            'kota_terbit.required'  => 'City publisher can not be empty!',
            'deskripsi.max'         => 'The description is too long!',
        ]
    
    );
        $buku = new Buku();
        $buku->kode_buku        = $request->input('kode_buku');
        $buku->judul_buku       = $request->input('judul_buku');
        $buku->kategori_id      = $request->input('kategori_id');
        $buku->tahun_terbit     = $request->input('tahun_terbit');
        $buku->edisi            = $request->input('edisi');
        $buku->penulis          = $request->input('penulis');
        $buku->penerbit         = $request->input('penerbit');
        $buku->kota_terbit      = $request->input('kota_terbit');
        $buku->volume           = $request->input('volume');
        $buku->deskripsi        = $request->input('deskripsi');
        $buku->ISBN             = $request->input('ISBN');
        $buku->jumlah           = $request->input('jumlah');
        if($buku->cover != $request->cover){
            $this->validate($request,
            [
                'cover'         => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
        }
        if ($request->hasFile('cover')){
            $file = $request->file('cover');
            $photo = $file->getClientOriginalName();
            $extension = $file-> getClientOriginalExtension();
            $real = $file-> getRealPath();
            $mime = $file->getMimeType();
            $ukuran_file = $file-> getSize();
            $destination = public_path() . '/uploads/';
            $request->file('cover') -> move($destination, $file->getClientOriginalName());
            $buku->cover = $photo;
        } else {
            $buku->cover = NULL;
        }
        $buku->save();
        alert()->success('Success.','Book saved successfully!');
        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Buku::with('kategori')->find($id);
        $buku = Buku::find($id);
        return view('page.buku.detail_book', [ 'book' => $book, 'buku' =>$buku ]);
    }

    

    public function showBook($id)
    {
        $book = Buku::with('kategori')->find($id);
        return view('user.detail_book', [ 'book' => $book ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::find($id);
        $kategorie = Kategori::all();
        return view('page.buku.edit_buku', [ 'kategorie' => $kategorie, 'buku' => $buku ]);
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
        $validatedData = $request->validate([
            'kode_buku'        => 'required|min:1|max:64',
            'judul_buku'       => 'required',
            'tahun_terbit'     => 'required',
            'penulis'          => 'required',
            'penerbit'         => 'required',
            'jumlah'           => 'required',
            'ISBN'             => 'required',
            'kategori_id'      => 'required',
            'kota_terbit'      => 'required',
            'deskripsi'        => 'max:255',
        ],
        [
            'kode_buku.required'    => 'Book code can not be empty!',
            'kode_buku.max'         => 'Book code must more less 64 character',
            'judul_buku.required'   => 'Book title can not be empty!',
            'tahun_terbit.required' => 'Year of publication can not be empty!',
            'penulis.required'      => 'Author can not be empty!',
            'penerbit.required'     => 'Book publisher can not be empty!',
            'jumlah.required'       => 'Number of book can not be empty!',
            'ISBN.required'         => 'ISBN can not be empty!',
            'kategori_id.required'  => 'Category can not be empty!',
            'kota_terbit.required'  => 'City publisher can not be empty!',
            'deskripsi.max'         => 'The description is too long!',

        ]
    
    );
        $buku = Buku::find($id);
        $buku->kode_buku        = $request->input('kode_buku');
        $buku->judul_buku       = $request->input('judul_buku');
        $buku->kategori_id      = $request->input('kategori_id');
        $buku->tahun_terbit     = $request->input('tahun_terbit');
        $buku->edisi            = $request->input('edisi');
        $buku->penulis          = $request->input('penulis');
        $buku->penerbit         = $request->input('penerbit');
        $buku->kota_terbit      = $request->input('kota_terbit');
        $buku->volume           = $request->input('volume');
        $buku->deskripsi        = $request->input('deskripsi');
        $buku->ISBN             = $request->input('ISBN');
        $buku->jumlah           = $request->input('jumlah');
     
        $buku->save();
        alert()->success('Success.','Data has been updated!');
        return redirect()->route('buku.index');
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $buku = Buku::find($id);
        File::delete('uploads/'.$buku->cover);
        if($buku){
            $buku->delete();
        }
        alert()->success('Success.','Data has been deleted!');
        return redirect()->route('buku.index');
    }

    public function editPhoto($id)
    {
        $buku = Buku::find($id);
        $usulan = Noted::find($id);
        return view('page.buku.edit_photo', ['buku' => $buku ,'usulan' => $usulan]);
    }

    public function updateBarcode(Request $request, $id)
    {
       
        $validatedData = $request->validate([
            'print_qty'           => 'required',
          
        ]);
        $buku = Buku::find($id);
        $buku->print_qty     = $request->input('print_qty');
        
        $buku->save();
        return redirect()->route('barcode.show',[$buku]);
      }

    public function updatePhoto(Request $request, $id)
    {
        $validatedData = $request->validate([
            'cover'         => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $buku = Buku::find($id);
       
        if ($request->hasFile('cover')){
            $image_path = public_path("/uploads/".$buku->cover);
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $file = $request->file('cover');
            $photo = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $real = $file-> getRealPath();
            $mime = $file->getMimeType();
            $ukuran_file = $file-> getSize();
            $filename = md5(time()).'.'.$extension;
            $file->move(public_path().'\uploads', $photo);
            $buku->cover = $photo;
        } else {
            return $request;
            $buku->cover='';
        }

        $buku->save();
        alert()->success('Success.','Cover has been changed!');
        return redirect()->route('buku.edit',[$buku]);
      }

      public function showBarcode($id)
    {
        $book = Buku::with('kategori')->find($id);
        return view('laporan.barcode2', [ 'book' => $book ]);
    }


      public function format()
      {
        $nama = 'laporan_buku'.'.xlsx';
        return Excel::download(new FormatBukuExport, $nama);
      }

      public function import(Request $request) 
	{
       
		$this->validate($request, [
			'file' => 'required'
        ],
        [
            'file.required'  => 'File can not be empty!',
        ]);

        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if($extension == "xlsx" || $extension == "xls"){
            $file = $request->file('file');
            $nama_file = rand().$file->getClientOriginalName();
            $file->move('file_buku',$nama_file);

            try{
            $import = Excel::import(new \App\Imports\BukuImport, public_path('/file_buku/'.$nama_file));
            alert()->success('Success.','Data imported successfully!');
            return redirect()->route('buku.index');

            } catch ( BukuValidationException $e ){
                return redirect()->route('buku.index')->withErrors($e->getOptions()); 
                }
        } else {
            alert()->error('Error','Selected file is '.$extension.' .please choose file xls or xlsx');
            return redirect()->route('buku.index'); 
        }
    }
}
    
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("buku")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Book Deleted successfully."]);
    }
  
}
