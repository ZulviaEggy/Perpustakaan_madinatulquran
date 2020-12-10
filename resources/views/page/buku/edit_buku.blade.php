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
						<a href="{{ url('/buku') }}" class="breadcrumb-item">Buku</a>
					<span class="breadcrumb-item active">Edit buku</span>
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
					<h5 class="card-title">Edit Buku</h5>
					<div class="header-elements">
						<div class="list-icons">
				            <a class="list-icons-item" data-action="collapse"></a>
				        </div>
			        </div>
				</div>
                <div class="card-body ">
					<div class="text-center">
                        <a href="#">
                            <img class="img-fluid" width="170px" src="{{ url('/uploads/'.$buku->cover) }}" >
                        </a>
                    </div>
                        <br>
                        <div class="text-center">
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#importExcel">
                                Edit Cover
							</button>                                          
						</div>

						@if ($errors->has('cover'))
							<script>
								$(document).ready(function () {
								$('#importExcel').modal('show');
								});
							</script>
						@endif

							<!-- Upload Photo -->
							<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<form method="POST" action="{{ route('buku.updatePhoto', $buku->id) }}" enctype="multipart/form-data">
									@csrf
									@method('PUT')
									<div class="modal-content">
										<div class="modal-header bg-green" style="margin-bottom:10px">
											<h5 class="modal-title" id="exampleModalLabel">Edit Cover Buku</h5>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<h6 class="font-weight-semibold" style="padding-left:20px">Pilih cover</h6>
										<div class="progress" style="display:none">
											<div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="">
												<span class="sr-only"></span>
											</div>
										</div>
										<div class="form-group row {{ $errors->has('cover') ? ' has-error' : '' }}">
											<div class="col-lg-10" style="margin-left:17px">
												<input type="file" class="form-control h-auto" name="cover">
												<span class="form-text text-muted text-left">Accepted formats: png, jpg. Max file size 2Mb</span>
												@if ($errors->has('cover'))
												<span class="help-block">
													<strong>{{ $errors->first('cover') }}</strong>
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
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Barcode:</label>
							<div class="col-md-2">
								<img src="data:image/png;base64,{{DNS1D::getBarcodePNG("$buku->kode_buku", 'C128',2,38,array(1,1,1), true)}}" alt="barcode" />
							</div>
						</div>
												                    
						<form method="POST" action="{{ route('buku.update', $buku->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
													                
                        <div class="form-group row{{ $errors->has('kode_buku') ? ' has-error' : '' }}">
							<label class="col-lg-3 col-form-label">Kode Buku:</label>
							<div class="col-lg-9">
								<input class="form-control" type="text" placeholder="Masukkan kode buku" name="kode_buku" value="{{ $buku->kode_buku }}" autofocus>
								</input>
								@if ($errors->has('kode_buku'))
									<span class="help-block">
										<strong>{{ $errors->first('kode_buku') }}</strong>
									</span>
								@endif
							</div>
                        </div>

                         <div class="form-group row{{ $errors->has('judul_buku') ? ' has-error' : '' }}">
							<label class="col-lg-3 col-form-label">Judul Buku: </label>
							<div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan judul buku" name="judul_buku" value="{{ $buku->judul_buku }}">
								@if ($errors->has('judul_buku'))
									<span class="help-block">
										<strong>{{ $errors->first('judul_buku') }}</strong>
									</span>
								@endif
							</div>
						</div>

                        <div class="form-group row{{ $errors->has('penulis') ? ' has-error' : '' }}">
							<label class="col-lg-3 col-form-label">Penulis: </label>
							<div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Penulis" name="penulis" value="{{ $buku->penulis }}">
								@if ($errors->has('penulis'))
									<span class="help-block">
										<strong>{{ $errors->first('penulis') }}</strong>
									</span>
								@endif
							</div>
						</div>

                        <div class="form-group row{{ $errors->has('penerbit') ? ' has-error' : '' }}">
							<label class="col-lg-3 col-form-label">Penerbit:</label>
							<div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Penerbit" name="penerbit" value="{{ $buku->penerbit }}">
								@if ($errors->has('penerbit'))
									<span class="help-block">
										<strong>{{ $errors->first('penerbit') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group row{{ $errors->has('kota_terbit') ? ' has-error' : '' }}">
							<label class="col-lg-3 col-form-label">Kota Terbit:</label>
							<div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Kota terbit" name="kota_terbit" value="{{ $buku->kota_terbit }}" >
								@if ($errors->has('kota_terbit'))
									<span class="help-block">
										<strong>{{ $errors->first('kota_terbit') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group row{{ $errors->has('volume') ? ' has-error' : '' }}">
							<label class="col-lg-3 col-form-label">Volume:</label>
							<div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Volume" name="volume" value="{{ $buku->volume }}" >
								@if ($errors->has('volume'))
									<span class="help-block">
										<strong>{{ $errors->first('volume') }}</strong>
									</span>
								@endif
							</div>
						</div>
									
                        <div class="form-group row">
		                    <label class="col-form-label col-lg-3">Kategori<span class="text-danger"></span></label>
                            <div class="col-md-3">
                                <select class="form-control form-control-select2" name="kategori_id">
                                    @foreach($kategorie as $kategori)
										@if( $kategori->id == $buku->kategori_id )
											<option value="{{ $kategori->id }}" selected="true">{{ $kategori->nama_kategori }}</option>
										@else
											<option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
										@endif
                                    @endforeach
                                </select>
                            </div>
						</div>

                        <div class="form-group row{{ $errors->has('edisi') ? ' has-error' : '' }}">
							<label class="col-form-label col-md-3">Edisi:<span class="text-danger"></span></label>
							<div class="col-md-9">
                            	<input type="text" class="form-control" placeholder="Edisi" name="edisi" value="{{ $buku->edisi }}" >
								@if ($errors->has('edisi'))
									<span class="help-block">
										<strong>{{ $errors->first('edisi') }}</strong>
									</span>
								@endif
							</div>
						</div>

                        <div class="form-group row{{ $errors->has('tahun_terbit') ? ' has-error' : '' }}">
							<label class="col-form-label col-md-3">Tahun Terbit:<span class="text-danger"></span></label>
							<div class="col-md-3">
                                <select name="tahun_terbit" class="form-control form-control-select2" data-fouc>
									<option value="{{ $buku->tahun_terbit }}" selected="true">{{ $buku->tahun_terbit }}</option>
										<?php
										$thn_skr = date('Y');
										for ($x = $thn_skr; $x >= 1980; $x--){
										?>
									<option value ="<?php echo $x ?>"><?php echo $x ?></option>
									<?php
									}
									?>
                                </select>
							</div>
						</div>

                        <div class="form-group row{{ $errors->has('ISBN') ? ' has-error' : '' }}">
							<label class="col-lg-3 col-form-label">ISBN:<span class="text-danger"></span></label>
							<div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan ISBN" name="ISBN" value="{{ $buku->ISBN }}">
								@if ($errors->has('ISBN'))
									<span class="help-block">
										<strong>{{ $errors->first('ISBN') }}</strong>
									</span>
								@endif
							</div>
						</div>

                        <div class="form-group row{{ $errors->has('jumlah') ? ' has-error' : '' }}">
							<label class="col-form-label col-md-3">Jumlah <span class="text-danger"></span></label>
							<div class="col-md-9">
                                <input type="number" class="form-control" placeholder="Jumlah" name="jumlah" value="{{ $buku->jumlah }}">
								@if ($errors->has('jumlah'))
									<span class="help-block">
										<strong>{{ $errors->first('jumlah') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group row{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
							<label class="col-form-label col-md-3">Deskripsi <span class="text-danger"></span></label>
							<div class="col-md-9">
								<input rows="5" cols="5" class="form-control"  placeholder="Deskripsi" name="deskripsi" value="{{ $buku->deskripsi }}"></input>
								@if ($errors->has('deskripsi'))
									<span class="help-block">
										<strong>{{ $errors->first('deskripsi') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="text-right">
                            <button class="btn btn-success col-lg-1 ml-1" type="submit" >Simpan</button>
                                <a href="{{ route('buku.index') }}"  class="btn btn-danger col-lg-1 ml-1">Kembali</a>
						</div>
						</form>
					</div>
				</div>
				<!-- /basic layout -->
			</div>
			<!-- /form input -->
		</div>
		<!-- /content area -->
	</div>
	<!-- /main content -->
</div>
<!-- /page content -->
<script src="{{asset('/js')}}/sweetalert2.all.js"></script>
@include('sweetalert::alert')
@endsection

