
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

	<script src="{{asset('/assets')}}/js/app.js"></script>
	<script src="{{asset('/global_assets')}}/js/demo_pages/form_inputs.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/form_layouts.js"></script>
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
							<a href="{{ url('/guru') }}" class="breadcrumb-item">Guru</a>
							<span class="breadcrumb-item active">Tambah Guru</span>
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
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Tambah Guru</h5>
						<div class="header-elements">
							<div class="list-icons">
				                <a class="list-icons-item" data-action="collapse"></a>
				            </div>
			            </div>
					</div>

					<div class="card-body">
						<form method="POST" action="{{ route('guru.store') }}" enctype="multipart/form-data">
                        @csrf
						<div class="form-group row{{ $errors->has('NIP') ? ' has-error' : '' }}">
							<label class="col-lg-3 col-form-label">NIP:<span class="text-danger">*</span></label>
							<div class="col-lg-9">
								<input type="number" class="form-control" placeholder="Masukkan NIP"  name="NIP" value="{{ old('NIP') }}">
								@if ($errors->has('NIP'))
									<span class="help-block">
										<strong>{{ $errors->first('NIP') }}</strong>
									</span>
								@endif
							</div>
						</div>

                        <div class="form-group row{{ $errors->has('nama_lengkap') ? ' has-error' : '' }}">
							<label for="nama" class="col-lg-3 col-form-label">Nama Lengkap:<span class="text-danger">*</span></label>
							<div class="col-lg-9">
								<input id="nama" type="text" class="form-control" placeholder="Masukkan nama lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}">
								@if ($errors->has('nama_lengkap'))
									<span class="help-block">
										<strong>{{ $errors->first('nama_lengkap') }}</strong>
									</span>
								@endif
							</div>
						</div>

                        <div class="form-group row{{ $errors->has('alamat') ? ' has-error' : '' }}">
							<label class="col-lg-3 col-form-label">Alamat:<span class="text-danger">*</span></label>
							<div class="col-lg-9">
								<input type="text" class="form-control" placeholder="Masukkan alamat" name="alamat" value="{{ old('alamat') }}">
								@if ($errors->has('alamat'))
								<span class="help-block">
									<strong>{{ $errors->first('alamat') }}</strong>
								</span>
								@endif
							</div>
						</div>
                                    
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Jenis Kelamin:<span class="text-danger">*</span></label>
							<div class="col-lg-9">
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<input type="radio" class="form-input-styled" name="gender" value="L" checked data-fouc>
										Laki-laki
									</label>
								</div>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<input type="radio" class="form-input-styled" name="gender" value="P" data-fouc>
										Perempuan
									</label>
								</div>
							</div>
						</div>

						<div class="form-group row{{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
							<label for="tempat_lahir" class="col-lg-3 col-form-label">Tempat Lahir:<span class="text-danger">*</span></label>
							<div class="col-md-6">
								<input id="tempat_lahir" type="text" placeholder="Masukkan tempat lahir" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
									@if ($errors->has('tempat_lahir'))
										<span class="help-block">
											<strong>{{ $errors->first('tempat_lahir') }}</strong>
										</span>
									@endif
							</div>
						</div>

						<div class="form-group row{{ $errors->has('tanggal_lahir') ? ' has-error' : '' }}">
							<label for="tanggal_lahir" class="col-lg-3 col-form-label">Tanggal Lahir:<span class="text-danger">*</span></label>
							<div class="col-md-3">
								<input id="tanggal_lahir" type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
									@if ($errors->has('tanggal_lahir'))
										<span class="help-block">
											<strong>{{ $errors->first('tanggal_lahir') }}</strong>
										</span>
									@endif
							</div>
						</div>

						<div class="form-group row{{ $errors->has('no_telp') ? ' has-error' : '' }}">
							<label class="col-lg-3 col-form-label">No telepon:<span class="text-danger">*</span></label>
							<div class="col-lg-9">
								<input type="number" class="form-control" placeholder="Masukkan nomor telepon" name="no_telp" value="{{ old('no_telp') }}">
								@if ($errors->has('no_telp'))
								<span class="help-block">
									<strong>{{ $errors->first('no_telp') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row{{ $errors->has('agama') ? ' has-error' : '' }}">
							<label class="col-lg-3 col-form-label">Agama:<span class="text-danger">*</span></label>
							<div class="col-lg-9">
								<input type="text" class="form-control" placeholder="Masukkan Agama" name="agama" value="{{ old('agama') }}">
								@if ($errors->has('agama'))
								<span class="help-block">
									<strong>{{ $errors->first('agama') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
							<label class="col-lg-3 col-form-label">Email:<span class="text-danger">*</span></label>
							<div class="col-lg-9">
								<input type="text" class="form-control" placeholder="Masukkan Email" name="email" value="{{ old('email') }}">
								@if ($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Status:<span class="text-danger">*</span></label>
							<div class="col-lg-3">
								<select class="form-control" name="status" required>
                                    <option value="Aktif" >Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>		
							</div>
						</div>

						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Keterangan: <i>tanda</i><span class="text-danger"> (*)</span> harus diisi</label>
						</div>

						<div class="text-right">
                            <button type="submit" class="btn btn-success col-lg-1 ml-1">Simpan<i ></i></button>
								<a href="{{ route('guru.index') }}"  class="btn btn-danger col-lg-1 ml-1">Kembali</a>
						</div>
					</form>
				</div>
				<!-- /basic layout -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
	@endsection
