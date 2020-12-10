<?php

namespace App\Exports;

use App\Models\Buku;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Carbon\Carbon;

class BukuFilter implements FromView
{
    use Exportable;
    private $from,$to;

    public function __construct()
    {
        $this->datas = new Buku();
    }

    public function setDate($from,$to){
        $this->from = $from.' 00:00:00';
        $this->to = $to.' 23:59:59';
       
    }
    public function view(): View
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');
       
        return view('laporan.buku_excel', [
            'datas' =>  $this->datas->whereBetween('created_at', [ $this->from, $this->to])->get()
        ]);
    }
}
