<?php

namespace App\Imports;

use App\Models\Guru;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Facades\Validator;
use Throwable;
use App\Exceptions\GuruImportValidationException;


class GuruImport implements 
ToCollection,
WithHeadingRow,
WithValidation


{
    use Importable;
   
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
            '*.email' => ['required', 'email', 'unique:guru,email'],
            '*.nip'   => ['required','unique:guru'],
            '*.alamat'   => ['required'],
            '*.gender'   => ['required'],
            '*.tempat_lahir'   => ['required'],
            '*.tanggal_lahir'   => ['required'],
            '*.no_telp'   => ['required'],
            '*.agama'   => ['required'],
            '*.status'   => ['required'],

         ],
         [
            '*.email.unique' => 'Email {template} has already been taken!',
            '*.email.required' => 'Email {template} can not be empty!',
            '*.email.email' => 'Email {template} must be a valid email address',
            '*.nip.unique' => 'NIS {template} has already been taken!',
            '*.nip.required' => 'NIS {template} can not be empty!',
            '*.alamat.required' => 'Alamat {template} can not be empty!',
            '*.gender.required' => 'Gender {template} can not be empty!',
            '*.tempat_lahir.required' => 'Tempat lahir {template} can not be empty!',
            '*.tanggal_lahir.required' => 'Tanggal lahir {template} can not be empty!',
            '*.no_telp.required' => 'No Telp {template} can not be empty!',
            '*.agama.required' => 'Agama {template} can not be empty!',
            '*.status.required' => 'Status {template} can not be empty!'
         ]
         );

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
            
            throw new GuruImportValidationException('test', 1, null, $errorResponse);
        }

        foreach($rows as $row)
            {
            $user = new User;
            $user->nip = $row['nip'];
            $user->password = bcrypt($row['nip']);
            $user->role_id = 6;
            $user->profesi= 'Guru';
            $user->save();

            $user = Guru::create([
                'user_id'         => $user->id,
                'NIP'             => $row['nip'],
                'nama_lengkap'    => $row['nama_lengkap'],
                'alamat'          => $row['alamat'], 
                'gender'          => $row['gender'],
                'tempat_lahir'    => $row['tempat_lahir'],
                'tanggal_lahir'   => $this->transformDate($row['tanggal_lahir']),
                'no_telp'         => $row['no_telp'],
                'agama'           => $row['agama'],
                'email'           => $row['email'],
                'status'           => $row['status'],
            ]);
            
        }
    }
//     public function validationFields( $row )
//   {

//       $customMessages = [
//           'required' => 'O campo :attribute deve estar preenchido'
//       ];

//       Validator::make($row->toArray(), [
//         '*.email' => ['required','unique:guru'],
//         '*.nip'   => ['required','unique:guru'],
//         '*.alamat'   => ['required'],
//         '*.gender'   => ['required'],
//         '*.tempat_lahir'   => ['required'],
//         '*.tanggal_lahir'   => ['required'],
//         '*.no_telp'   => ['required'],
//         '*.agama'   => ['required'],
//         '*.status'   => ['required'],
//       ], $customMessages)->validate();
//  }
    public function rules(): array
    {
        // return [
        //     '*.email' => 'email', 'unique:guru,email',
        //     '*.nip'   => ['required','unique:guru'],
        //     '*.alamat'   => ['required'],
        //     '*.gender'   => ['required'],
        //     '*.tempat_lahir'   => ['required'],
        //     '*.tanggal_lahir'   => ['required'],
        //     '*.no_telp'   => ['required'],
        //     '*.agama'   => ['required'],
        //     '*.status'   => ['required'],
        // ];
    }


    public function onFailure(Failure ...$failure)
    {
    }
}