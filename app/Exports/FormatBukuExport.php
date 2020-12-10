<?php

namespace App\Exports;

use App\Models\Buku;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FormatBukuExport implements FromView,ShouldAutoSize
{
    use Exportable;
    
    public function view(): View
    {
        return view('laporan.format_buku', [
            'datas' => Buku::all()
        ]);
    }

}
