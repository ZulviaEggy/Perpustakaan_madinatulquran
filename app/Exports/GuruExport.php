<?php

namespace App\Exports;

use App\Models\Guru;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GuruExport implements FromView,ShouldAutoSize
{
    use Exportable;
    
    public function view(): View
    {
        return view('page.guru.guru_import', [
            'datas' => Guru::all()
        ]);
    }

}
