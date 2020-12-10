<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Siswa;
use File;
use Excel;
use App\User;
use Auth;
use Image;
use Carbon;
use PDF;
use App\Models\Role;
use App\Models\Users;
use App\Models\Noted;
use Illuminate\Support\Facades\Hash;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\SiswaValidationException;
 

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::orderBy('NIS','ASC')->get();
        return view('page.siswa.siswa', ['siswa' => $siswa]);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswa = Siswa::all();
        return view('page.siswa.tambah_siswa', [ 'siswa' => $siswa]);
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
            'NIS'               => ['required','unique:siswa','max:20'],
            'nama_siswa'        => ['required'],
            'alamat'            => ['required'],
            'gender'            => ['required'],
            'kelas'             => ['required'],
            'tempat_lahir'      => ['required'],
            'tanggal_lahir'     => ['required'],
            'no_telp'           => ['required'],
            'agama'             => ['required'],
            'tahun_angkatan'    => ['required'],
            'status'            => ['required'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:siswa'],
        ],
        [
            'NIS.required'          => 'NIS can not be empty!',
            'NIS.unique'            => 'NIS has already been taken!',
            'NIS.max'               => 'NIS is too long!',
            'nama_siswa.required'   => 'Name can not be empty!',
            'alamat.required'       => 'Adreess can not be empty!',
            'gender.required'       => 'Gender can not be empty!',
            'kelas.required'        => 'Class can not be empty!',
            'tempat_lahir.required' => 'Place of birth can not be empty!',
            'tanggal_lahir.required'=> 'Date of birth can not be empty!',
            'no_telp.required'      => 'Phone number can not be empty!',
            'agama.required'        => 'Religion can not be empty!',
            'tahun_angkatan.required'=> 'School year can not be empty!',
            'status.required'       => 'Status can not be empty!',
            'email.required'        => 'Email can not be empty!',
            'email.email'           => 'Email must be a valid email address!',
            'email.unique'          => 'Email has already been taken!',
        ]
    );
        $user = new User;
        $user->nis = $request->NIS;
        $user->password = bcrypt($request->NIS);
        $user->role_id = 5;
        $user->profesi= 'Siswa';
        $user->save();
    
        $request->request->add(['user_id' => $user->id]);

        $siswa = new Siswa();
        $siswa->user_id   = $request->input('user_id');
        $siswa->NIS    = $request->input('NIS');
        $siswa->nama_siswa    = $request->input('nama_siswa');
        $siswa->alamat    = $request->input('alamat');
        $siswa->gender    = $request->input('gender');
        $siswa->kelas    = $request->input('kelas');
        $siswa->tempat_lahir    = $request->input('tempat_lahir');
        $siswa->tanggal_lahir    = $request->input('tanggal_lahir');
        $siswa->no_telp    = $request->input('no_telp');
        $siswa->agama   = $request->input('agama');
        $siswa->tahun_angkatan    = $request->input('tahun_angkatan');
        $siswa->status    = $request->input('status');
        $siswa->email    = $request->input('email');
       
        $siswa->save();
        alert()->success('Success.','Data saved successfully!');
        return redirect()->route('siswa.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa = Siswa::find($id);
        return view('page.siswa.detail_siswa', [ 'siswa' => $siswa ]);
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::find($id);
        $user = Users::find($id);
        return view('page.siswa.edit_siswa', [ 'siswa' => $siswa, 'user' => $user ]);
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
            'NIS'               => ['required'],
            'nama_siswa'        => ['required'],
            'email'             => ['required'],
           
        ]);
        $siswa = Siswa::find($id);
        if($siswa->NIS != $request->NIS){
            $this->validate($request,
            [
                'NIS' => ['unique:siswa'],
            ],
        [
            'NIS.unique'            => 'NIS has already been taken!',
        ]);
        }
        if($siswa->email != $request->email){
            $this->validate($request,
            [
                'email' => ['string', 'email', 'max:255', 'unique:siswa'],
            ],
        [
            'email.unique' => 'Email has already been taken.',
            'email.email' =>'Email must be a valid email address!'
        ]);
        }
        $siswa->NIS    = $request->input('NIS');
        $siswa->nama_siswa    = $request->input('nama_siswa');
        $siswa->alamat    = $request->input('alamat');
        $siswa->gender    = $request->input('gender');
        $siswa->kelas    = $request->input('kelas');
        $siswa->tempat_lahir    = $request->input('tempat_lahir');
        $siswa->tanggal_lahir    = $request->input('tanggal_lahir');
        $siswa->no_telp    = $request->input('no_telp');
        $siswa->tahun_angkatan    = $request->input('tahun_angkatan');
        $siswa->status    = $request->input('status');
        $siswa->agama   = $request->input('agama');
        $siswa->email    = $request->input('email');
      
        $siswa->save();
        alert()->success('Success.','Data has been updated!');
        return redirect()->route('siswa.index');
      }

      public function updatePasswordAdmin(Request $request, $id)
      {
          //var_dump('bazinga');
          //die();
          $siswa = Siswa::find($id);
          $user = Users::where('id',$siswa->user_id)->first();
          $request->validate([
            'password' => ['required', 'string', 'min:8', 'max:191'],
          ],
          [
              'password.required' => 'Password can not be empty!',
              'password.min' => 'Password must be at least 8 characters!',
              'password.max' => 'Password is too long'
          ]
        );
   
        $user->password = Hash::make($request->password);
        $user->save;
          alert()->success('Success.','Password has been changed!');
          return redirect()->back();
        }

     
      public function kartuPdf($id)
      {
          $siswa = Siswa::find($id);
          $pdf = PDF::loadView('page.siswa.kartu_siswa', compact('siswa'))->setPaper('a4','portrait');
          return $pdf->download('kartu_anggota_'.date('Y-m-d_H-i-s').'.pdf');
      }
  
  
      public function updatePhoto(Request $request, $id)
      {
          //var_dump('bazinga');
          //die();
          $validatedData = $request->validate([
              'photo'         => 'required|image|mimes:jpeg,png,jpg|max:2048'
          ]);
          $siswa = Siswa::find($id);
         
          if ($request->hasFile('photo')){
              $image_path = public_path("/photo/siswa/".$siswa->photo);
              if(File::exists($image_path)){
                  File::delete($image_path);
              }
              $file = $request->file('photo');
              $photo = $file->getClientOriginalName();
              $extension = strtolower($file->getClientOriginalExtension());
              $filename = rand(11111,99999) . time() . '.' . $extension; 
              Image::make($file)->fit(300,300)->save(public_path('/photo/siswa/'. $filename));
              $siswa->photo =  $filename;
          } else {
              return $request;
              $siswa->photo='';
          }
  
          $siswa->save();
          alert()->success('Success.','Photo has been updated!');
          return redirect()->route('siswa.edit',[$siswa]);
        }

            /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $siswa = Siswa::find($id);
        File::delete('photo/siswa'.$siswa->photo);
        if($siswa){
            $siswa->delete();
        }
        alert()->success('Success.','Data has been deleted!');
        return redirect()->route('siswa.index');
    }

    public function format()
      {
        $nama = 'siswa'.'.xlsx';
        return Excel::download(new SiswaExport, $nama);
      }

      public function import(Request $request) 
	{
	
		$this->validate($request, [
			'file' => 'required'
        ],
        [
            'file.required'  => 'File can not be empty!',
        ]);
        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if($extension == "xlsx" || $extension == "xls"){
            $file = $request->file('file');
            $nama_file = rand().$file->getClientOriginalName();
            $file->move('file_siswa',$nama_file);
        
                try{
                    $import = Excel::import(new SiswaImport, public_path('/file_siswa/'.$nama_file));
                    alert()->success('Success.','Data imported successfully!');
                    return redirect()->route('siswa.index');  
                } catch (SiswaValidationException $e) {
                    return redirect()->route('siswa.index')->withErrors($e->getOptions()); 
                    // alert()->error('Error','Please check the file, either duplicate data or wrong format');
                    //     return redirect()->route('siswa.index');   
                    }
            } else {
                alert()->error('Error','Selected file is '.$extension.' .please choose file xls or xlsx');
            return redirect()->route('siswa.index');   
            }
        }
    }
    
    public function profileEditSiswa(User $user)
    {
       $user = Auth::user();
       $role = Role::all();
        return view('user.user_siswa.profile_siswa', ['user' => $user,'role' =>$role]);
    }

    public function profileShowSiswa()
    {
       $user = Auth::user();
       $role = Role::all();
        return view('user.user_siswa.profilSiswa_show', ['user' => $user,'role' =>$role]);
    }

    public function updateProfileSiswa(Request $request, $id)
    {
         
        $validatedData = $request->validate([
            
            'alamat'            => ['required'],
            'gender'            => ['required'],
            'tempat_lahir'      => ['required'],
            'tanggal_lahir'     => ['required'],
            'no_telp'           => ['required'],
            'agama'             => ['required'],
            'email'             => ['required'],
        ],
        [
           
            'alamat.required'       => 'Adreess can not be empty!',
            'gender.required'       => 'Gender can not be empty!',
            'tempat_lahir.required' => 'Place of birth can not be empty!',
            'tanggal_lahir.required'=> 'Date of birth can not be empty!',
            'no_telp.required'      => 'Phone number can not be empty!',
            'agama.required'        => 'Religion can not be empty!',
            'email.required'        => 'Email can not be empty!',
           
        ]
    );

        $user = User::find($id);
        $user = User::where('id',$id)->first();
          
        if($user->save())
        {
           
            $siswa = Siswa::find($id);
            $siswa = Siswa::where('user_id',$id)->first();

            if($siswa->email != $request->email){
                $this->validate($request,
                [
                    'email' => ['string', 'email', 'max:255', 'unique:siswa'],
                ],
            [
                'email.unique' => 'Email has already been taken.',
                'email.email' =>'Email must be a valid email address!'
            ]);
            }
            if($siswa->no_telp != $request->no_telp){
                $this->validate($request,
                [
                    'no_telp' => ['unique:siswa'],
                ],
            [
                'no_telp.unique' => 'Phone has already been taken.',
            ]);
            }
        
            $siswa->NIS    = $request->input('NIS');
            $siswa->nama_siswa    = $request->input('nama_siswa');
            $siswa->alamat    = $request->input('alamat');
            $siswa->gender    = $request->input('gender');
            $siswa->tempat_lahir    = $request->input('tempat_lahir');
            $siswa->tanggal_lahir    = $request->tanggal_lahir = Carbon\Carbon::parse($request->tanggal_lahir);
            $siswa->no_telp    = $request->input('no_telp');
            $siswa->agama   = $request->input('agama');
            $siswa->email    = $request->input('email');
       
         
        $siswa->save();
        alert()->success('Success.','Data has been updated!');
        return redirect()->route('profileSiswa.show');
    }
        return redirect()->back()->with('Error','Something went wrong');
       
      }
      public function editPhotoSiswa($id)
      {
          $siswa = Siswa::find($id);
          return view('user.user_siswa.edit_photoSiswa', ['siswa' => $siswa ]);
      }
  
  
      public function updatePhotoSiswa(Request $request, $id)
      {
          //var_dump('bazinga');
          //die();

          $user = User::find($id);
          $user = User::where('id',$id)->first();
            
          if($user->save())
          {
          
          $siswa = Siswa::find($id);
          $siswa = Siswa::where('user_id',$id)->first();

          $validatedData = $request->validate([
            'photo'         => 'required|image|mimes:jpeg,png,jpg|max:2048'
          ],
          ['image.max' => "The uploaded image must be smaller than 2M"]);
         
          if ($request->hasFile('photo')){
              $image_path = public_path("/photo/siswa/".$siswa->photo);
              if(File::exists($image_path)){
                  File::delete($image_path);
              }
              $file = $request->file('photo');
              $photo = $file->getClientOriginalName();
              $extension = strtolower($file->getClientOriginalExtension());
              $filename = rand(11111,99999) . time() . '.' . $extension; 
              Image::make($file)->fit(300,300)->save(public_path('/photo/siswa/'. $filename));
              $siswa->photo =  $filename;
          } else {
              return $request;
              $siswa->photo='';
          }
  
          $siswa->save();
          alert()->success('Success.','Photo has been changed!');
        return redirect()->route('profileSiswa.show');
    }
        return redirect()->back()->with('Error','Something went wrong');
       
      }
      public function ubahPassword(User $user)
      {
         $user = Auth::user();
         $role = Role::all();
          return view('user.user_siswa.ganti_password', ['user' => $user,'role' =>$role]);
      }
  
      public function updatePassword(Request $request)
      {
          //var_dump('bazinga');
          //die();
          $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'string', 'min:8'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        
          alert()->success('Success.','Password has been changed!');
          return redirect()->back();
        }

     

        public function Usulan()
        {
            $user = Auth::user();
            $usulan = Noted::where('nis', Auth::user()->nis)->get();
            $siswa = Siswa::all();
            return view('user.user_siswa.list_usulan', ['user' => $user,'usulan' =>$usulan, 'siswa' =>$siswa]);
        }

        public function createUsulan()
        {
            $user = Auth::user();
            $usulan = Noted::all();
            $siswa = Siswa::all();
            return view('user.user_siswa.usulan_siswa', ['user' => $user,'usulan' =>$usulan, 'siswa' =>$siswa]);
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function storeUsulan(Request $request)
        {
            date_default_timezone_set('Asia/Jakarta');
            $validatedData = $request->validate([

                'judul'            => ['required'],
                'pengarang'        => ['required'],
                'deskripsi'         => ['required', 'max:255'],
            ],
            [
                'judul.required'       => 'Book title can not be empty!',
                'pengarang.required'   => 'Author can not be empty!',
                'deskripsi.required'   => 'Description can not be empty!',
                'deskripsi.max'        => 'The Description may not be greater than 255 characters.',
            ]
            );

            $usulan = new Noted();
           
            $usulan->nis = $request->input('nis');
            $usulan->nama = $request->input('nama');
            $usulan->judul = $request->input('judul');
            $usulan->pengarang = $request->input('pengarang');
            $usulan->deskripsi = $request->input('deskripsi');
            $usulan->tanggal_usulan = Carbon\Carbon::now();
            $usulan->status= 'Diproses';

              
            $usulan->save();
            alert()->success('Success.','Data sent successfully!');
            return redirect()->route('usulan.siswa');
        
            return redirect()->back()->with('Error','Something went wrong');
          }

          public function updateUsulan(Request $request, $id)
          {
         
              $usulan = Noted::find($id);
              $usulan->status= $request->input('status');
              $usulan->save();
              alert()->success('Success','Data has been updated');
              return redirect()->back();
            }
    
}
