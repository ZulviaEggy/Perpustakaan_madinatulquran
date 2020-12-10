@extends('dashboard.base')

@section('css')
	<!-- Core JS files -->
	<script src="{{asset('/global_assets')}}/js/main/jquery.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/main/bootstrap.bundle.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('/global_assets')}}/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/forms/selects/select2.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/tables/datatables/extensions/fixed_columns.min.js"></script>
	<script type="text/javascript" src="{{asset('/global_assets')}}/js/main/jquery.printPage.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/forms/styling/uniform.min.js"></script>

	<script src="{{asset('/assets')}}/js/app.js"></script>
	<script src="{{asset('/global_assets')}}/js/demo_pages/datatables_extension_fixed_columns.js"></script>
	<script src="{{asset('/global_assets')}}/js/demo_pages/form_inputs.js"></script>
  
	<!-- /theme JS files -->

	<script src="{{asset('/js')}}/sweetalert2.all.js"></script>
	@include('sweetalert::alert')
            
<!-- Page content -->
<div class="page-content">

	<!-- Main sidebar -->
	<div class="sidebar sidebar-dark sidebar-main sidebar-fixed sidebar-expand-md">
	</div>
	<!-- /main content -->
			
		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="{{ url('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Laporan transaksi</span>
						</div>
						<a href="#" class="header-elements-toggle text-defau lt d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<!-- /page header -->
    		<div class="row">
			</div>
			<div class="row" style="margin-top: 20px;">
				<div class="col-lg-12 grid-margin stretch-card">
              		<div class="card">
					
                		<div class="card-body header-elements-inline">
                 		 	<h4 class="card-title">Laporan Transaksi</h4>
							<div class="text-right">
								<!-- Export berdasarkan tanggal -->
								</div>
							</div>	
				
								<div class="table-bordered table-responsive ">
                                  <!-- Basic layout-->
				<div class="card-header header-elements-inline">
				</div>
			
				<div class="card-body">
					<form method="POST" action="{{ route('siswa.store') }}" enctype="multipart/form-data">
                    @csrf
			
					<div class="form-group row{{ $errors->has('status') ? ' has-error' : '' }}">
						<label class=" col-form-label" style="margin-left: 20px;">Jenis Transaksi</label>
						<div class="col-lg-3">
							<select class="form-control form-control-uniform" name="status" onchange="window.location.href=this.value;">
                                <option value="" >Pilih Transaksi</option>
                                <option value="{{ url('/laporan/trs') }}" >Semua Transaksi</option>
                                <option value="{{ url('/laporan/trs_peminjaman') }}">Transaksi Peminjaman</option>
                                <option value="{{ url('/laporan/trs_perpanjangan') }}">Transaksi Perpanjangan</option>
                                <option value="{{ url('/laporan/trs_pengembalian') }}">Transaksi Pengembalian</option>
							</select>	
                        
						</div>
                       
					</div>
					</form>
				</div>
			</div>
			<!-- /form input -->
									<div class="card-header ">
							</div>					
        				</div>
					</div>					
        		</div>
			</div>					
        </div>
		<!-- /main content -->
</div>
<!-- /page content -->
@endsection
