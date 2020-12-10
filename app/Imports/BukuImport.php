<?php

namespace App\Imports;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\BukuValidationException;

class BukuImport implements ToCollection,  WithHeadingRow
{
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $rowsArray = $rows->toArray();
        $validator = Validator::make($rowsArray, [
            '*.kode_buku' => ['required','unique:buku'],
         ],
         [
            '*.kode_buku.unique' => 'book code {template} has already been taken!',
            '*.kode_buku.required' => 'book code {template} can not be empty!',
         ]);

         if ($validator->fails()) {
            $errorMessages = $validator->errors()->getMessages();
            $rowIndex = [];
            foreach (array_keys($errorMessages) as $key) {
                $index = explode('.', $key);
                $rowIndex[] = $index[0] + 2;
            }
            $errorResponse = [];
            $iterator = 0;
            foreach ($errorMessages as $error) {
                $errorResponse[] = str_replace('{template}', 'in row '.$rowIndex[$iterator], $error);
                $iterator++;
            }
            
            throw new BukuValidationException('test', 1, null, $errorResponse); 
        }


        foreach($rows as $row){
        Buku::create([
            'kode_buku'             => $row['kode_buku'],
            'judul_buku'            => $row['judul'],
            'kategori_id'           => $row['kategori_id'], 
            'edisi'                 => $row['edisi'], 
            'penulis'               => $row['penulis'],
            'kota_terbit'           => $row['kota_terbit'], 
            'volume'                => $row['volume'], 
            'deskripsi'             => $row['deskripsi'], 
            'penerbit'              => $row['penerbit'], 
            'tahun_terbit'          => $row['tahun_terbit'],
            'ISBN'                  => $row['isbn'],
            'jumlah'                => $row['jumlah'],
        ]);
        
        }
    }
}
