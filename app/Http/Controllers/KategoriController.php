<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
      
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategorie = Kategori::orderBy('nama_kategori','ASC')->get();
        return view('page.kategori.kategori', ['kategorie' => $kategorie]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategorie = Kategori::all();
        return view('page.kategori.tambah_kategori', [ 'kategorie' => $kategorie]);
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
            'nama_kategori'     => 'required',
            'rak'               => 'required',
        ],
        [
            'nama_kategori.required' => 'Category can not be empty!',
            'rak.required'           => 'Bookshelves can not be empty!',
        ]
    
    );
        $kategorie = new Kategori();
        $kategorie->nama_kategori    = $request->input('nama_kategori');
        $kategorie->rak   = $request->input('rak');
        $kategorie->save();
        alert()->success('Sukses.','Category saved successfully!');
        return redirect()->route('kategori.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
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
        ],
        [
            'nama_kategori.required' => 'Category can not be empty!',
            'rak.required'           => 'Bookshelves can not be empty!',
        ]
        );
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
        $kategorie = Kategori::find($id);
        try {
            $kategorie->delete();
            alert()->success('Success.','Data has been deleted!');
        } catch (\Exception $e) {
        alert()->warning('Sorry.','Something went wrong');
    }
   return redirect()->route('kategori.index'); 
}
}