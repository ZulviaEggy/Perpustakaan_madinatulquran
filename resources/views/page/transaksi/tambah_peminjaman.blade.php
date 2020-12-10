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
	<script src="{{asset('/global_assets')}}/js/plugins/pickers/daterangepicker.js"></script>

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
						<span class="breadcrumb-item active">Tambah Peminjaman</span>
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
					<h5 class="card-title">Tambah Peminjaman</h5>
					<div class="header-elements">
						<div class="list-icons">
				            <a class="list-icons-item" data-action="collapse"></a>
				        </div>
			        </div>
				</div>
							
				@section('js')
				@show
				<div class="card-body">
					<form method="POST" action="{{ route('peminjaman.store') }}">
                    @csrf
					<div class="form-group row{{ $errors->has('kode_pinjam') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Nomor peminjaman:</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" value="{{ $kode }}" name="kode_pinjam" value="{{ old('kode_pinjam') }}">
							@if ($errors->has('kode_pinjam'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kode_pinjam') }}</strong>
                                </span>
                            @endif
						</div>
					</div>

                    <div class="form-group row{{ $errors->has('buku_id') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Kode Buku:<span class="text-danger">*</span></label>
						<div class="col-lg-9">
						<select name="buku_id" class="form-control form-control-select2">
								<option value="">Masukkan kode buku atau scan barcode</option>
								@foreach ($book as $b)
								<option value="{{ $b->kode_buku }}">{{ $b->kode_buku . ' - '. $b->judul_buku }}</option>
								@endforeach
							</select>
							@if ($errors->has('buku_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('buku_id') }}</strong>
                                </span>
                            @endif
						</div>
					</div>


					<div class="form-group row{{ $errors->has('tanggal_peminjaman') ? ' has-error' : '' }}">
						<label class="col-lg-3 col-form-label">Tanggal pinjam:</label>
						<div class="input-group col-lg-9">
							<span class="input-group-prepend">
							<span class="input-group-text"><i class="icon-calendar22"></i></span>
							</span>
								<input type="text" class="form-control" value="{{ date('m/d/Y', strtotime(Carbon\Carbon::today()->toDateString())) }}" name="tanggal_peminjaman" required readonly="">
								@if ($errors->has('tanggal_peminjaman'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tanggal_peminjaman') }}</strong>
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
								<input type="text" class="form-control" value="{{ date('m/d/Y', strtotime(Carbon\Carbon::today()->addDays(7)->toDateString())) }}" name="tanggal_harus_kembali" required readonly="">
								@if ($errors->has('tanggal_harus_kembali'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tanggal_harus_kembali') }}</strong>
                                </span>
                           		@endif
						</div>
					</div>

					
					<div class="form-group row{{ $errors->has('jenis_identitas') ? ' has-error' : '' }}">
						<label class="col-form-label col-lg-3">Tipe Anggota<span class="text-danger">*</span></label>
						<div class="col-lg-9">
							<select  name="jenis_identitas" type="text" class="form-control form-control-uniform" id="tipe">
								<option value="">--Pilih--</option>
								<option value="nis">Siswa</option>
								<option value="nip">Guru</option>
							</select>
							@if ($errors->has('jenis_identitas'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jenis_identitas') }}</strong>
                                </span>
                            @endif
						</div>
					</div>

                    <div class="form-group row{{ $errors->has('nis') ? ' has-error' : '' }}" id="nis" style="display:none;">
						<label class="col-lg-3 col-form-label">ID peminjam:<span class="text-danger">*</span></label>
						<div class="col-lg-9">
							<select name="nis" class="form-control form-control-select2">
								<option value="">Masukkan NIS</option>
								@foreach ($siswa as $d)
								<option value="{{ $d->NIS }}">{{ $d->NIS . ' - '. $d->nama_siswa }}</option>
								@endforeach
							</select>
							@if ($errors->has('nis'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nis') }}</strong>
                                </span>
                            @endif
						</div>
					</div>

					<div class="form-group row{{ $errors->has('nip') ? ' has-error' : '' }}" id="nip" style="display:none;">
						<label class="col-lg-3 col-form-label">ID peminjam:<span class="text-danger">*</span></label>
						<div class="col-lg-9">
							<select name="nip" class="form-control form-control-select2">
								<option value="">Masukkan NIP</option>
								@foreach ($guru as $g)
								<option value="{{ $g->NIP }}">{{ $g->NIP . ' - '. $g->nama_lengkap }}</option>
								@endforeach
							</select>
							@if ($errors->has('nip'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nip') }}</strong>
                                </span>
                            @endif
						</div>
					</div>

					<div class="form-group row">
						<label class="col-lg-3 col-form-label">Keterangan: <i>tanda</i><span class="text-danger"> (*)</span> harus diisi</label>
					</div>

					<div class="text-right">
                        <button type="submit" id="submit" class="btn btn-primary col-lg-1 ml-1">Simpan<i ></i></button>
							<a href="{{ route('peminjaman.index') }}"  class="btn btn-danger col-lg-1 ml-1">Kembali</a>
					</div>
					</form>		
				</div>
				<!-- /basic layout -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->


<script>
  $(document).ready(function(){

   $('.dynamic').change(function(){
    if($(this).val() != '')
    {
     var select = $(this).attr("id");
     var value = $(this).val();
     var dependent = $(this).data('dependent');
     var _token = $('input[name="_token"]').val();
    
   } 
 });

  
  $("#tipe").change(function(){
    if ($(this).val() == "nis") {
      $("#nis").show();
    }else{
      $("#nis").hide();
    }

    if ($(this).val() == "nip") {
      $("#nip").show();
    }else{
      $("#nip").hide();
    }
  });
});
</script>

@endsection