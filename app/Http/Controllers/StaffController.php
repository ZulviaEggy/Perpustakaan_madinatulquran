<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Role;
use File;
use Image;
use Carbon;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Users::with('role')->whereIn('role_id',[2,3,4])
        ->orderBy('nama','ASC')
        ->get();
        return view('page.staff.staff', ['staff' => $staff]);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staff = Users::all();
        $role = Role::whereIn('id',[2,3,4])->get();
        return view('page.staff.tambah_staff', [ 'staff' => $staff, 'role' => $role]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama'          => ['required'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender'        => ['required'],
            'alamat'        => ['required'],
            'tempat_lahir'  => ['required'],
            'tanggal_lahir' => ['required'],
            'phone'         => ['required','unique:users'],
            'staff_id'      => ['required'],
            'role_id'       => ['required'],
        ],
        [
            'nama.required'         => 'Name can not be empty!',
            'email.required'        => 'Email can not be empty!',
            'email.email'           => 'Email must be a valid email address!',
            'email.unique'          => 'Email has already been taken!',
            'gender.required'       => 'Gender can not be empty!',
            'alamat.required'       => 'Adreess can not be empty!',
            'tempat_lahir.required' => 'Place of birth can not be empty!',
            'tanggal_lahir.required'=> 'Date of birth can not be empty!',
            'phone.required'        => 'Phone number can not be empty!',
            'phone.unique'          => 'Phone number has already been taken!',
            'staff_id.required'     => 'NIP can not be empty!',
            'role_id.required'      => 'Level can not be empty!',

        ]);

        $staff = new Users();
        $staff->nama            = $request->input('nama');
        $staff->email           = $request->input('email');
        $staff->gender          = $request->input('gender');
        $staff->alamat          = $request->input('alamat');
        $staff->tempat_lahir    = $request->input('tempat_lahir');
        $staff->tanggal_lahir   = $request->tanggal_lahir = Carbon\Carbon::parse($request->tanggal_lahir);
        $staff->phone           = $request->input('phone');
        $staff->staff_id        = $request->input('staff_id');
        $staff->role_id         = $request->input('role_id');
        $staff->password        = bcrypt($request->staff_id);
       
        $staff->save();
        alert()->success('Success.','Staff saved successfully!');
        return redirect()->route('staff.index');
    }
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = Users::find($id);
        $role = Role::all();
        return view('page.staff.detail_staff', [ 'staff' => $staff, 'role' => $role]);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = Users::find($id);
        $role = Role::whereIn('id',[2,3,4])->get();
        return view('page.staff.edit_staff', [ 'staff' => $staff, 'role' => $role]);
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
        //var_dump('bazinga');
        //die();
        $validatedData = $request->validate([
            'nama'         => ['required'],
            'email'        => ['required'],
            'phone'        => ['required'],
           
        ],
        [
            'nama.required' => 'Name can not be empty!',
        ]);
        $staff = Users::find($id);
        if($staff->email != $request->email){
            $this->validate($request,
            [
                'email' => ['string', 'email', 'max:255', 'unique:users'],
            ],
        [
            'email.unique' => 'Email has already been taken.',
            'email.email' =>'Email must be a valid email address!'
        ]);
        }
        if($staff->phone != $request->phone){
            $this->validate($request,
            [
                'phone' => ['unique:users'],
            ],
        [
            'phone.unique' => 'Phone has already been taken.',
        ]);
        }
        $staff->nama    = $request->input('nama');
        $staff->email   = $request->input('email');
        $staff->gender    = $request->input('gender');
        $staff->alamat    = $request->input('alamat');
        $staff->tempat_lahir    = $request->input('tempat_lahir');
        $staff->tanggal_lahir    = $request->tanggal_lahir = Carbon\Carbon::parse($request->tanggal_lahir);
        $staff->phone    = $request->input('phone');
        $staff->staff_id    = $request->input('staff_id');
        $staff->role_id    = $request->input('role_id');
      
        $staff->save();
        alert()->success('Success.','Data has been updated!');
        return redirect()->route('staff.index');
      }

      public function updatePasswordAdmin(Request $request, $id)
      {
          $staff = Users::find($id);
          $this->validate($request,
          [
            'password' => ['required', 'string', 'min:8', 'max:191'],
          ],
          [
              'password.required' => 'Password can not be empty!',
              'password.min' => 'Password must be at least 8 characters!',
              'password.max' => 'Password is too long'
          ]
        );
   
        $staff->password = $request->password = Hash::make($request->password);
        $staff->save();
          alert()->success('Success.','Password has been changed!');
          return redirect()->back();
        }

      
      public function editPhoto($id)
      {
          $staff = Users::find($id);
          return view('page.staff.edit_photo', ['staff' => $staff ]);
      }
  
  
      public function updatePhoto(Request $request, $id)
      {
          //var_dump('bazinga');
          //die();
          $validatedData = $request->validate([
              'photo'         => 'required|image|mimes:jpeg,png,jpg|max:2048'
          ]);
          $staff = Users::find($id);
         
          if ($request->hasFile('photo')){
            $image_path = public_path("/photo/profile/".$staff->photo);
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $file = $request->file('photo');
            $photo = $file->getClientOriginalName();
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = rand(11111,99999) . time() . '.' . $extension; 
            Image::make($file)->fit(300,300)->save(public_path('/photo/profile/'. $filename));
            $staff->photo =  $filename;
          } else {
              return $request;
              $staff->photo='';
          }
  
          $staff->save();
          alert()->success('Success.','Photo has been changed!');
          return redirect()->route('staff.edit',[$staff]);
        }

            /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $staff = Users::find($id);
        File::delete('photo/staff'.$staff->photo);
        if($staff){
            $staff->delete();
        }
        alert()->success('Success.','Data has been deleted!');
        return redirect()->route('staff.index');
    }
   

}
