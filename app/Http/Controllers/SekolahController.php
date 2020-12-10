<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil;

class SekolahController extends Controller
{
    public function index()
    {
        $sekolah = Profil::all();
        return view('dashboard.navbar', ['sekolah' => $sekolah]);
    }

    public function edit($id)
    {
        $sekolah = Profil::find($id);
        return view('dashboard.edit_sekolah', [ 'sekolah' => $sekolah]);
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
            'deskripsi'      => 'required',
         
        ],
    [
        'deskripsi.required'    => 'Description can not be empty!'
    ]);
        $profil = Profil::find($id);
        $profil->deskripsi    = $request->input('deskripsi');
       
        $profil->save();
        alert()->success('Success.','Data has been updated!');
        return redirect()->back();
      
      }
}
