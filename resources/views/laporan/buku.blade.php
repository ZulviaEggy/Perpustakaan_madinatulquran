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
	

	<script src="{{asset('/assets')}}/js/app.js"></script>
	<script src="{{asset('/global_assets')}}/js/demo_pages/datatables_extension_fixed_columns.js"></script>
	<!-- /theme JS files -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

            
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
						<span class="breadcrumb-item active">Laporan buku</span>
					</div>
					<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
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
					<h4 class="card-title">Laporan Buku</h4>
						<div class="text-right">
							<div class="btn-group dropdown">
							<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<b><i class="icon-printer2 mr-2"></i> Export PDF</b>
							</button>
								<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
									<a class="dropdown-item" href="{{ url('laporan/buku/pdf') }}"> Semua Buku</a>
									<a class="dropdown-item" href="" data-toggle="modal" data-target="#kolModal"> Data Buku Berdasarkan Tanggal</a>
									<a class="dropdown-item" href="{{ url('laporan/buku/pdfKosong') }}"> Data Buku Kosong</a>
									<a class="dropdown-item" href="" data-toggle="modal" data-target="#exportBukuKosong"> Buku Sering Dipinjam</a>
								</div>
							</div>
							<div class="btn-group dropdown">			
								<button type="button" class="btn btn-green dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<b><i class="icon-printer2 mr-2"></i> Export Excel</b>
								</button>
								<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
									<a class="dropdown-item" href="{{ url('laporan/buku/excel') }}"> Semua Peminjaman</a>
									<a class="dropdown-item" href="" data-toggle="modal" data-target="#ExcelModal"> Data Buku Berdasarkan Tanggal</a>
									<a class="dropdown-item" href="{{ url('laporan/buku/bukuKosong') }}"> Data Buku Kosong</a>
									<a class="dropdown-item" href="" data-toggle="modal" data-target="#excelBukuKosong"> Buku Sering Dipinjam</a>
								</div>
							</div>

							<!-- Cetak berdasarkan tanggal -->
							<div class="modal fade" id="kolModal" tabindex="-1" role="dialog">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header bg-primary">
											<h5 class="modal-title" id="defaultModalLabel">CETAK DATA BERDASARKAN TANGGAL</h5>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('buku.laporanPdf') }}" method="get" target="_blank">
												<div class="form-group row">
												<h6 class="font-weight-semibold" style="padding-left:13px">Masukkan tanggal</h6>
													<div class="col-lg-12">
														<input type="text" id="created_at" name="date" class="form-control">
														</input>
													</div>
												</div>
												<div class="" style="padding-top:10px">
													<a target="_blank" class="btn btn-primary" id="exportpdf">Export PDF</a>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
				
						<!-- Cetak berdasarkan tanggal -->
						<div class="modal fade" id="exportBukuKosong" tabindex="-1" role="dialog">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header bg-primary">
											<h5 class="modal-title" id="defaultModalLabel">CETAK DATA BERDASARKAN TANGGAL</h5>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('buku.laporanPdfPinjam') }}" method="get" target="_blank">
												<div class="form-group row">
												<h6 class="font-weight-semibold" style="padding-left:13px">Masukkan tanggal</h6>
													<div class="col-lg-12">
														<input type="text" id="tanggal_peminjaman" name="date" class="form-control">
														</input>
													</div>
												</div>
												<div class="" style="padding-top:10px;padding-left:460px">
													<a target="_blank" class="btn btn-primary" id="exportBuku">Export PDF</a>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
			
					<!-- Export excel berdasarkan tanggal -->
					<div class="modal fade" id="ExcelModal" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-col-blue-grey" style="border-radius: 10px;">
								<div class="modal-header bg-green">
									<h5 class="modal-title" id="defaultModalLabel">CETAK DATA BERDASARKAN TANGGAL</h5>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">
									<form action="{{ route('report.bukuExcel') }}" method="get" target="_blank">
										<div class="form-group row">
										<h6 class="font-weight-semibold" style="padding-left:13px">Masukkan tanggal</h6>
											<div class="col-lg-12">
												<input type="text" id="date" name="date" class="form-control">                                
												</input>
											</div>
										</div>
										<div class="text-right" style="padding-top:10px">
												<a target="_blank" class="btn btn-green" id="exportexcel">Export Excel</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				
					<!-- Export excel buku kosong -->
					<div class="modal fade" id="excelBukuKosong" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-col-blue-grey" style="border-radius: 10px;">
								<div class="modal-header bg-green">
									<h5 class="modal-title" id="defaultModalLabel">CETAK DATA BERDASARKAN TANGGAL</h5>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">
									<form action="{{ route('report.bukuExcelDipinjam') }}" method="get" target="_blank">
										<div class="form-group row">
										<h6 class="font-weight-semibold" style="padding-left:13px">Masukkan tanggal</h6>
											<div class="col-lg-12">
												<input type="text" id="tanggal_pinjam" name="date" class="form-control">                                
												</input>
											</div>
										</div>
										<div class="text-right" style="padding-top:10px">
												<a target="_blank" class="btn btn-green" id="exportexcelDipinjam">Export Excel</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				
					<div class=" table-bordered table-responsive ">
						<div class="card">
						</div>
							<table class="table datatable-fixed-left3" width="100%">
								<thead>
									<tr class="bg-green">
										<th>No</th>
										<th>Kode Buku</th>
										<th>Judul</th>
										<th>Penulis</th>
										<th>Penerbit</th>
										<th>Kategori</th>
										<th>Rak</th>
										<th>Tahun Terbit</th>
										<th>ISBN</th>
										<th>Jumlah</th>
										<th>Created_at</th>
									</tr>
								</thead>
					    		<tbody>
								@php $i=1 @endphp
								@foreach($datas as $book)
									<tr>
									<td>{{ $i++ }}</td>
									<td>{{ $book->kode_buku }}</td>
									<td>{{ $book->judul_buku }}</td>
									<td>{{ $book->penulis }}</td>
									<td>{{ $book->penerbit }}</td>
									<td>{{ $book->kategori->nama_kategori}}</td>
									<td>{{ $book->kategori->rak}}</td>
									<td>{{ $book->tahun_terbit }}</td>
									<td>{{ $book->ISBN }}</td>
									<td>{{ $book->jumlah }}</td>
									<td>{{ $book->created_at}}</td>
									</tr>
								@endforeach
								</tbody>
							</table>
					</div>
				</div>
			</div>
        </div>
	</div>
    <!-- /main content -->          
</div>


<!-- /page content -->


<script>
  //Export PDF berdasarkan tanggal sesuai bulan ini
    $(document).ready(function() {
        let start = moment().startOf('month')
        let end = moment().endOf('month')

        //Export PDF diset URL berdasarkan tanggal tersebut
        $('#exportpdf').attr('href', '/buku/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

        //Inisiasi daterangepicker
        $('#created_at').daterangepicker({
            startDate: start,
            endDate: end
        }, function(first, last) {

        //Jika user mengubah value, manipulasi link dari export pdf
        $('#exportpdf').attr('href', '/buku/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
        })
    })
    </script>
	<script>
  //Export PDF berdasarkan tanggal sesuai bulan ini
    $(document).ready(function() {
        let start = moment().startOf('month')
        let end = moment().endOf('month')

        //Export PDF diset URL berdasarkan tanggal tersebut
        $('#exportBuku').attr('href', '/laporan/buku/pdfPinjam/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

        //Inisiasi daterangepicker
        $('#tanggal_peminjaman').daterangepicker({
            startDate: start,
            endDate: end
        }, function(first, last) {

        //Jika user mengubah value, manipulasi link dari export pdf
        $('#exportBuku').attr('href', '/laporan/buku/pdfPinjam/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
        })
    })
    </script>
	<script>
	//Export excel berdasarkan tanggal
    //Ketika pertama kali di load tanggalnya maka diset tanggal pertama dan terakhir bulan ini 
    $(document).ready(function() {
        let start = moment().startOf('month')
        let end = moment().endOf('month')

            //Export PDF diset URL berdasarkan tanggal tersebut
            $('#exportexcel').attr('href', '/laporan/buku/excel/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

        	//Inisiasi daterangepicker
            $('#date').daterangepicker({
                startDate: start,
                endDate: end
            }, function(first, last) {
                //Jika user mengubah value, manipulasi link dari export pdf
                $('#exportexcel').attr('href', '/laporan/buku/excel/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
            })
        })
	</script>
		<script>
	//Export excel berdasarkan tanggal
    //Ketika pertama kali di load tanggalnya maka diset tanggal pertama dan terakhir bulan ini 
    $(document).ready(function() {
        let start = moment().startOf('month')
        let end = moment().endOf('month')

            //Export PDF diset URL berdasarkan tanggal tersebut
            $('#exportexcelDipinjam').attr('href', '/laporan/buku/excelDipinjam/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

        	//Inisiasi daterangepicker
            $('#tanggal_pinjam').daterangepicker({
                startDate: start,
                endDate: end
            }, function(first, last) {
                //Jika user mengubah value, manipulasi link dari export pdf
                $('#exportexcelDipinjam').attr('href', '/laporan/buku/excelDipinjam/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
            })
        })
	</script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection