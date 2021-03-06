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
							<a href="{{ url('/siswa') }}" class="breadcrumb-item">Siswa</a>
							<span class="breadcrumb-item active">Detail Siswa</span>
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
						<h5 class="card-title">Detail Data Siswa</h5>
					</div>
                </div>
							
                <!-- Inner container -->
                <div class="d-md-flex align-items-md-start">

                    <!-- Left sidebar component -->
                    <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-0 sidebar-expand-md">

                        <!-- Sidebar content -->
                        <div class="sidebar-content">

                            <!-- Navigation -->
                            <div class="card">
                                <div class="card-body bg-indigo-400 text-center card-img-top" style="background-image: url(../../../../global_assets/images/backgrounds/panel_bg.png); background-size: contain;">
                                    <div class="card-img-actions d-inline-block mb-3">
                                        @if($siswa->photo != NULL)
                                            <img class="rounded-circle" src="{{ url('/photo/siswa/'.$siswa->photo) }}" width="170" height="170" alt="">
                                        @elseif($siswa->photo == NULL)
                                            <img class="rounded-circle" src="{{asset('/global_assets')}}/images/placeholders/people.png" width="170"  alt="">
                                        @endif
                                    <div class="card-img-actions-overlay rounded-circle">
                                </div>
                            </div>
                                <h6 class="font-weight-semibold mb-0">{{ $siswa->nama_siswa }}<span><i> (siswa)</i></span></h6>
                            </div>
                        </div>
                        <!-- /sidebar content -->

                    </div>
                    <!-- /left sidebar component -->

                </div>
                <!-- Right content -->

                <div class="tab-content w-100 overflow-auto">
					<div class="tab-pane fade active show" id="profile">

                    	<!-- /left sidebar component -->
                        <div class="card">
								
							<div class="card-body">
								<div class="container">
								<form action="#">
									<div class="form-group row">
										<label class="col-lg-3 col-form-label">NIS:</label>
										<div class="col-lg-9">
											<div type="text" class="form-control">{{ $siswa->NIS }}</div>
										</input>
										</div>
									</div>
                                  
                                    <div class="form-group row">
										<label class="col-lg-3 col-form-label">Nama Lengkap: <span class="text-danger"></span></label>
										<div class="col-lg-9">
											<div type="text" class="form-control-plaintext">{{ $siswa->nama_siswa }}</div>										
										</div>
									</div>

                                    <div class="form-group row">
										<label class="col-lg-3 col-form-label">Alamat: <span class="text-danger"></span></label>
										<div class="col-lg-9">
											<div type="text" class="form-control-plaintext">{{ $siswa->alamat }}</div>												
										</div>
									</div>	
									
									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Jenis Kelamin:<span class="text-danger"></span></label>
										<div class="col-lg-9">
											<div type="text" class="form-control">{{ $siswa->gender }}</div>											
										</div>
									</div>

									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Tempat Lahir:<span class="text-danger"></span></label>
										<div class="col-lg-9">
											<div type="text" class="form-control">{{ $siswa->tempat_lahir }}</div>											
										</div>
									</div>
									
                                    <div class="form-group row">
		                        		<label class="col-form-label col-lg-3">Tanggal Lahir<span class="text-danger"></span></label>
		                        		<div class="col-lg-9">
											<div type="date" class="form-control">{{  date('d F Y', strtotime($siswa->tanggal_lahir)) }}</div>											
										</div>
									</div>
								

                                    <div class="form-group row">
										<label class="col-form-label col-md-3">No Telp<span class="text-danger"></span></label>
										<div class="col-md-9">
											<div type="number" class="form-control">{{ $siswa->no_telp}}</div>											
										</div>
								    </div>

                                    <div class="form-group row">
										<label class="col-lg-3 col-form-label">Agama:<span class="text-danger"></span></label>
										<div class="col-lg-9">
											<div type="text" class="form-control">{{ $siswa->agama }}</div>											
										</div>
									</div>

                                    <div class="form-group row">
										<label class="col-form-label col-md-3">Email <span class="text-danger"></span></label>
										<div class="col-md-9">
											<div type="text" class="form-control">{{ $siswa->email }}</div>											
										</div>
							    	</div>

									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Tahun Angkatan:<span class="text-danger"></span></label>
										<div class="col-lg-9">
											<div type="text" class="form-control">{{ $siswa->tahun_angkatan }}</div>	
									    </div>
									</div>

									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Kelas:<span class="text-danger"></span></label>
										<div class="col-lg-9">
											<div type="text" class="form-control">{{ $siswa->kelas }}</div>											
										</div>
									</div>

									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Status:<span class="text-danger"></span></label>
										<div class="col-lg-3">
											<div type="text" class="form-control">{{ $siswa->status }}</div>	
									    </div>
									</div>

									
									<div class="form-group row">
										<label class="col-lg-8 col-form-label"><b>Keterangan: <i>Usernama dan Password Default NIS</i></b></label>
									</div>
									<div class="text-right">
										<a href="{{ url('/kartu_siswa/' . $siswa->id . '/pdf') }}"  class="btn btn-green col-lg-4 ml-1">Cetak Kartu Anggota</a>
										<a href="{{ route('siswa.index') }}"  class="btn btn-danger col-lg-2 ml-1">Kembali</a>
                                    </div>
								</form>
							</div>
                    	</div>
					</div>

			</div>
			<!-- /content -->
		</div>
		<!-- /main content -->
</div>
<!-- /page content -->

@endsection