
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

	<script src="{{asset('/js')}}/sweetalert2.all.js"></script>
	@include('sweetalert::alert')
            
<!-- Page content -->
<div class="page-content">

	<!-- Main sidebar -->
	<div class="sidebar sidebar-dark sidebar-main sidebar-fixed sidebar-expand-md">

	</div>
	<!-- /sidebar content -->
			
		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="{{ url('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<a href="{{ url('/laporan/transaksi') }}" class="breadcrumb-item">Transaksi</a>
							<span class="breadcrumb-item active">Laporan perpanjangan</span>
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
							<h4 class="card-title">Laporan Transaksi Perpanjangan</h4>
								<div class="text-right">
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#kolModal">
									<b><i class="icon-printer2 mr-2"></i>Export PDF</b>
								</button>
								<button type="button" class="btn btn-green" data-toggle="modal" data-target="#ExcelModal">
									<b><i class="icon-printer2 mr-2"></i>Export Excel</b>
								</button>
									<!-- Export berdasarkan tanggal -->
									<div class="modal fade" id="kolModal" tabindex="-1" role="dialog">
										<div class="modal-dialog" role="document">
											<div class="modal-content modal-col-blue-grey" style="border-radius: 10px;">
												<div class="modal-header bg-primary">
													<h5 class="modal-title" id="defaultModalLabel">CETAK DATA BERDASARKAN TANGGAL</h5>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<div class="modal-body">
													<form action="{{ route('report.perpanjangan') }}" method="get" target="_blank">
														<div class="form-group row">
														<h6 class="font-weight-semibold" style="padding-left:13px">Masukkan tanggal</h6>
																<div class="col-lg-12">
																	<input type="text" id="created_at" name="date" class="form-control">                                
																	</div>
																	</input>
																</div>
															</div>
														<div class="modal-footer">
															<a target="_blank" class="btn btn-primary ml-2" id="exportpdf">Export PDF</a>
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
													<form action="{{ route('report.perpanjanganExcel') }}" method="get" target="_blank">
														<div class="form-group row">
														<h6 class="font-weight-semibold" style="padding-left:13px">Masukkan tanggal</h6>
																<div class="col-lg-12">
																	<input type="text" id="date" name="date" class="form-control">                                
																	</div>
																	</input>
																</div>
															</div>
														<div class="modal-footer">
															<a target="_blank" class="btn btn-green ml-2" id="exportexcel">Export Excel</a>
														</div>
													</form>
												</div>
											</div>
										</div>
								
										<div class=" table-bordered table-responsive ">
											<div class="card">
											</div>
											<div class="table-bordered table-responsive ">
											<table class="table datatable-fixed-transaksi" width="100%">
												<thead>
													<tr class="bg-green">
														<th>No</th>
														<th>No Peminjaman</th>
														<th>Kode Buku</th>
														<th>Judul</th>
														<th>Id Peminjam</th>
														<th>Tipe anggota</th>
														<th>Nama peminjam</th>
														<th>Tanggal pinjam</th>
														<th>Tanggal harus kembali</th>
														<th>Status</th>
														<th>Keterlambatan</th>
														<th>Denda</th>
														<th>Created_at</th>
													</tr>
												</thead>
												<tbody>
												@php $i=1 @endphp
												@foreach($peminjaman as $pinjam)
													<tr>
														<td>{{ $i++ }}</td>
														<td>{{ $pinjam->kode_pinjam }}</td>
														<td>{{ $pinjam->buku_id }}</td>
														<td>{{ $pinjam->judul_buku }}</td>
														@if($pinjam->nip == '')
														<td>{{ $pinjam->NIS }}</td>
														<td>Siswa</td>
														<td>{{ $pinjam->nama_siswa }}</td>
														@else
														<td>{{ $pinjam->NIP }}</td>
														<td>Guru</td>
														<td>{{ $pinjam->nama_lengkap }}</td>
														@endif
														<td>{{  date('d F Y', strtotime($pinjam->tanggal_peminjaman)) }}</td>
                                    					<td>{{  date('d F Y', strtotime($pinjam->tanggal_harus_kembali)) }}</td>
														<td> 
															<span class="{{ $pinjam->class }}">
																{{ $pinjam->name }}
															</span>
															</td>
															@if($pinjam->keterlambatan == '')
														<td class="text-center">0</td>
														@else
														<td class="text-center">{{ $pinjam->keterlambatan }}</td>
														@endif
														@if($pinjam->denda == '')
														<td class="text-center">Rp 0.00</td>
														@else
														<td class="text-center">Rp {{ $pinjam->denda }}</td>
														@endif
														<td>{{$pinjam->created_at}}</td>
													</tr>
												@endforeach
												</tbody>
											</table>
										</div>
										
            					</div>
								<!-- /export excel -->
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
            $('#exportpdf').attr('href', '/transaksi/perpanjangan/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

            //Inisiasi daterangepicker
            $('#created_at').daterangepicker({
                startDate: start,
                endDate: end
            }, function(first, last) {
                 //Jika user mengubah value, manipulasi link dari export pdf
                $('#exportpdf').attr('href', '/transaksi/perpanjangan/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
            })
        })
    </script>
	<script>
       //Ketika pertama kali di load tanggalnya maka diset tanggal pertama dan terakhir bulan ini 
        $(document).ready(function() {
            let start = moment().startOf('month')
            let end = moment().endOf('month')

           //Export PDF diset URL berdasarkan tanggal tersebut
            $('#exportexcel').attr('href', '/laporan/trs/excel_perpanjangan/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

            //Inisiasi daterangepicker
            $('#date').daterangepicker({
                startDate: start,
                endDate: end
            }, function(first, last) {
                //Jika user mengubah value, manipulasi link dari export pdf
                $('#exportexcel').attr('href', '/laporan/trs/excel_perpanjangan/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
            })
        })
    </script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
