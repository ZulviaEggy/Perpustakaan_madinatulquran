@extends('dashboard.base')

@section('css')

	<!-- Core JS files -->
	<script src="{{asset('/global_assets')}}/js/main/jquery.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/main/bootstrap.bundle.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
    <script src="{{asset('/global_assets')}}/js/plugins/forms/selects/select2.min.js"></script>

	<script src="{{asset('/assets')}}/js/app.js"></script>


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
							<span class="breadcrumb-item active">Profile</span>
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
						<h5 class="card-title">Profile User</h5>
						<div class="list-icons">
				            <a class="list-icons-item" data-action="collapse"></a>
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
											@if(Auth::user()->guru->photo == '')
                                                <img src="{{asset('/global_assets')}}/images/placeholders/people.png" width="70" height="70" class="rounded-circle" alt=""></a>
                                            @else
                                                <img class="rounded-circle" src="{{ url('/photo/guru/'.Auth::user()->guru->photo) }}" width="70" height="70" alt="">
                                            @endif                                                         
                                            </a>
                                        </div>
                                        <div class="media-body align-self-center">
                                            <div class="font-weight-semibold">{{$user->nama}}</div>
                                                <span class="text-muted">{{$user->role->privilege_level}}</span>
                                            </div>
										<div class="text-right">
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                                                
                    <div class="form-group row">
						<label class="col-lg-3 col-form-label">NIP:</label>
						<div class="col-lg-9">
							<div class="form-control" type="text">{{$user->guru->NIP}}</div>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-lg-3 col-form-label">Nama:</label>
						<div class="col-lg-9">
							<div class="form-control" type="text">{{$user->guru->nama_lengkap}}</div>
						</div>
					</div>

                    <div class="form-group row">
						<label class="col-lg-3 col-form-label">Email: </label>
						<div class="col-lg-9">
							<div class="form-control" type="text">{{$user->guru->email}}</div>
						</div>
					</div>

                    <div class="form-group row">
							<label class="col-lg-3 col-form-label">Alamat:</label>
							<div class="col-lg-9">
							@if($user->guru->alamat == '')
								<div type="text" class="form-control">{{$user->guru->alamat}}</div>
							@else
								<div type="text" class="form-control-plaintext">{{$user->guru->alamat}}</div>	
							@endif	
							</div>
						</div>


                    <div class="form-group row">
						<label class="col-lg-3 col-form-label">Tempat Lahir: </label>
						<div class="col-lg-9">
							<div class="form-control" type="text">{{$user->guru->tempat_lahir}}</div>
						</div>
					</div>

                    <div class="form-group row">
						<label class="col-lg-3 col-form-label">Tanggal Lahir:</label>
						<div class="col-lg-9">
							<div class="form-control" type="text">{{  date('d F Y', strtotime($user->guru->tanggal_lahir)) }}</div>
						</div>
					</div>
                                    
                                    <!-- gender_id -->
                                   	
					<div class="form-group row">
						<label class="col-lg-3 col-form-label">Jenis Kelamin:<span class="text-danger"></span></label>
						<div class="col-lg-9">
							<div type="text" class="form-control">{{ $user->guru->gender }}</div>											
						</div>
					</div>				
                              
                    <div class="form-group row">
						<label class="col-lg-3 col-form-label">No Telepon:</label>
						<div class="col-lg-9">
							<div class="form-control" type="text">{{$user->guru->no_telp}}</div>
						</div>
					</div>
								
					<div class="text-right">				
                        <a href="{{  url('/profile/' . $user->guru->NIP . '/edit_guru') }}"  class="btn btn-green col-lg-2 ml-2">Edit Profile</a>
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
