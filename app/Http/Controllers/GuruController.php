<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Guru;
use File;
use Excel;
use Image;
use App\Exports\GuruExport;
use App\User;
use App\Models\Users;
use App\Models\Role;
use App\Models\Noted;
use Auth;
use Carbon;
use PDF;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Imports\GuruImport;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;

use App\Exceptions\GuruImportValidationException;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::orderBy('NIP','ASC')->get();
        return view('page.guru.guru', ['guru' => $guru]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guru = Guru::all();
        return view('page.guru.tambah_guru', [ 'guru' => $guru]);
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
            'NIP'               => ['required','unique:guru','max:20'],
            'nama_lengkap'      => ['required'],
            'alamat'            => ['required'],
            'gender'            => ['required'],
            'tempat_lahir'      => ['required'],
            'tanggal_lahir'     => ['required'],
            'no_telp'           => ['required'],
            'agama'             => ['required'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:guru'],
            'status'            => ['required'],
        ],
        [
            'NIP.required'          => 'NIP can not be empty!',
            'NIP.unique'            => 'NIP has already been taken!',
            'NIP.max'               => 'NIP is too long!',
            'nama_lengkap.required' => 'Name can not be empty!',
            'alamat.required'       => 'Adreess can not be empty!',
            'gender.required'       => 'Gender can not be empty!',
            'tempat_lahir.required' => 'Place of birth can not be empty!',
            'tanggal_lahir.required'=> 'Date of birth can not be empty!',
            'no_telp.required'      => 'Phone number can not be empty!',
            'agama.required'        => 'Religion can not be empty!',
            'email.required'        => 'Email can not be empty!',
            'email.email'           => 'Email must be a valid email address!',
            'email.unique'          => 'Email has already been taken!',
            'status.required'       => 'Status can not be empty!',
        ]);
        $anggota = new Guru();
        if($anggota->photo != $request->photo){
            $this->validate($request,
            [
                'photo'         => 'required|image'
            ]);
        }
        date_default_timezone_set('Asia/Jakarta');
        $user           = new User;
        $user->nip      = $request->NIP;
        $user->password = bcrypt($request->NIP);
        $user->role_id  = 6;
        $user->profesi  = 'Guru';
        $user->save();

        $request->request->add(['user_id' => $user->id]);

        $guru = new Guru();
        $guru->user_id          = $request->input('user_id');
        $guru->NIP              = $request->input('NIP');
        $guru->nama_lengkap     = $request->input('nama_lengkap');
        $guru->alamat           = $request->input('alamat');
        $guru->gender           = $request->input('gender');
        $guru->tempat_lahir     = $request->input('tempat_lahir');
        $guru->tanggal_lahir    = $request->input('tanggal_lahir');
        $guru->no_telp          = $request->input('no_telp');
        $guru->agama            = $request->input('agama');
        $guru->email            = $request->input('email');
        $guru->status           = $request->input('status');
      
        $guru->save();
        alert()->success('Success.','Data saved successfully!');
        return redirect()->route('guru.index');
    }

      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guru = Guru::find($id);
        return view('page.guru.detail_guru', [ 'guru' => $guru ]);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guru = Guru::find($id);
        return view('page.guru.edit_guru', [ 'guru' => $guru ]);
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
            'NIP'               => ['required'],
            'nama_lengkap'      => ['required'],
            'email'             => ['required'],
           
        ]);
        $guru = Guru::find($id);
        if($guru->email != $request->email){
            $this->validate($request,
            [
                'email' => ['string', 'email', 'max:255', 'unique:guru'],
            ],
            [
                'email.unique' => 'Email has already been taken.',
                'email.email' =>'Email must be a valid email address!'
            ]);
            }
        $guru->NIP              = $request->input('NIP');
        $guru->nama_lengkap     = $request->input('nama_lengkap');
        $guru->alamat           = $request->input('alamat');
        $guru->gender           = $request->input('gender');
        $guru->tempat_lahir     = $request->input('tempat_lahir');
        $guru->tanggal_lahir    = $request->input('tanggal_lahir');
        $guru->no_telp          = $request->input('no_telp');
        $guru->agama            = $request->input('agama');
        $guru->email            = $request->input('email');
        $guru->status           = $request->input('status');
      
        $guru->save();
        alert()->success('Success.','Data has been updated!');
        return redirect()->route('guru.index');
      }

      public function kartuPdf($id)
      {
        $guru = Guru::find($id);
        $pdf = PDF::loadView('page.guru.kartu_guru', compact('guru'))->setPaper('a4','portrait');
        return $pdf->download('kartu_anggota_'.date('Y-m-d_H-i-s').'.pdf');
      }

      public function updatePhoto(Request $request, $id)
      {
          //var_dump('bazinga');
          //die();
          $validatedData = $request->validate([
              'photo'         => 'required|image|mimes:jpeg,png,jpg|max:2048'
          ]);
          $guru = Guru::find($id);
         
          if ($request->hasFile('photo')){
              $image_path = public_path("/photo/guru/".$guru->photo);
              if(File::exists($image_path)){
                  File::delete($image_path);
              }
              $file = $request->file('photo');
              $photo = $file->getClientOriginalName();
              $extension = strtolower($file->getClientOriginalExtension());
              $filename = rand(11111,99999) . time() . '.' . $extension; 
              Image::make($file)->fit(300,300)->save(public_path('/photo/guru/'. $filename));
              $guru->photo =  $filename;
          } else {
              return $request;
              $guru->photo='';
          }
  
          $guru->save();
          alert()->success('Success.','Photo has been changed!');
          return redirect()->route('guru.edit',[$guru]);
        }

            /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $guru = Guru::find($id);
        File::delete('photo/guru'.$guru->photo);
        if($guru){
            $guru->delete();
        }
        alert()->success('Success.','Data has been deleted!');
        return redirect()->route('guru.index');
    }

    public function format()
      {
        $nama = 'guru'.'.xlsx';
        return Excel::download(new GuruExport, $nama);
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
                $file->move('file_guru',$nama_file);
                
                
                    try {
                        $import = Excel::import(new GuruImport, public_path('/file_guru/'.$nama_file));
                        alert()->success('Success.','Data imported successfully!');
                        return redirect()->route('guru.index');
                
                    } catch (GuruImportValidationException $e) {
                        return redirect()->route('guru.index')->withErrors($e->getOptions()); 
                    }
            } else {
                alert()->error('Error','Selected file is '.$extension.' .please choose file xls or xlsx');
                return redirect()->route('guru.index'); 
            }
    }
}

    public function profileEdit($id)
    {
        $guru = Guru::find($id);
        
        if((Auth::user()->role_id == '6') && (Auth::user()->id != Auth::user()->guru->user_id)) {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
    }
        return view('user.user_guru.profile_user');
    }

    public function profileShow()
    {
       $user = Auth::user();
       $role = Role::all();
        return view('user.user_guru.profile_show', ['user' => $user,'role' =>$role]);
    }

    public function updateProfileGuru(Request $request, $id)
    {
        $validatedData = $request->validate([
            'email'             => ['required'],
            'tempat_lahir'      => ['required'],
            'tanggal_lahir'     => ['required'],
            'no_telp'           => ['required'],
           
        ],
        [
            'email.required'        => 'Email can not be empty!',
            'tempat_lahir.required' => 'Place of birth can not be empty!',
            'tanggal_lahir.required'=> 'Date of birth can not be empty!',
            'no_telp.required'      => 'Phone number can not be empty!',
        ]);
        
        $user = User::find($id);
        $user = User::where('id',$id)->first();
          
        if($user->save())
        {
        $guru = Guru::find($id);
        $guru = Guru::where('user_id',$id)->first();

        if($guru->email != $request->email){
            $this->validate($request,
            [
                'email' => ['string', 'email', 'max:255', 'unique:guru'],
            ],
            [
                'email.unique' => 'Email has already been taken.',
                'email.email' =>'Email must be a valid email address!'
            ]);
            }
        if($guru->no_telp != $request->no_telp){
            $this->validate($request,
            [
                'no_telp' => ['unique:guru'],
            ],
            [
                'no_telp.unique' => 'Phone has already been taken.',
            ]);
            }
       
            $guru->email = $request->input('email');
            $guru->nama_lengkap = $request->input('nama_lengkap');
            $guru->alamat = $request->input('alamat');
            $guru->tempat_lahir= $request->input('tempat_lahir');
            $guru->tanggal_lahir = $request->tanggal_lahir = Carbon\Carbon::parse($request->tanggal_lahir);
            $guru->gender= $request->input('gender');
            $guru->no_telp    = $request->input('no_telp');
    
        $guru->save();
        alert()->success('Success.','Data has been updated!');
        return redirect()->route('profileGuru.show');
    }
        return redirect()->back()->with('error','Something went wrong');
      }

      public function updatePhotoGuru(Request $request, $id)
      {
          //var_dump('bazinga');
          //die();

          $user = User::find($id);
          $user = User::where('id',$id)->first();
            
          if($user->save())
          {
        
            $guru = Guru::find($id);
            $guru = Guru::where('user_id',$id)->first();

            $validatedData = $request->validate([
                'photo'         => 'required|image|mimes:jpeg,png,jpg|max:2048'
              ]);
         
          if ($request->hasFile('photo')){
            $image_path = public_path("/photo/guru/".$guru->photo);
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $file = $request->file('photo');
            $photo = $file->getClientOriginalName();
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = rand(11111,99999) . time() . '.' . $extension; 
            Image::make($file)->fit(300,300)->save(public_path('/photo/guru/'. $filename));
            $guru->photo =  $filename;
        } else {
            return $request;
            $guru->photo='';
        }
  
        $guru->save();
        alert()->success('Success.','Photo has been updated!');
        return redirect()->route('profileGuru.show');
    }
        return redirect()->back()->with('error','Something went wrong');
      }
    
      public function ubahPassword(User $user)
      {
         $user = Auth::user();
         $role = Role::all();
          return view('user.user_guru.ganti_password', ['user' => $user,'role' =>$role]);
      }
  
      public function updatePassword(Request $request)
      {
         
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
            $usulan = Noted::where('nip', Auth::user()->nip)->get();
            $guru = Guru::all();
            return view('user.user_guru.list_usulan', ['user' => $user,'usulan' =>$usulan, 'guru' =>$guru]);
        }

        public function createUsulan()
        {
            $user = Auth::user();
            $usulan = Noted::all();
            $guru = Guru::all();
            return view('user.user_guru.usulan_guru', ['user' => $user,'usulan' =>$usulan, 'guru' =>$guru]);
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
                'deskripsi.max'        => 'The Description may not be greater than 255 characters.',
            ]
        );

            $usulan = new Noted();
            $usulan->nip        = $request->input('nip');
            $usulan->nama       = $request->input('nama');
            $usulan->judul      = $request->input('judul');
            $usulan->pengarang  = $request->input('pengarang');
            $usulan->deskripsi  = $request->input('deskripsi');
            $usulan->tanggal_usulan = Carbon\Carbon::now();
            $usulan->status     = 'Diproses';

            $usulan->save();
            alert()->success('Success.','Data sent successfully!');
            return redirect()->route('usulan.guru');
        
            return redirect()->back()->with('error','Something went wrong');
          }

          public function updateUsulan(Request $request, $id)
          {
         
              $usulan = Noted::find($id);
              $usulan->status= $request->input('status');
              $usulan->save();
              alert()->success('Success.','Data has been updated!');
              return redirect()->back();
            }
    
  
}
