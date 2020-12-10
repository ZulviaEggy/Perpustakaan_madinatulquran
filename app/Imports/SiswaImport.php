<?php

namespace App\Imports;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\SiswaValidationException;

class SiswaImport implements ToCollection,  WithHeadingRow
{
    public function transformDate($value, $format = 'Y-m-d'){
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $rowsArray = $rows->toArray();
        $validator = Validator::make($rowsArray, [
            '*.email' => ['required','unique:siswa'],
            '*.nis'   => ['required','unique:siswa'],
            '*.alamat'   => ['required'],
            '*.gender'   => ['required'],
            '*.kelas'   => ['required'],
            '*.tempat_lahir'   => ['required'],
            '*.tanggal_lahir'   => ['required'],
            '*.no_telp'   => ['required'],
            '*.agama'   => ['required'],
            '*.tahun_angkatan'   => ['required'],
            '*.status'   => ['required'],
         ],
         [
            '*.email.unique' => 'Email {template} has already been taken!',
            '*.email.required' => 'Email {template} can not be empty!',
            '*.nis.unique' => 'NIS {template} has already been taken!',
            '*.nis.required' => 'NIS {template} can not be empty!',
            '*.alamat.required' => 'Alamat {template} can not be empty!',
            '*.gender.required' => 'Gender {template} can not be empty!',
            '*.kelas.required' => 'Kelas {template} can not be empty!',
            '*.tempat_lahir.required' => 'Tempat lahir {template} can not be empty!',
            '*.tanggal_lahir.required' => 'Tanggal lahir {template} can not be empty!',
            '*.no_telp.required' => 'No telp {template} can not be empty!',
            '*.agama.required' => 'Agama {template} can not be empty!',
            '*.tahun_angkatan.required' => 'Tahun Angkatan {template} can not be empty!',
            '*.status.required' => 'Tahun Angkatan {template} can not be empty!',

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
            
            throw new SiswaValidationException('test', 1, null, $errorResponse); 
        }

        foreach($rows as $row)
        {
            $user = new User;
            $user->nis = $row['nis'];
            $user->password = bcrypt($row['nis']);
            $user->role_id = 5;
            $user->profesi= 'Siswa';
            $user->save();

        Siswa::create([
            'NIS'             => $row['nis'],
            'user_id'         => $user->id,
            'nama_siswa'      => $row['nama_siswa'],
            'alamat'          => $row['alamat'], 
            'gender'          => $row['gender'],
            'kelas'           => $row['kelas'], 
            'tempat_lahir'    => $row['tempat_lahir'],
            'tanggal_lahir'   => $this->transformDate($row['tanggal_lahir']),
            'no_telp'         => $row['no_telp'],
            'agama'           => $row['agama'],
            'tahun_angkatan'  => $row['tahun_angkatan'],
            'status'          => $row['status'],
            'email'           => $row['email'],
        ]);
        }
    }
}
