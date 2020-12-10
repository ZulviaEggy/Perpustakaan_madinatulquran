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
						<a href="{{ url('/peminjaman') }}" class="breadcrumb-item">Transaksi</a>
					<span class="breadcrumb-item active">Pengembalian</span>
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
			<div class="alert bg-green alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   Denda buku harap dibayarkan langsung ke petugas
                </div>
               <!-- Basic layout-->
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Tambah Pengembalian</h5>
					<div class="header-elements">
						<div class="list-icons">
				            <a class="list-icons-item" data-action="collapse"></a>
				        </div>
			        </div>
				</div>
							
				@php 
					$denda = 0;
					$terlambat = 0;
					$kondisi_buku = $pinjam->kondisi_buku;
					$tanggal_peminjaman = strtotime($pinjam->tanggal_peminjaman); 
					$tanggal_harus_kembali = strtotime(Carbon\Carbon::today()); 
  
					if ($tanggal_harus_kembali > $tanggal_peminjaman){
						$terlambat = round(abs($tanggal_harus_kembali - $tanggal_peminjaman) / 86400) - 7;
						$denda = 1000 * $terlambat;
					} if ($terlambat < 0){
						$terlambat = 0;
						$denda = 0;
					} 
				@endphp
						
				<div class="card-body">
					<form method="POST" action="{{ route('pengembalian.update', $pinjam->id) }}">
                    @csrf
                    @method('PUT')
					<div class="form-group row{{ $errors->has('kode_pinjam') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Nomor peminjaman:</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" value="{{ $pinjam->kode_pinjam }}" name="kode_pinjam" value="{{ old('kode_pinjam') }}">
							@if ($errors->has('kode_pinjam'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kode_pinjam') }}</strong>
                                </span>
                            @endif
						</div>
					</div>

                    <div class="form-group row{{ $errors->has('buku_id') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Kode Buku:</label>
						<div class="col-lg-9">
							<input type="text" name="buku_id" value="{{ $pinjam->buku_id }}" class="form-control" placeholder="Masukkan kode buku" value="{{ old('buku_id') }}">
							@if ($errors->has('buku_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('buku_id') }}</strong>
                                </span>
                            @endif
						</div>
					</div>
									
					@if($pinjam->nis != '')
                    <div class="form-group row">
						<label class="col-lg-3 col-form-label">ID peminjam:</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" value="{{ $pinjam->nis }}" placeholder="Masukkan id peminjam" name="nis">
						</div>
					</div>
					@else
					<div class="form-group row">
						<label class="col-lg-3 col-form-label">ID peminjam:</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" value="{{ $pinjam->nip }}" placeholder="Masukkan id peminjam" name="nip">
						</div>
					</div>
					@endif

					<div class="form-group row{{ $errors->has('tanggal_peminjaman') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Tanggal pinjam:</label>
						<div class="input-group col-lg-9">
							<span class="input-group-prepend">
								<span class="input-group-text"><i class="icon-calendar22"></i></span>
							</span>
							<input type="text" class="form-control" value="{{ date('Y-m-d', strtotime($pinjam->tanggal_peminjaman)) }}" name="tanggal_peminjaman">
							@if ($errors->has('tanggal_peminjaman'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tanggal_peminjaman') }}</strong>
                                </span>
                           	@endif
						</div>
					</div>

					<div class="form-group row{{ $errors->has('tanggal_harus_kembali') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Tanggal harus kembali:</label>
						<div class="input-group col-lg-9">
							<span class="input-group-prepend">
								<span class="input-group-text"><i class="icon-calendar22"></i></span>
							</span>
							<div type="text" class="form-control">{{  date('Y-m-d', strtotime($pinjam->tanggal_harus_kembali)) }}</div>
							@if ($errors->has('tanggal_harus_kembali'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tanggal_harus_kembali') }}</strong>
                            </span>
                           	@endif
						</div>
					</div>

					<div class="form-group row{{ $errors->has('tanggal_harus_kembali') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Tanggal kembali:</label>
						<div class="input-group col-lg-9">
							<span class="input-group-prepend">
								<span class="input-group-text"><i class="icon-calendar22"></i></span>
							</span>
							<input type="text" class="form-control" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" name="tanggal_harus_kembali">
						</div>
					</div>

					<div class="form-group row{{ $errors->has('keterlambatan') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Keterlambatan:</label>
						<div class="col-lg-3">
							<input type="text" class="form-control" value="{{ $terlambat }}" name="keterlambatan">
							@if ($errors->has('keterlambatan'))
                            <span class="help-block">
                            	<strong>{{ $errors->first('keterlambatan') }}</strong>
                            </span>
                           	@endif
						</div>
                        <div class=" mt-0 mt-lg-0 align-self-center">
							<span class="text">Hari</span>
						</div>
					</div>

					<div class="form-group row{{ $errors->has('denda') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Denda Keterlambatan:</label>
						<div class="col-lg-3">
							<input type="text" class="form-control" value="{{ $denda }}" name="denda" id="sum1" onkeyup="sum();">
							@if ($errors->has('denda'))
                            <span class="help-block">
                                <strong>{{ $errors->first('denda') }}</strong>
                            </span>
                           	@endif
						</div>
					</div>

					<div class="form-group row{{ $errors->has('kondisi_buku') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Kondisi Buku:</label>
						<div class="col-lg-3">
							<select class="form-control form-control-uniform" name="kondisi_buku" id="tipe">
								<option disabled selected>--Pilih--</option>
			                    <option value="baik">Baik</option>
			                    <option value="rusak">Rusak</option>
								<option value="hilang">Hilang</option>
			                </select>
							@if ($errors->has('kondisi_buku'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kondisi_buku') }}</strong>
                            </span>
                           	@endif
						</div>
					</div>
							  	
					<div class="form-group row{{ $errors->has('denda_buku') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Denda Kondisi Buku:</label>
						<div class="col-lg-5">
							<input type="number" class="form-control" placeholder="Masukkan jumlah denda (contoh = 20000)" name="denda_buku" id="sum2" onkeyup="sum();">
							@if ($errors->has('denda_buku'))
                            <span class="help-block">
                                <strong>{{ $errors->first('denda_buku') }}</strong>
                            </span>
                           	@endif
						</div>
					</div>

					<div class="form-group row">
						<label class="col-lg-3 col-form-label">Total Denda:</label>
						<div class="col-lg-5">
							<input type="text" class="form-control" id="sum3">
						</div>
					</div>

					<div class="text-right">
                        <button type="submit" class="btn btn-primary col-lg-1 ml-1">Simpan<i ></i></button>
						<a href="{{ route('peminjaman.index') }}"  class="btn btn-danger col-lg-1 ml-1">Kembali</a>
					</div>
					</form>
				</div>
			</div>
			<!-- /form input -->
		</div>
		<!-- /content area -->
	</div>
	<!-- /main content -->
</div>
<!-- /page content -->
<script>
    function sum(){
        var txtFirstNumberValue = document.getElementById('sum1').value;
        var txtSecondNumberValue = document.getElementById('sum2').value;
        var result = parseInt(txtFirstNumberValue)+ parseInt(txtSecondNumberValue);
        if (!isNaN(result)){
            document.getElementById('sum3').value = result;
        }
    }
    </script>
@endsection

