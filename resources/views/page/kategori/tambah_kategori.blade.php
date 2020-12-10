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
						<a href="{{ url('/kategori') }}" class="breadcrumb-item">Kategori</a>
						<span class="breadcrumb-item active">Tambah Kategori</span>
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
						<h5 class="card-title">Tambah Kategori</h5>
						<div class="header-elements">
							<div class="list-icons">
				                <a class="list-icons-item" data-action="collapse"></a>
				            </div>
			            </div>
					</div>
							
					<div class="card-body">
                        <form method="POST" action="{{ route('kategori.store') }}">
                        @csrf
						<div class="form-group row{{ $errors->has('nama_kategori') ? ' has-error' : '' }}">
							<label class="col-lg-3 col-form-label">Kategori:<span class="text-danger">*</span></label>
							<div class="col-lg-9">
								<input class="form-control" type="text" placeholder="Masukkan kategori buku" name="nama_kategori" value="{{ old('nama_kategori') }}" autofocus>
								@if ($errors->has('nama_kategori'))
								<span class="help-block">
									<strong>{{ $errors->first('nama_kategori') }}</strong>
								</span>
								@endif
							</div>
						</div>

                        <div class="form-group row{{ $errors->has('rak') ? ' has-error' : '' }}">
							<label class="col-lg-3 col-form-label">Rak:<span class="text-danger">*</span></label>
							<div class="col-lg-9">
								<input class="form-control" type="text" placeholder="Masukkan rak buku" name="rak" value="{{ old('rak') }}">
								@if ($errors->has('rak'))
								<span class="help-block">
									<strong>{{ $errors->first('rak') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Keterangan: <i>tanda</i><span class="text-danger"> (*)</span> harus diisi</label>
						</div>

                        <div class="text-right">
                            <button class="btn btn-success col-lg-1 ml-1" type="submit" >Simpan</button>
                            <a href="{{ route('kategori.index') }}"  class="btn btn-danger col-lg-1 ml-1">Kembali</a>
						</div>
						</form>
					</div>
					<!-- /basic layout -->
		</div>
		<!-- /main content -->

</div>
<!-- /page content -->
@endsection
