@extends('dashboard.base')

@section('css')
<script type="text/javascript">
 $('.modalMd').off('click').on('click', function (e) {
    $("#modalMd").modal('show');
    $('#modalMdContent').load($(this).attr('href'));
    $('#modalMdTitle').html($(this).attr('title'));
    e.preventDefault();
});
</script>

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
    <script src="../../../../global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
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
						<a href="{{ url('/profile_siswa') }}" class="breadcrumb-item">Profile</a>
							<span class="breadcrumb-item active">Edit profile</span>
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
                <div class="col-xl-12 col-md-5">
                    <div class="text-center">
                        <a href="#">
						@if(Auth::user()->siswa->photo == '')
                            <img src="{{asset('/global_assets')}}/images/placeholders/people.png" width="70" height="70" class="rounded-circle" alt=""></a>
                        @else
                            <img class="rounded-circle" src="{{ url('/photo/siswa/'.Auth::user()->siswa->photo) }}" width="70" height="70" alt="">
                        @endif                                                                   
						</a>
                    </div>
                    <div class="text-center" style="padding-top:10px">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#importExcel">
                            Edit photo
                        </button>
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
                            <form method="POST" action="{{ route('photoSiswa.update',Auth::user()->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header bg-green" style="margin-bottom:10px">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Photo</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="progress" style="display:none">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="">
                                        <span class="sr-only"></span>
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('photo') ? ' has-error' : '' }}">
                                    <div class="col-lg-10" style="margin-left:17px">
                                    <h6 class="font-weight-semibold">Pilih Photo</h6>
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

				<div class="card-body">
					<form method="POST" action="{{ route('siswaProfile.update',Auth::user()->id) }}" enctype="multipart/form-data">
					@csrf
                    @method('PUT')
					<div class="form-group row">
						<label class="col-lg-3 col-form-label">NIS:</label>
						<div class="col-lg-9">
							<input class="form-control" type="text" placeholder="Masukkan nis" name="NIS" value="{{$user->siswa->NIS}}" required readonly="">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-lg-3 col-form-label">Nama:</label>
						<div class="col-lg-9">
							<input class="form-control" type="text" placeholder="Masukkan username" name="nama_siswa" value="{{$user->siswa->nama_siswa}}" required readonly="">
						</div>
					</div>

                    <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Email: </label>
						<div class="col-lg-9">
							<input class="form-control" type="text" placeholder="Masukkan email"  value="{{$user->siswa->email}}" name="email" >
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
							<input class="form-control" type="text" placeholder="Masukkan alamat" value="{{$user->siswa->alamat}}" name="alamat">
                            @if ($errors->has('alamat'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('alamat') }}</strong>
                                </span>
                            @endif
                        </div>
					</div>
                                    
                    <!-- gender_id -->
                    <div class="form-group row">
						<label class="col-lg-3 col-form-label">Jenis Kelamin:</label>
						<div class="col-lg-9">
							<div class="form-check form-check-inline">
                                <label class="form-check-label" for="gender" >
									<input type="radio"  class="form-input-styled" name="gender" value="L" id="gender" {{$user->siswa->gender == 'L' ? 'checked' : ''}}>
									Laki-laki
                                </label>
							</div>
								<div class="form-check form-check-inline">
								<label class="form-check-label" for="gender" >
									<input type="radio"   class="form-input-styled" name="gender" value="P" id="gender"  {{$user->siswa->gender == 'P' ? 'checked' : ''}}>
									Perempuan
								</label>
							</div>
						</div>
                        </label>
					</div>

                
					<div class="form-group row{{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
                        <label for="tempat_lahir" class="col-form-label col-md-3">Tempat Lahir</label>
                        <div class="col-md-9">
                            <input id="tempat_lahir" type="text" class="form-control" name="tempat_lahir" value="{{ $user->siswa->tempat_lahir }}">
                                @if ($errors->has('tempat_lahir'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
									
                    <div class="form-group row{{ $errors->has('tanggal_lahir') ? ' has-error' : '' }}">
                        <label for="tgl_lahir" class="col-form-label col-md-3">Tanggal Lahir</label>
                        <div class="col-md-4">
                            <input id="tanggal_lahir" type="date" class="form-control" name="tanggal_lahir" value="{{ $user->siswa->tanggal_lahir }}">
                                @if ($errors->has('tanggal_lahir'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                              
                    <div class="form-group row{{ $errors->has('no_telp') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">No Telepon:</label>
						<div class="col-lg-9">
							<input class="form-control" type="text" placeholder="No telepon" value="{{$user->siswa->no_telp}}" name="no_telp" >
                            @if ($errors->has('no_telp'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('no_telp') }}</strong>
                                </span>
                            @endif
                        </div>
					</div>

                    <div class="form-group row{{ $errors->has('agama') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Agama:</label>
						<div class="col-lg-9">
							<input class="form-control" type="text" placeholder="Agama" value="{{$user->siswa->agama}}" name="agama" >
                            @if ($errors->has('agama'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('agama') }}</strong>
                                </span>
                            @endif
                        </div>
					</div>

              

					<div class="text-right"> 
                            <button class="btn btn-success col-lg-1 ml-1" type="submit" >Update</button>
                            <a href="{{ url('/profile_siswa') }}"  class="btn btn-danger col-lg-1 ml-1">Kembali</a>
					</div>
					</form>
				</div>
			</div>
			<!-- /basic layout -->
        </div>
		<!-- /content area -->
	</div>
	<!-- /main content -->
</div>
<!-- /page content -->
       
<script src="{{asset('/js')}}/sweetalert2.all.js"></script>
@include('sweetalert::alert')

	
  <script type="text/javascript">
    $(document).on('ajaxComplete ajaxReady', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
        });
        $('#formUpload').on("submit", function (e) {
            $(".progress").show();
            var formData = new FormData(this);
            var formURL = $("#formUpload").attr("action");
            $.ajax(
                    {
                        url: formURL,
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (data, textStatus, jqXHR)
                        {
                            var data = jqXHR.responseJSON;
                            window.location.href = data.url;
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            var data = jqXHR.responseJSON;
                            errorsHtml = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><ul>';
 
                            $.each(data, function (key, value) {
                                errorsHtml += '<li>' + value[0] + '</li>';
                            });
                            errorsHtml += '</ul></di>';
 
                            $(".modalError").html(errorsHtml);
                        },
                        xhr: function () {
                            var xhr = $.ajaxSettings.xhr();
                            xhr.upload.onprogress = function (e) {
                                $(".progress-bar").attr("style", "width:" + Math.floor(e.loaded / e.total * 100) + "%");
                                $(".progress-bar").html(Math.floor(e.loaded / e.total * 100) + "%");
                            };
                            return xhr;
                        },
                    });
            e.preventDefault();
            e.unbind();
        });
    });
</script>
@endsection