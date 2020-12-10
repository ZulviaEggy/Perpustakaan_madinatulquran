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
	<!-- /theme JS files -->
           
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
			<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
				<div class="d-flex">
					<div class="breadcrumb">
						<a href="{{ url('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
						<a href="{{ url('/staff') }}" class="breadcrumb-item">Staff</a>
						<span class="breadcrumb-item active">Edit Staff</span>
					</div>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
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
					<h5 class="card-title">Edit Staff</h5>
				</div>
             </div>
							
            <!-- Inner container -->
            <div class="d-md-flex align-items-md-start">

                <!-- Left sidebar component -->
                <div class=" sidebar-component-left wmin-300 border-0 shadow-0 sidebar-expand-md">

                    <!-- Sidebar content -->
                    <div class="sidebar-content">

                        <!-- Navigation -->
                        <div class="card">
                            <div class="card-body bg-indigo-400 text-center card-img-top" style="background-image: url(../../../../global_assets/images/backgrounds/panel_bg.png); background-size: contain;">
								<div class="card-img-actions d-inline-block mb-3">
									@if($staff->photo != NULL)
									<img class="rounded-circle" src="{{ url('/photo/profile/'.$staff->photo) }}" width="170" height="170" alt="">
									@elseif($staff->photo == NULL)
									<img class="rounded-circle" src="{{asset('/global_assets')}}/images/placeholders/people.png" width="170" height="170" alt="">
									@endif
                                    <div class="card-img-actions-overlay rounded-circle">
                                    </div>
								</div>
							</div>
						</div>
						<div class="text-center">
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#importExcel">
                                Edit photo
							</button>    
							<a href="{{ route('staff.index') }}"  class="btn btn-danger btn-sm">Kembali</a>                                        
						</div>  
					
						@if ($errors->has('photo'))
							<script>
								$(document).ready(function () {
									$('#importExcel').modal('show');
								});
							</script>
							@endif
										     
						<!-- Upload Photo -->
						<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<form method="POST" action="{{ route('staff.updatePhoto', $staff->id) }}" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<div class="modal-content">
									<div class="modal-header bg-green" style="margin-bottom:20px">
										<h5 class="modal-title" id="exampleModalLabel">Upload Photo</h5>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
										<h6 class="font-weight-semibold" style="padding-left:20px">Pilih photo</h6>
									<div class="progress" style="display:none">
										<div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="">
											<span class="sr-only"></span>
										</div>
									</div>
									<div class="form-group row {{ $errors->has('photo') ? ' has-error' : '' }}">
										<div class="col-lg-10" style="margin-left:17px">
											<input type="file" class="form-control h-auto" name="photo">
											<span class="form-text text-muted">Accepted formats: png, jpg. Max file size 2Mb</span>
											@if ($errors->has('photo'))
											<span class="help-block">
												<strong>{{ $errors->first('photo') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-green formUpload">Update</button>
									</div>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
                <!-- Right content -->
                <div class="tab-content w-100 overflow-auto">
					<div class="tab-pane fade active show" id="profile">

                        <!-- /left sidebar component -->
                        <div class="card">
							<div class="card-body">
							<h5 class="card-title">Ubah profil</h5>
								<div class="container">
									<form method="POST" action="{{ route('staff.update', $staff->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row{{ $errors->has('nama') ? ' has-error' : '' }}">
										<label class="col-lg-3 col-form-label">Nama : <span class="text-danger"></span></label>
										<div class="col-lg-9">
                                        <input class="form-control" type="text" placeholder="Masukkan nama" name="nama" value="{{ $staff->nama }}"  autofocus>    
										@if ($errors->has('nama'))
											<span class="help-block">
												<strong>{{ $errors->first('nama') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group row{{ $errors->has('staff_id') ? ' has-error' : '' }}">
									<label class="col-form-label col-md-3">NIP/NIK<span class="text-danger"></span></label>
									<div class="col-md-9">
										<input class="form-control" type="number" placeholder="Masukkan nip atau nik" name="staff_id" value="{{ $staff->staff_id }}" required>
										@if ($errors->has('staff_id'))
											<span class="help-block">
												<strong>{{ $errors->first('staff_id') }}</strong>
											</span>
										@endif    
									</div>
								</div>

                                <div class="form-group row{{ $errors->has('alamat') ? ' has-error' : '' }}">
									<label class="col-lg-3 col-form-label">Alamat: <span class="text-danger"></span></label>
										<div class="col-lg-9">
                                        <input type="text" class="form-control" placeholder="Masukkan alamat" name="alamat" value="{{ $staff->alamat }}">
										@if ($errors->has('alamat'))
											<span class="help-block">
												<strong>{{ $errors->first('alamat') }}</strong>
											</span>
										@endif   
									</div>
								</div>	
									
                                <div class="form-group row{{ $errors->has('gender') ? ' has-error' : '' }}">
									<label class="col-lg-3 col-form-label">Jenis Kelamin:</label>
									<div class="col-lg-9">
										<div class="form-check form-check-inline">
                                            <label class="form-check-label" for="gender" >
												<input type="radio" class="form-input-styled" name="gender" value="L" id="gender" {{$staff->gender == 'L' ? 'checked' : ''}}>
												Laki-laki
											</label>
										</div>
										<div class="form-check form-check-inline">
											<label class="form-check-label" for="gender" >
												<input type="radio" class="form-input-styled" name="gender" value="P" id="gender"  {{$staff->gender == 'P' ? 'checked' : ''}}>
												Perempuan
											</label>
										</div>
									</div>
									</label>
								</div>

                                <div class="form-group row{{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
                                    <label for="tempat_lahir" class="col-form-label col-md-3">Tempat Lahir</label>
                                    <div class="col-md-6">
                                        <input id="tempat_lahir" type="text" class="form-control" name="tempat_lahir" value="{{ $staff->tempat_lahir }}">
                                        @if ($errors->has('tempat_lahir'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
									
                                <div class="form-group row{{ $errors->has('tgl_lahir') ? ' has-error' : '' }}">
                                    <label for="tgl_lahir" class="col-form-label col-md-3">Tanggal Lahir</label>
                                    <div class="col-md-6">
                                        <input id="tanggal_lahir" type="date" class="form-control" name="tanggal_lahir" value="{{ $staff->tanggal_lahir }}">
                                        @if ($errors->has('tanggal_lahir'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                   
                                <div class="form-group row{{ $errors->has('phone') ? ' has-error' : '' }}">
									<label class="col-form-label col-md-3">No Telp<span class="text-danger"></span></label>
									<div class="col-md-9">
                                    	<input class="form-control" type="text" placeholder="Masukkan no_telp" name="phone" value=" {{ $staff->phone }} ">    
										@if ($errors->has('phone'))
											<span class="help-block">
												<strong>{{ $errors->first('phone') }}</strong>
											</span>
										@endif      
									</div>
								</div>

                                <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
									<label class="col-form-label col-md-3">Email <span class="text-danger"></span></label>
									<div class="col-md-9">
										<input class="form-control" type="text" placeholder="Masukkan email" name="email" value=" {{ $staff->email }} ">    
										@if ($errors->has('email'))
											<span class="help-block">
												<strong>{{ $errors->first('email') }}</strong>
											</span>
										@endif     
									</div>
							    </div>

								<div class="form-group row{{ $errors->has('role_id') ? ' has-error' : '' }}">
		                        	<label class="col-form-label col-lg-3">Level<span class="text-danger"></span></label>
                                    <div class="col-md-5">
										<select class="form-control" name="role_id">
											@foreach($role as $level)
												@if( $level->id == $staff->role_id )
													<option value="{{ $level->id }}" selected="true">{{ $level->privilege_level }}</option>
												@else
													<option value="{{ $level->id }}">{{ $level->privilege_level }}</option>
												@endif
											@endforeach
										</select>
                                    </div>
								</div>
									
                                <div class="text-right">
                                    <button class="btn btn-success col-lg-2 ml-1" type="submit" >Simpan</button>
								</div>
								</form>
							</div>
                    	</div>
						<!-- /basic layout -->
						
					</div>
					<!-- /main content -->
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
						<form method="POST" action="{{ route('changeStaffAdmin.password',$staff->id) }}" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">
							<label for="password" class="col-lg-3 col-form-label">New password</label>
							<div class="col-lg-9">
								<input id="password" type="password"  placeholder="{{ __('Password') }}" class="form-control" name="password">
								@if ($errors->has('password'))
									<span class="help-block">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="text-right">
							<button class="btn btn-success col-lg-3 ml-1" type="submit" >Ubah Password</button>
						</div>
						</form>
						</div>
					</div>
				</div>
				<!-- /page content -->
	 		</div>
			<!-- /basic layout -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
	@include('sweetalert::alert')
    <script src="{{asset('/js')}}/sweetalert.js"></script>

	@endsection