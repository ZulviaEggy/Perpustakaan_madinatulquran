<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buku;
use App\Models\Role;
use App\Models\Users;
use App\Models\Noted;
use App\User;
use File;
use Image;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Kategori;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        if(in_array(Auth::user()->role_id,[5,6])){
            $peminjaman = Peminjaman::get();
            $buku      = Buku::get();
            $datas = Peminjaman::where('status_id', '=','3')->get();
            $terbaru    = Buku::with('kategori')
                        ->orderBy('created_at','DESC')
                        ->limit(4)
                        ->get();
            if( Auth::user()->nis != ''){
            $usulan = Noted::where('nis', Auth::user()->nis)->get();
            }else{
            $usulan = Noted::where('nip', Auth::user()->nip)->get();
            }
         
        return view('user.dashboard', compact('peminjaman', 'buku','terbaru','datas','usulan'));
    }

        // return redirect('login')->with('alert', 'You do not have access');
    }
     

        public function register(Request $request){

            $role = Role::whereIn('id',[1,2,3,4])->get();
            return view('auth.register', [ 'role' => $role]);
        }
    
        public function registerPost(Request $request){
            $this->validate($request, [
                'nama' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role_id' => ['required'],
            ]);
    
            User::create([
                'nama' => $request['nama'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'role_id' => $request['role_id'],
            ]);

            return redirect('login')->with('alert-success','Kamu berhasil Register');
        }

    public function login(){
        $role = Role::all();
        return view('auth.login',  [ 'role' => $role]);
    }

    public function loginPost(Request $request){

  
        $email = $request->email;
        $password = $request->password;

        $data = User::where('email',$email)->first();
        if($data){ //apakah email tersebut ada atau tidak
            if(Hash::check($password,$data->password)){
                Session::put('email',$data->email);   
                Session::put('nama',$data->nama);
                Session::put('role_id',$data->role_id);
                Session::put('login',TRUE);
                return redirect('home');
            }
            else{
                return redirect('login')->with('alert','Password atau Email Salah');
            }
        }
        else{
            return redirect('login')->with('alert','Password atau Email Salah!');
        }
    }

    public function logout(){
        Session::flush();
        return redirect('login')->with('alert','Kamu sudah logout');
    }

    public function profileShow()
    {
       $user = Auth::user();
       $role = Role::all();
        return view('dashboard.profile_show', ['user' => $user,'role' =>$role]);
    }

    public function profile(User $user)
    {
       $user = Auth::user();
       $role = Role::all();
        return view('dashboard.profile', ['user' => $user,'role' =>$role]);
    }

    public function updateProfile(Request $request)
    {
      
        $userDetails = Auth::user();
        $user = Users::find($userDetails->id);
        $validatedData = $request->validate([
            'nama'         => 'required',
            'email'        => 'required',
            'gender'       => 'required',
            'alamat'       => 'required',
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'phone'         => ['required'],

        ],
    [
            'nama.required'         => 'Name can not be empty!',
            'email.required'        => 'Email can not be empty!',
            'email.email'           => 'Email must be a valid email address!',
            'email.unique'          => 'Email has already been taken!',
            'gender.required'       => 'Gender can not be empty!',
            'tempat_lahir.required' => 'Place of birth can not be empty!',
            'tanggal_lahir.required'=> 'Date of birth can not be empty!',
            'phone.required'        => 'Phone number can not be empty!',
            'phone.unique'          => 'Phone number has already been taken!',

    ]);
        if($user->email != $request->email){
            $this->validate($request,
            [
                'email' => ['string', 'email', 'max:255', 'unique:users'],
            ],
        [
            'email.unique' => 'Email has already been taken.',
            'email.email' =>'Email must be a valid email address!'
        ]);
        }
        if($user->phone != $request->phone){
            $this->validate($request,
            [
                'phone' => ['unique:users'],
            ],
        [
            'phone.unique' => 'Phone has already been taken.',
        ]);
        }
        
        $user->nama    = $request->input('nama');
        $user->email   = $request->input('email');
        $user->gender    = $request->input('gender');
        $user->alamat    = $request->input('alamat');
        $user->tempat_lahir    = $request->input('tempat_lahir');
        $user->tanggal_lahir    = $request->input('tanggal_lahir');
        $user->phone    = $request->input('phone');
     

        $user->save();
        alert()->success('Success.','Data profile has been updated!');
        return redirect()->route('profile_show', array('user' => Auth::user()));
      }

      public function updateProfilePhoto(Request $request)
      {
          //var_dump('bazinga');
          //die();
          $userDetails = Auth::user();
          $user = Users::find($userDetails->id);
          $validatedData = $request->validate([
            'photo'         => ['required','image','mimes:jpeg,png,jpg','max:2048'],
          ]
        );
      
          if ($request->hasFile('photo')){
              $image_path = public_path("/photo/profile/".$user->photo);
              if(File::exists($image_path)){
                  File::delete($image_path);
              }
              $file = $request->file('photo');
              $photo = $file->getClientOriginalName();
              $extension = strtolower($file->getClientOriginalExtension());
              $filename = rand(11111,99999) . time() . '.' . $extension; 
              Image::make($file)->fit(300,300)->save(public_path('/photo/profile/'. $filename));
              $user->photo =  $filename;
          } else {
             
              $user->photo='';
          }
  
          $user->save();
          alert()->success('Success.','Data photo has been changed!');
          return redirect()->route('profile_show', array('user' => Auth::user()));
        }
  

      public function updatePasswordAdmin(Request $request)
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
    
  
}
    
