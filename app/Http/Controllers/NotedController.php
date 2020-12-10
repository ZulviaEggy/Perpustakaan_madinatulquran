<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Noted;
use App\Models\Buku;
use App\Models\Kategori;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

class NotedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $noted = Noted::all();
        if (request()->status != '') {
            $noted =  $noted->where('status', request()->status);
        }
        return view('page.noted.noted', ['noted' => $noted,'request'=>$request]);
    }

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $noted = Noted::get();
        // $guru = Guru::get();
        // return view('user.dashboard', [ 'noted' => $noted]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'nip'     => 'required',
        //     'nama'    => 'required',
           
        // ]);
        // $noted = new Noted();
        // $noted->nip    = $request->input('nip');
        // $noted->nama    = $request->input('nama');
        // $noted->deskripsi  = $request->input('deskripsi');
        // $noted->save();
        // alert()->success('Sukses.','Masukan berhasil dikirimkan!');
        // return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $noted = Noted::find($id);
        $buku = Buku::all();
        return view('page.noted.show_noted', [ 'noted' => $noted, 'buku' => $buku]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategorie = Kategori::find($id);
        return view('page.kategori.edit_kategori', [ 'kategorie' => $kategorie]);
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
            'nama_kategori'      => 'required',
            'rak'                => 'required',
           
        ]);
        $kategorie = Kategori::find($id);
        $kategorie->nama_kategori    = $request->input('nama_kategori');
        $kategorie->rak   = $request->input('rak');
        $kategorie->save();
        alert()->success('Success.','Data has been updated!');
        return redirect()->route('kategori.index');
      
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $noted = Noted::find($id);
        if($noted){
            $noted->delete();
        }
        alert()->success('Success.','Data has been deleted!');
        return redirect()->route('noted.index');
    }
}
