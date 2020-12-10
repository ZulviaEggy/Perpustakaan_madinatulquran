<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buku;
use App\Models\Kategori;
use File;
use Excel;
use App\Exports\BukuExport;
use App\Imports\BukuImport;
use App\Exports\FormatBukuExport;
use RealRashid\SweetAlert\Facades\Alert;

class BarcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('laporan.barcode');
    }

    public function prnpriview($id)
      {
        $book = Buku::with('kategori')->find($id);
        return view('laporan.barcode', [ 'book' => $book ]);
      }
}