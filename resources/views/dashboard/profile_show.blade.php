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
							<span class="breadcrumb-item active">Detail profil</span>
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
					<h5 class="card-title">Profile Admin</h5>
					<div class="header-elements">
			        </div>
				</div>
							
				<div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-xl-12 col-md-6">
                            <div class="card card-body">
                                <div class="media">
                                    <div class="mr-3">
                                    <a>
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
                                                
					<div class="form-group row">
						<label class="col-lg-3 col-form-label">Username:</label>
						<div class="col-lg-9">
							<div class="form-control" type="text">{{$user->nama}}</div>
						</div>
					</div>

                    <div class="form-group row">
						<label class="col-lg-3 col-form-label">Email: </label>
						<div class="col-lg-9">
							<div class="form-control" type="text">{{$user->email}}</div>
						</div>
					</div>

                    <div class="form-group row">
						<label class="col-lg-3 col-form-label">Alamat:</label>
						<div class="col-lg-9">
							<div class="form-control" type="text">{{$user->alamat}}</div>
						</div>
					</div>

                    <div class="form-group row">
						<label class="col-lg-3 col-form-label">Tempat Lahir: </label>
						<div class="col-lg-9">
							<div class="form-control" type="text">{{$user->tempat_lahir}}</div>
						</div>
					</div>

                    <div class="form-group row">
						<label class="col-lg-3 col-form-label">Tanggal Lahir:</label>
						<div class="col-lg-9">
							<div class="form-control" type="text">{{  date('d F Y', strtotime($user->tanggal_lahir)) }}</div>
						</div>
					</div>
                                   	
					<div class="form-group row">
						<label class="col-lg-3 col-form-label">Jenis Kelamin:<span class="text-danger"></span></label>
						<div class="col-lg-9">
							<div type="text" class="form-control">{{ $user->gender }}</div>											
						</div>
					</div>
                              
                    <div class="form-group row">
						<label class="col-lg-3 col-form-label">No Telepon:</label>
						<div class="col-lg-9">
							<div class="form-control" type="text">{{$user->phone}}</div>
						</div>
					</div>
								
					<div class="text-right">
						<a href="{{ route('profile_edit') }}"  class="btn btn-green">Edit profile</a>
					</div>
				</form>
				</div>
			</div>
		</div>
		<!-- /basic layout -->
	</div>
	<!-- /main content -->
</div>
<!-- /page content -->

<script src="{{asset('/js')}}/sweetalert2.all.js"></script>
@include('sweetalert::alert')
@endsection
