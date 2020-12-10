<?php

namespace App\Exports;

use App\Models\Siswa;
use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SiswaExport implements FromView,ShouldAutoSize
{
    use Exportable;
    
    public function view(): View
    {
        $data =DB::table('siswa');
        $data = [['NIS' => null, 'nama_siswa' => null, 'alamat' => null, 'gender' => 'P/L', 'kelas' => 'SD Tahfidz/SMP Islam/SMA Tahfidz/P-TB/MA', 'tempat_lahir' => null, 'tanggal_lahir' => null, 'no_telp' => null, 'agama' => null,'email' => null
        ]];
        return view('page.siswa.siswa_import', ['data' => $data
            ]);
    }

}