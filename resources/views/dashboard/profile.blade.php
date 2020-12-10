
@extends('dashboard.base')

@section('css')

	<!-- Core JS files -->
	<script src="{{asset('/global_assets')}}/js/main/jquery.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/main/bootstrap.bundle.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
    <script src="{{asset('/global_assets')}}/js/plugins/forms/selects/select2.min.js"></script>
    <script src="{{asset('/global_assets')}}/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="{{asset('/global_assets')}}/js/plugins/forms/validation/validate.min.js"></script>

	<script src="{{asset('/assets')}}/js/app.js"></script>
	<script src="{{asset('/global_assets')}}/js/demo_pages/form_inputs.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/form_layouts.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/form_validation.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/form_checkboxes_radios.js"></script>
	<!-- /theme JS files -->
<script type="text/javascript">

	var check = function() {
	if (document.getElementById('password').value ==
		document.getElementById('confirm_password').value) {
		document.getElementById('submit').disabled = false;
		document.getElementById('message').style.color = 'green';
		document.getElementById('message').innerHTML = 'matching';
	} else {
		document.getElementById('submit').disabled = true;
		document.getElementById('message').style.color = 'red';
		document.getElementById('message').innerHTML = 'not matching';
	}
	}
</script>
            
<!-- Page content -->
<div class="page-content">

	<!-- Main sidebar -->
	<div class="sidebar sidebar-dark sidebar-main sidebar-fixed sidebar-expand-md">

		<!-- Sidebar content -->
		<div class="sidebar-content">

		</div>
		<!-- /sidebar content -->
			
	</div>
	<!-- /main sidebar -->

	<!-- Main content -->
	<div class="content-wrapper">

		<!-- Page header -->
		<div class="page-header page-header-light">
			<div class="page-header-content header-elements-md-inline">
				<div class="page-title d-flex">
					<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
				</div>
			</div>
			<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
				<div class="d-flex">
					<div class="breadcrumb">
						<a href="{{ url('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
						<a href="{{ route('profile_show') }}" class="breadcrumb-item"> Detail Profil</a>
						<span class="breadcrumb-item active">Edit profile</span>
					</div>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
				</div>
				<div class="header-elements d-none">
					<div class="breadcrumb justify-content-center">
					</div>
				</div>
			</div>
		</div>
		<!-- /page header -->

		<!-- Content area -->
		<div class="content">
           
			<!-- Form inputs -->
			<div class="card">

               <!-- Basic layout-->
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Ubah Profile</h5>
					<div class="header-elements">
						<div class="list-icons">
				            <a class="list-icons-item" data-action="collapse"></a>
				        </div>
			        </div>
				</div>
							
				<div class="card-body">
                <form method="POST" action="{{ route('profile.update', $user) }}" enctype="multipart/form-data">
                @csrf
				@method('PUT')
                    <div class="row">
                        <div class="col-xl-12 col-md-6">
                            <div class="card card-body">
                                <div class="media">
                                    <div class="mr-3">
                                        <a href="#">
										@if(Auth::user()->photo == '')
                                            <img src="{{asset('/global_assets')}}/images/placeholders/people.png" width="70" height="70" class="rounded-circle" alt=""></a>
                                        @else
                                            <img class="rounded-circle mr-2" src="{{ url('/photo/profile/'.Auth::user()->photo) }}" width="70" height="70" alt="">
                                        @endif                                                                
										</a>
                                    </div>
                                    <div class="media-body align-self-center">
                                        <div class="font-weight-semibold">{{$user->nama}}</div>
                                            <span class="text-muted">{{$user->role->privilege_level}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                                
					<div class="form-group row{{ $errors->has('nama') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Username:</label>
					    <div class="col-lg-9">
						    <input class="form-control" type="text" placeholder="Masukkan username" name="nama" value="{{$user->nama}}" autofocus>
					    	@if ($errors->has('nama'))
								<span class="help-block">
									<strong>{{ $errors->first('nama') }}</strong>
								</span>
							@endif
						</div>
					</div>

             	    <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Email: </label>
						<div class="col-lg-9">
							<input class="form-control" type="text" placeholder="Masukkan email"  value="{{$user->email}}" name="email" readonly="">
							@if ($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
							@endif
					   </div>
					</div>

                    <div class="form-group row{{ $errors->has('alamat') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Alamat:</label>
						<div class="col-lg-9">
							<input class="form-control" type="text" placeholder="Masukkan alamat" value="{{$user->alamat}}" name="alamat">
							@if ($errors->has('alamat'))
								<span class="help-block">
									<strong>{{ $errors->first('alamat') }}</strong>
								</span>
							@endif
					   </div>
					</div>
                                    
                    <!-- gender_id -->
                    <div class="form-group row{{ $errors->has('gender') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Jenis Kelamin:</label>
						<div class="col-lg-9">
						<div class="form-check form-check-inline">
                            <label class="form-check-label" for="gender" >
								<input type="radio" class="form-input-styled" name="gender" value="L" id="gender" {{$user->gender == 'L' ? 'checked' : ''}}>
								Laki-laki
							</label>
						</div>
						<div class="form-check form-check-inline">
							<label class="form-check-label" for="gender" >
								<input type="radio" class="form-input-styled" name="gender" value="P" id="gender"  {{$user->gender == 'P' ? 'checked' : ''}}>
								Perempuan
							</label>
						</div>
						</div>
					</div>
									
					<div class="form-group row{{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
        	            <label for="tempat_lahir" class="col-form-label col-md-3">Tempat Lahir</label>
                        <div class="col-md-6">
                    	    <input id="tempat_lahir" type="text" class="form-control" name="tempat_lahir" value="{{ $user->tempat_lahir }}">
                            @if ($errors->has('tempat_lahir'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                </span>
                            @endif
                        </div>
        	        </div>
									
                    <div class="form-group row{{ $errors->has('tanggal_lahir') ? ' has-error' : '' }}">
                        <label for="tgl_lahir" class="col-form-label col-md-3">Tanggal Lahir</label>
                        <div class="col-md-6">
                            <input id="tanggal_lahir" type="date" class="form-control" name="tanggal_lahir" value="{{ $user->tanggal_lahir }}">
                            @if ($errors->has('tanggal_lahir'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                              
                    <div class="form-group row{{ $errors->has('phone') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">No Telepon:</label>
						<div class="col-lg-9">
							<input class="form-control" type="text" placeholder="No telepon" value="{{$user->phone}}" name="phone" >
							@if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
						</div>
					</div>

				
								
					<div class="text-right">
                        <button class="btn btn-success col-lg-2 ml-1" type="submit" >Update</button>
                            <a href="{{ url('/profile') }}"  class="btn btn-danger col-lg-1 ml-1">Kembali</a>
					</div>
					</form>
				</div>
			</div>
			<!-- /basic layout -->
			   <!-- Form inputs -->
			   <div class="card">

				<!-- Basic layout-->
				<div class="card-header header-elements-inline">
				<h5 class="card-title">Ubah Photo</h5>
				<div class="header-elements">
					<div class="list-icons">
						<a class="list-icons-item" data-action="collapse"></a>
					</div>
				</div>
				</div>
					
				<div class="card-body">
				<form method="POST" action="{{ route('profilePhoto.update') }}" enctype="multipart/form-data">
				@csrf
				@method('PUT')
			
				<div class="form-group row{{ $errors->has('photo') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Edit Photo:</label>
						<div class="col-lg-9">
							<input type="file" class="form-control h-auto" name="photo">
								<span class="form-text text-muted">Accepted formats: png, jpg and max file size 2Mb</span>
								@if ($errors->has('photo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            	@endif
						</div>
					</div>
							
				<div class="text-right">
					<button class="btn btn-success col-lg-2 ml-1" type="submit" >Simpan</button>
				</div>
				</form>
				</div>
				</div>

                        
									
		   <!-- Form inputs -->
		   <div class="card">

		  		<!-- Basic layout-->
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Ubah password</h5>
					<div class="header-elements">
						<div class="list-icons">
				            <a class="list-icons-item" data-action="collapse"></a>
				        </div>
			        </div>
				</div>
					   
				<div class="card-body">
					<form method="POST" action="{{ route('profile.updatePassword') }}" enctype="multipart/form-data">
					@csrf
					<!-- @foreach ($errors->all() as $error)
					<div class="alert alert-danger">{{ $error }}</div>
					@endforeach  -->

					<div class="form-group row{{ $errors->has('current_password') ? ' has-error' : '' }}">
						<label for="password" class="col-lg-3 col-form-label">Current password</label>
						<div class="col-lg-9">
							<input id="password" type="password" name="current_password" class="form-control" placeholder="Current Password" autocomplete="current-password">
							@if ($errors->has('current_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current_password') }}</strong>
                                </span>
                            @endif
						</div>
					</div>

					<div class="form-group row{{ $errors->has('new_password') ? ' has-error' : '' }}">
						<label for="password" class="col-lg-3 col-form-label">New password</label>
						<div class="col-lg-9">
							<input id="new_password" type="password"  placeholder="{{ __('Password') }}" class="form-control" onkeyup='check();' name="new_password" autocomplete="current-password">
							@if ($errors->has('new_password'))
								<span class="help-block">
									<strong>{{ $errors->first('new_password') }}</strong>
								</span>
							@endif
						</div>
					</div>

					<div class="form-group row{{ $errors->has('new_confirm_password') ? ' has-error' : '' }}">
						<label for="password-confirm" class="col-lg-3 col-form-label">Re-type new password</label>
						<div class="col-lg-9">
							<input id="new_confirm_password" type="password" class="form-control" onkeyup="check()" placeholder="{{ __('Konfirmasi Password') }}" name="new_confirm_password" autocomplete="current-password">
							@if ($errors->has('new_confirm_password'))
								<span class="help-block">
									<strong>{{ $errors->first('new_confirm_password') }}</strong>
								</span>
							@endif
								<span id='message'></span>
						</div>
					</div>
							   
					<div class="text-right">
						<button class="btn btn-success col-lg-2 ml-1" type="submit" >Ubah Password</button>
					</div>
					</form>
				</div>
   
   	</div>
   	<!-- /main content -->
		
</div>
<!-- /page content -->
		<script src="{{asset('/js')}}/sweetalert2.all.js"></script>
		@include('sweetalert::alert')
@endsection
