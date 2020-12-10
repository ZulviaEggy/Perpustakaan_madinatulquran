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
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
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
								<h5 class="card-title">Nama Sekolah</h5>
							</div>
							
							<div class="card-body">
								<form method="POST" action="{{ route('sekolah.update', $sekolah->id) }}" enctype="multipart/form-data">
                                @csrf
                                 @method('PUT')
                                
									<div class="form-group row{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
										<label class="col-form-label col-lg-1">Edit Nama:</label>
										<div class="col-md-6">
                                            <input type="text" class="form-control h-auto" name="deskripsi" placeholder="Masukkan nama sekolah">
											@if ($errors->has('deskripsi'))
											<span class="help-block">
												<strong>{{ $errors->first('deskripsi') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="text-right">
                                    <button class="btn btn-success col-lg-1 ml-1" type="submit" >Simpan</button>
								</div>
								</form>
							
						</div>
						<!-- /basic layout -->
		
		</div>
		<!-- /main content -->
    <script src="{{asset('/js')}}/sweetalert2.all.js"></script>
	@include('sweetalert::alert')
	</div>
	<!-- /page content -->
	@endsection
