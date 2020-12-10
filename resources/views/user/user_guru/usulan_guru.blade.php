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
						<a href="{{ url('/usulan') }}" class="breadcrumb-item">List Usulan</a>
							<span class="breadcrumb-item active">Kirim Usulan</span>
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
					<h5 class="card-title">Kirim Usulan</h5>
					<div class="header-elements">				
			    	</div>
				</div>
							
				<div class="card-body">
                    <form method="POST" action="{{ route('usulan.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row{{ $errors->has('NIP') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">NIP:</label>
						<div class="col-lg-9">
							<input class="form-control" type="text" name="nip" value="{{Auth::user()->guru->NIP}}" required readonly="">
							@if ($errors->has('NIP'))
								<span class="help-block">
									<strong>{{ $errors->first('NIP') }}</strong>
								</span>
							@endif
						</div>
					</div>

                    <div class="form-group row{{ $errors->has('nama') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Nama:</label>
						<div class="col-lg-9">
							<input class="form-control" type="text" name="nama" value="{{Auth::user()->guru->nama_lengkap}}" required readonly="">
							@if ($errors->has('nama'))
								<span class="help-block">
									<strong>{{ $errors->first('nama') }}</strong>
								</span>
							@endif
						</div>
					</div>

					<div class="form-group row{{ $errors->has('judul') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Judul: <span class="text-danger">*</span></label>
						<div class="col-lg-9">
                            <input class="form-control" type="text" placeholder="Masukkan Judul" name="judul" value="{{ old('judul') }}" ></input>
							@if ($errors->has('judul'))
								<span class="help-block">
									<strong>{{ $errors->first('judul') }}</strong>
								</span>
							@endif
						</div>
					</div>

					<div class="form-group row{{ $errors->has('pengarang') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Pengarang: <span class="text-danger">*</span></label>
						<div class="col-lg-9">
                            <input class="form-control" type="text" placeholder="Masukkan pengarang" name="pengarang" value="{{ old('pengarang') }}" ></input>
							@if ($errors->has('pengarang'))
								<span class="help-block">
									<strong>{{ $errors->first('pengarang') }}</strong>
								</span>
							@endif
						</div>
					</div>

                    <div class="form-group row{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Keterangan lain: <span class="text-danger">*</span></label>
						<div class="col-lg-9">
                            <textarea rows="5" cols="5" class="form-control" type="text" placeholder="Masukkan keterangan lain" name="deskripsi" value="{{ old('deskripsi') }}"></textarea>
							@if ($errors->has('deskripsi'))
								<span class="help-block">
									<strong>{{ $errors->first('deskripsi') }}</strong>
								</span>
							@endif
						</div>
					</div>

					<div class="form-group row">
						<label class="col-lg-3 col-form-label">Keterangan: <i>tanda</i><span class="text-danger"> (*)</span> harus diisi</label>
					</div>

					<div class="text-right">
                        <button class="btn btn-success col-lg-1 ml-1" id="btn-submit" type="submit" name="Submit" value="Submit" onclick="showSwal('success-message')">Kirim</button>
						<a href="{{ route('usulan.guru') }}"  class="btn btn-danger col-lg-1 ml-1">Kembali</a>
					</div>	
					</form>
				</div>
			</div>
			<!-- /form inputs -->
		</div>
		<!-- /content area -->
	</div>
	<!-- /main content -->
</div>
<!-- /page content -->


<script src="{{asset('/js')}}/sweetalert2.all.js"></script>
	@include('sweetalert::alert')

<script type="text/javascript">

$(document).ready(function() {
    $(".users").select2();
});

</script>

<script type="text/javascript">
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $("#btn-submit").submit(function(){
                // do ajax submit or just classic form submit
              //  alert("fake subminting")
                return false
            })
        })
</script>
@endsection