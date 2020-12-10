
@extends('dashboard.base')

@section('css')
	<!-- Core JS files -->
	<script src="{{asset('/global_assets')}}/js/main/jquery.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/main/bootstrap.bundle.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->


	<!-- Theme JS files -->
    <script src="{{asset('/global_assets')}}/js/plugins/forms/selects/select2.min.js"></script>
	
	<script src="{{asset('/assets')}}/js/app.js"></script>

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
					<span class="breadcrumb-item active">Detail Transaksi</span>
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
				<label class="col-form-label">Nomor peminjaman: {{ $pinjam->kode_pinjam }}</label>
			</div>

			<div class="card-body">
				<form method="POST" action="">
				<ul class="media-list media-list-linked">

								<li class="media bg-light font-weight-semibold py-2">Data Buku</li>
								<div class="media">
									<div class="mr-3">
										<a href="#">
										@if($pinjam->cover != NULL)
                                            <img src="{{ url('/uploads/'.$pinjam->cover) }}" width="80" alt="" style="margin-right:20px">
                                        @elseif($pinjam->cover == NULL)
											<img src="../../../../global_assets/images/placeholders/placeholder.jpg" width="80" height="80" alt="" style="margin-right:20px;margin-top:5px">
                                        @endif										
										</a>
									</div>
									<div class="media-body">
										<div class="form-group row">
												<label class="col-lg-3 col-form-label">Kode Buku:</label>
												<div class="col-lg-9">
													<div type="text" class="form-control">{{ $pinjam->buku_id }}</div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Judul Buku:</label>
												<div class="col-lg-9">
													<div type="text" class="form-control">{{ $pinjam->judul_buku }}</div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Penulis:</label>
												<div class="col-lg-9">
													<div type="text" class="form-control">{{ $pinjam->penulis }}</div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Penerbit:</label>
												<div class="col-lg-9">
													<div type="text" class="form-control">{{ $pinjam->penerbit }}</div>
												</div>
											</div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Kota Terbit:<span class="text-danger"></span></label>
                                                <div class="col-lg-6">
                                                    <div type="text" class="form-control">{{ $pinjam->kota_terbit }}</div>											
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Volume:<span class="text-danger"></span></label>
                                                <div class="col-lg-7">
                                                    <div type="text" class="form-control">{{ $pinjam->volume }}</div>											
                                                </div>
                                            </div>
                                                            
                                            <div class="form-group row">
                                                <label class="col-form-label col-lg-3">Tahun Terbit<span class="text-danger"></span></label>
                                                <div class="col-md-4">
                                                    <div type="text" class="form-control">{{ $pinjam->tahun_terbit }}</div>											
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">ISBN:<span class="text-danger"></span></label>
                                                <div class="col-lg-7">
                                                    <div type="text" class="form-control">{{ $pinjam->ISBN }}</div>											
                                                </div>
                                            </div>

									</div>
								</div>
								<li class="media bg-light font-weight-semibold py-2">Data Transaksi</li>
								<div class="media" >
									<div class="mr-3" style="padding-left:100px">
									</div>
								<div class="media-body">
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Tanggal pinjam:</label>
									<div class="input-group col-lg-9">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar22"></i></span>
										</span>
										<div type="text" class="form-control">{{  date('d F Y', strtotime($pinjam->tanggal_peminjaman)) }}</div>
									</div>
								</div>
												
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Tanggal kembali:</label>
									<div class="input-group col-lg-9">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar22"></i></span>
										</span>
										<div type="text" class="form-control">{{  date('d F Y', strtotime($pinjam->tanggal_harus_kembali)) }}</div>
									</div>
								</div>

                                <?php 
                                            $denda = 0;
                                            $terlambat = 0;
                                            $tanggal_peminjaman = strtotime($pinjam->tanggal_peminjaman); 
                                            $tanggal_harus_kembali = strtotime(Carbon\Carbon::today()); 
                
                                            if ($tanggal_harus_kembali > $tanggal_peminjaman){
                                                $terlambat = round(abs($tanggal_harus_kembali - $tanggal_peminjaman) / 86400) - 7;
                                                $denda = 1000 * $terlambat;
                                            } if ($terlambat < 0){
                                                $terlambat = 0;
                                                $denda = 0;
                                            }
                                            ?>


								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Keterlambatan:</label>
									<div class="col-lg-1">
                                        <div type="text" class="form-control">{{ $terlambat }}</div>
									</div>
									<div class=" mt-0 mt-lg-0 align-self-center">
										<span class="text">Hari</span>
									</div>
								</div>

                              
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Denda Keterlambatan:</label>
									<div class="col-lg-3">
                        
                                        <div type="text" class="form-control">Rp {{ $denda }}.00</div>
									</div>
								</div>
							
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Denda Kondisi Buku:</label>
									<div class="col-lg-3">
                                        @if($pinjam->denda_buku == '')
                                        <div type="text" class="form-control">Rp 0.00</div>
                                        @else
										<div type="text" class="form-control">Rp {{ $pinjam->denda_buku }}</div>
                                        @endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Total Denda:</label>
									<div class="col-lg-3">
										<div type="text" class="form-control">Rp {{ $denda + $pinjam->denda_buku }}.00</div>
									</div>
								</div>
							
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Status:</label>
									<div class="col-lg-3">
										<div type="text" class="{{ $pinjam->class }}">{{ $pinjam->name }}</div>
									</div>
								</div>
									</div>
								</div>
									
					<div class="text-right">
						<a href="{{ route('transaksi.index') }}"  class="btn btn-danger col-lg-1 ml-1">Kembali</a>
					</div>
					</form>
				</div>	

			</div>		

		</div>
		<!-- /content area -->
	</div>
	<!-- /main content -->
</div>
<!-- /page content -->
@endsection
