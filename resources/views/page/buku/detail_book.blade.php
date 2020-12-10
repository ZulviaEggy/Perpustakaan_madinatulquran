
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
						<span class="breadcrumb-item active">Detail buku</span>
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
					<h5 class="card-title">Detail Buku</h5>
					<div class="header-elements">
						<div class="list-icons">
				            <a class="list-icons-item" data-action="collapse"></a>
				        </div>
			        </div>
				</div>
				<div class="col-md-12">
				<div class="card" >
				<ul class="media-list media-list-linked">
				<li class="media bg-light font-weight-semibold py-2">Cover Buku</li>
				<div class="card-body ">
					<div class="text-center">
						<a href="{{ url('/uploads/'.$book->cover) }}" data-popup="lightbox">
							<img class="img-fluid" width="170px" src="{{ url('/uploads/'.$book->cover) }}">
						</a>
					</div>
				</div>
				</div>
				
				<div class="card" >
				<ul class="media-list media-list-linked">
				<li class="media bg-light font-weight-semibold py-2">Data Buku</li>
					<div class="card-body" >
						<div class="form-group row">
							<label class="col-lg-1 col-form-label">Barcode:</label>
							<div class="col-md-2">
								<img src="data:image/png;base64,{{DNS1D::getBarcodePNG("$buku->kode_buku", 'C128',2,38,array(1,1,1), true)}}" alt="barcode" />
							</div>
							<div class="col-md-7 text-right">
																		
							</div>
						</div>

						<!-- Print Barcode -->
						<div class="modal fade" id="printBarcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<form method="POST" action="{{ route('buku.updateBarcode', $buku->id) }}" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<div class="modal-content">
									<div class="modal-header bg-green" style="margin-bottom:20px">
										<h5 class="modal-title" id="exampleModalLabel">Print Barcode:</h5>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
									<div class="form-group row" style="padding-left:10px">
										<h6 class="font-weight-semibold" style="padding-left:20px">Masukkan jumlah barcode</h6>
										<div class="col-lg-11" style="margin-left:10px">     
											<input type="number" class="form-control" placeholder="Masukkan jumlah barcode" name="print_qty" >
										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-green">Submit</button>
									</div>
								</div>
								</form>
							</div>
						</div>
									
					<div class="form-group row">
						<label class="col-lg-1 col-form-label">Kode Buku:</label>
						<div class="col-lg-4">
							<div type="text" class="form-control">{{ $book->kode_buku }}</div>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-lg-1 col-form-label">Judul Buku: <span class="text-danger"></span></label>
						<div class="col-lg-10">
							<div type="text" class="form-control-plaintext">{{ $book->judul_buku }}</div>										
						</div>
					</div>

					<div class="form-group row">
						<label class="col-lg-1 col-form-label">Penulis: <span class="text-danger"></span></label>
						<div class="col-lg-9">
							<div type="text" class="form-control-plaintext">{{ $book->penulis }}</div>												
						</div>
					</div>	
									
					<div class="form-group row">
						<label class="col-lg-1 col-form-label">Penerbit:<span class="text-danger"></span></label>
						<div class="col-lg-6">
							<div type="text" class="form-control-plaintext">{{ $book->penerbit }}</div>											
						</div>
					</div>

					<div class="form-group row">
						<label class="col-lg-1 col-form-label">Kota Terbit:<span class="text-danger"></span></label>
						<div class="col-lg-6">
							<div type="text" class="form-control">{{ $book->kota_terbit }}</div>											
						</div>
					</div>

					<div class="form-group row">
						<label class="col-lg-1 col-form-label">Volume:<span class="text-danger"></span></label>
						<div class="col-lg-7">
							<div type="text" class="form-control">{{ $book->volume }}</div>											
						</div>
					</div>
									
					<div class="form-group row">
						<label class="col-form-label col-lg-1">Kategori<span class="text-danger"></span></label>
						<div class="col-lg-6">
							<div type="text" class="form-control">{{ $book->kategori->nama_kategori}}</div>											
						</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-1">Tahun Terbit<span class="text-danger"></span></label>
						<div class="col-md-4">
							<div type="text" class="form-control">{{ $book->tahun_terbit }}</div>											
						</div>
					</div>

					<div class="form-group row">
						<label class="col-lg-1 col-form-label">ISBN:<span class="text-danger"></span></label>
						<div class="col-lg-7">
							<div type="text" class="form-control">{{ $book->ISBN }}</div>											
						</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-1">Jumlah <span class="text-danger"></span></label>
						<div class="col-md-4">
							<div type="text" class="form-control">{{ $book->jumlah}}</div>											
						</div>
					</div>
									
					<div class="form-group row">
						<label class="col-lg-1 col-form-label">Deskripsi:<span class="text-danger"></span></label>
						<div class="col-lg-10">
							@if($book->deskripsi == '')
							<div type="text" class="form-control">{{ $book->deskripsi }}</div>
							@else
							<div type="text" class="form-control-plaintext">{{ $book->deskripsi }}</div>	
							@endif										
						</div>
					</div>
					</div>
					</div>

					<div class="text-right" style="margin-bottom:20px">
					<button type="button" class="btn btn-green" data-toggle="modal" data-target="#printBarcode">
								<i class="icon-printer2 mr-2"></i>Cetak Barcode
								</button>
						<a href="{{ route('buku.index') }}"  class="btn btn-danger col-lg-1 ml-1">Kembali</a>
					</div>
					</form>
				
				
		
		</div>
		<!-- /page header -->
	</div>
	<!-- /main content -->
</div>
<!-- /page content -->
@endsection
				      