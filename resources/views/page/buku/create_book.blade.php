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
						<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
						<a href="{{ url('/buku') }}" class="breadcrumb-item">Buku</a>
							<span class="breadcrumb-item active">Tambah buku</span>
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
								<h5 class="card-title">Tambah Buku</h5>
								<div class="header-elements">
									
			                	</div>
							</div>
							
							<div class="card-body">
                            <form method="POST" action="{{ route('buku.store') }}" enctype="multipart/form-data">
                                @csrf
								<div class="form-group row{{ $errors->has('kode_buku') ? ' has-error' : '' }}">
									<label class="col-lg-3 col-form-label">Kode Buku: <span class="text-danger">*</span></label>
									<div class="col-lg-9">
										<input class="form-control" type="text" placeholder="Masukkan kode buku atau scan barcode" name="kode_buku" value="{{ old('kode_buku') }}" autofocus="true">
										@if ($errors->has('kode_buku'))
											<span class="help-block">
												<strong>{{ $errors->first('kode_buku') }}</strong>
											</span>
										@endif
									</div>
								</div>

                                <div class="form-group row{{ $errors->has('judul_buku') ? ' has-error' : '' }}">
									<label class="col-lg-3 col-form-label">Judul Buku:<span class="text-danger">*</span></label>
									<div class="col-lg-9">
										<input class="form-control" type="text" placeholder="Masukkan judul buku" name="judul_buku" value="{{ old('judul_buku') }}" >
									    @if ($errors->has('judul_buku'))
											<span class="help-block">
												<strong>{{ $errors->first('judul_buku') }}</strong>
											</span>
										@endif
									</div>
								</div>

                                <div class="form-group row{{ $errors->has('penulis') ? ' has-error' : '' }}">
									<label class="col-lg-3 col-form-label">Penulis: <span class="text-danger">*</span></label>
									<div class="col-lg-9">
										<input class="form-control" type="text" placeholder="Penulis buku" name="penulis" value="{{ old('penulis') }}" >
										@if ($errors->has('penulis'))
											<span class="help-block">
												<strong>{{ $errors->first('penulis') }}</strong>
											</span>
										@endif
									</div>
								</div>

                                <div class="form-group row{{ $errors->has('penerbit') ? ' has-error' : '' }}">
									<label class="col-lg-3 col-form-label">Penerbit:<span class="text-danger">*</span></label>
									<div class="col-lg-9">
										<input class="form-control" type="text" placeholder="Penerbit buku" name="penerbit" value="{{ old('penerbit') }}" >
										@if ($errors->has('penerbit'))
											<span class="help-block">
												<strong>{{ $errors->first('penerbit') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group row{{ $errors->has('kota_terbit') ? ' has-error' : '' }}">
									<label class="col-lg-3 col-form-label">Kota Terbit:<span class="text-danger">*</span></label>
									<div class="col-lg-9">
										<input class="form-control" type="text" placeholder="Kota terbit" name="kota_terbit" value="{{ old('kota_terbit') }}">
										@if ($errors->has('kota_terbit'))
											<span class="help-block">
												<strong>{{ $errors->first('kota_terbit') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group row{{ $errors->has('volume') ? ' has-error' : '' }}">
									<label class="col-lg-3 col-form-label">Volume:<span class="text-danger"></span></label>
									<div class="col-lg-9">
										<input class="form-control" type="text" placeholder="Volume" name="volume" value="{{ old('volume') }}">
										@if ($errors->has('volume'))
											<span class="help-block">
												<strong>{{ $errors->first('volume') }}</strong>
											</span>
										@endif
									</div>
								</div>
									
                                <div class="form-group row{{ $errors->has('kategori_id') ? ' has-error' : '' }}">
		                        	<label class="col-form-label col-lg-3">Kategori<span class="text-danger" >*</span></label>
		                        	<div class="col-lg-3">
                                        <select class="form-control form-control-select2" name="kategori_id">
                                            <option value="" >None</option>
											@foreach($kategorie as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                            @endforeach
                                        </select>			
										@if ($errors->has('kategori_id'))
										<span class="help-block">
											<strong>{{ $errors->first('kategori_id') }}</strong>
										</span>
										@endif						
                                    </div>
								</div>

                                <div class="form-group row{{ $errors->has('edisi') ? ' has-error' : '' }}">
									<label class="col-form-label col-md-3">Edisi<span class="text-danger"></span></label>
									<div class="col-md-9">
                                        <input class="form-control" type="number" placeholder="Edisi" name="edisi" value="{{ old('edisi') }}">
										@if ($errors->has('edisi'))
										<span class="help-block">
											<strong>{{ $errors->first('edisi') }}</strong>
										</span>
										@endif
									</div>
								</div>

                                <div class="form-group row{{ $errors->has('tahun_terbit') ? ' has-error' : '' }}">
									<label class="col-form-label col-md-3">Tahun terbit:<span class="text-danger">*</span></label>
									<div class="col-md-3">
                                        <form action="action">
                                            <select name="tahun_terbit" class="form-control form-control-select2" data-fouc>
												<option value="">None</option>
												<?php
												$thn_skr = date('Y');
												for ($x = $thn_skr; $x >= 1900; $x--){
													?>
													<option value ="<?php echo $x ?>"><?php echo $x ?></option>
													<?php
												}
												?>
                                            </select>
											@if ($errors->has('tahun_terbit'))
											<span class="help-block">
												<strong>{{ $errors->first('tahun_terbit') }}</strong>
											</span>
											@endif	
									</div>
								</div>

                                <div class="form-group row{{ $errors->has('ISBN') ? ' has-error' : '' }}">
									<label class="col-lg-3 col-form-label">ISBN:<span class="text-danger">*</span></label>
									<div class="col-lg-9">
										<input class="form-control" type="text" placeholder="Masukkan no ISBN" name="ISBN" value="{{ old('ISBN') }}">
										@if ($errors->has('ISBN'))
											<span class="help-block">
												<strong>{{ $errors->first('ISBN') }}</strong>
											</span>
										@endif
									</div>
								</div>

                                <div class="form-group row{{ $errors->has('jumlah') ? ' has-error' : '' }}">
									<label class="col-form-label col-md-3">Jumlah <span class="text-danger">*</span></label>
									<div class="col-md-9">
										<input class="form-control" type="number" placeholder="Masukkan jumlah buku" name="jumlah" value="{{ old('jumlah') }}" >
										@if ($errors->has('jumlah'))
											<span class="help-block">
												<strong>{{ $errors->first('jumlah') }}</strong>
											</span>
										@endif
									</div>
							    </div>

								<div class="form-group row{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
									<label class="col-lg-3 col-form-label">Deskripsi:<span class="text-danger"></span></label>
									<div class="col-lg-9">
										<textarea rows="5" cols="5" class="form-control" placeholder="Deskripsi" name="deskripsi" value="{{ old('deskripsi') }}"></textarea>
									    @if ($errors->has('deskripsi'))
											<span class="help-block">
												<strong>{{ $errors->first('deskripsi') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group row{{ $errors->has('cover') ? ' has-error' : '' }}">
									<label class="col-lg-3 col-form-label">Cover:<span class="text-danger"></span></label>
									<div class="col-lg-9">
										<input type="file" class="form-control h-auto" name="cover" >
										<span class="form-text text-muted">Accepted formats: png, jpg. Max file size 2Mb</span>
										@if ($errors->has('cover'))
											<span class="help-block">
												<strong>{{ $errors->first('cover') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Keterangan: <i>tanda</i><span class="text-danger"> (*)</span> harus diisi</label>
								</div>
								<div class="text-right">
									
                                <button class="btn btn-success col-lg-1 ml-1" id="btn-submit" type="submit" name="Submit" value="Submit" onclick="showSwal('success-message')">Simpan</button>
								<a href="{{ route('buku.index') }}"  class="btn btn-danger col-lg-1 ml-1">Kembali</a>
							</div>	
							</form>
						</div>
						<!-- /basic layout -->
				</div>
				<!-- /main content -->
		</div>
		<!-- /page content -->
	</body>
</html>
<script src="{{asset('js/sweetalert2.all.js')}}"></script>
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