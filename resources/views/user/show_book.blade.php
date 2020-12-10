
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
	<script src="{{asset('/global_assets')}}/js/plugins/ui/moment/moment.min.js"></script>


	<script src="{{asset('/assets')}}/js/app.js"></script>
	<script src="{{asset('/global_assets')}}/js/demo_pages/form_inputs.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/form_layouts.js"></script>
	<script src="{{asset('/global_assets')}}/js/demo_pages/picker_date.js"></script>
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
							<a href="{{ url('/transaksi') }}" class="breadcrumb-item">Transaksi</a>
							<span class="breadcrumb-item active">Detail transaksi</span>
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
								<h5 class="card-title">Detail Transaksi</h5>
								<div class="header-elements">
									
			                	</div>
							</div>
							<div class="card-body">
							<form method="POST" action="">
                                @csrf
                                 @method('PUT')
								<form action="#">
									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Nomor peminjaman:</label>
										<div class="col-lg-9">
											<div type="text" class="form-control">{{ $pinjam->kode_pinjam }}</div>
										</div>
									</div>

                                    <div class="form-group row">
										<label class="col-lg-3 col-form-label">Kode Buku:</label>
										<div class="col-lg-9">
											<div type="text" class="form-control">{{ $pinjam->buku_id }}</div>
										</div>
									</div>
									
									@if($pinjam->nis != '')
                                    <div class="form-group row">
										<label class="col-lg-3 col-form-label">ID peminjam:</label>
										<div class="col-lg-9">
											<div type="text" class="form-control">{{ $pinjam->nis }}</div>
										</div>
									</div>
									@else
									<div class="form-group row">
										<label class="col-lg-3 col-form-label">ID peminjam:</label>
										<div class="col-lg-9">
											<div type="text" class="form-control">{{ $pinjam->nip }}</div>
										</div>
									</div>
									@endif
									
									<div class="form-group row">
									<label class="col-lg-3 col-form-label">Tanggal pinjam:</label>
									<div class="input-group col-lg-9">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar22"></i></span>
										</span>
										<div type="text" class="form-control">{{  date('Y-m-d', strtotime($pinjam->tanggal_peminjaman)) }}</div>
									</div>
									</div>

									
									<div class="form-group row">
									<label class="col-lg-3 col-form-label">Tanggal kembali:</label>
									<div class="input-group col-lg-9">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar22"></i></span>
										</span>
										<div type="text" class="form-control">{{  date('Y-m-d', strtotime($pinjam->tanggal_harus_kembali)) }}</div>
									</div>
									</div>


									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Keterlambatan:</label>
										<div class="col-lg-3">
										<div type="text" class="form-control">{{ $pinjam->keterlambatan }}</div>
										</div>
                                        <div class=" mt-0 mt-lg-0 align-self-center">
												<span class="text">Hari</span>
											</div>
									</div>

									<div class="form-group row">
										<label class="col-lg-3 col-form-label">Denda:</label>
										<div class="col-lg-3">
										<div type="text" class="form-control">{{ $pinjam->denda }}</div>
										</div>
									</div>

                                    <div class="form-group row">
										<label class="col-lg-3 col-form-label">Status:</label>
										<div class="col-lg-3">
											<div type="text" class="{{ $pinjam->status->class }}">{{ $pinjam->status->name }}</div>
										</div>
									</div>

									<div class="text-right">
										<a href="{{ route('transaksi.index') }}"  class="btn btn-danger col-lg-1 ml-1">Kembali</a>
									</div>
								</form>
							</div>
						</div>
						<!-- /basic layout -->

		</div>
		<!-- /main content -->
@endsection
