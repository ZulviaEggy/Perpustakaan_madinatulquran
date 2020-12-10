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
	<script src="{{asset('/global_assets')}}/js/demo_pages/gallery_library.js"></script>
	<!-- /theme JS files -->

	<!-- <script type="text/javascript">
   		$(document).on('click', '.pilih', function (e) {
                document.getElementById("buku_id").value = $(this).attr('book-buku_id');
                $('#myModal').modal('hide');
            });

             $(function () {
                $("#lookup").dataTable();
            });

        </script> -->

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
						<a href="{{ url('/noted') }}" class="breadcrumb-item">Noted</a>
						<span class="breadcrumb-item active">Detail noted</span>
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
				<h5 class="card-title">Detail Noted</h5>
					<div class="header-elements">
						<div class="list-icons">
				            <a class="list-icons-item" data-action="collapse"></a>
				        </div>
			        </div>
				</div>

           
				<div class="card-body">
					<div class="container">
						<form action="#">
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">User Id:</label>
								<div class="col-lg-9">
								@if($noted->nip == '')
								<div type="text" class="form-control">{{ $noted->nis }}</div>
								@else($noted->nis == '')
								<div type="text" class="form-control">{{ $noted->nip }}</div>
								@endif
								</div>
						</div>
                                  
						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Nama : <span class="text-danger"></span></label>
							<div class="col-lg-9">
								<div type="text" class="form-control">{{ $noted->nama }}</div>										
							</div>
						</div>

						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Judul : <span class="text-danger"></span></label>
							<div class="col-md-9">
								<div id="buku_id" type="text" class="form-control">{{ $noted->judul }}</div>
							</div>
							<!-- <div class="col-md-3 text-right">
								<button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal"><b>Cari Buku</b> <span class="fa fa-search"></span></button>
							</div> -->
						</div>

						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Pengarang : <span class="text-danger"></span></label>
							<div class="col-lg-9">
								<div type="text" class="form-control">{{ $noted->pengarang }}</div>										
							</div>
						</div>

						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Tanggal Usulan : <span class="text-danger"></span></label>
							<div class="col-lg-9">
								<div type="text" class="form-control">{{ $noted->tanggal_usulan }}</div>										
							</div>
						</div>
						

						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Keterangan Tambahan: <span class="text-danger"></span></label>
								<div class="col-lg-9">
								<div type="text" class="form-area" >{{ $noted->deskripsi }}</div>			
								</div>									
							</div>
						</div>	

						<div class="form-group row">
							<label class="col-lg-3 col-form-label">Status Usulan: <span class="text-danger"></span></label>
							<div class="col-lg-9">
								<div type="text" class="form-control">{{ $noted->status }}</div>												
							</div>
						</div>	
									
						<div class="text-right">
							<a href="{{ route('noted.index') }}"  class="btn btn-danger col-lg-2 ml-1">Kembali</a>
						</div>
						</form>
					</div>
				</div>
			</div>
			<!-- /basic layout -->
		</div>
		<!-- /content area -->
	</div>
	<!-- /main content -->
</div>
<!-- /page content -->

  <!-- Modal -->
  <!-- <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <table id="lookup" class="table table-bordered table-hover table-striped">
						<thead>
                                <tr >
									<th>Kode Buku</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Kota Terbit</th>
                                    <th>Kategori</th>
                                    <th>Tahun Terbit</th>
                                    <th>ISBN</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($buku as $book)
                                <tr class="pilih" book-buku_id="<?php echo $book->id; ?>" book-judul_buku="<?php echo $book->judul_buku; ?>">
						  			<td>{{ $book->kode_buku }}</td>
                                    <td>{{ $book->judul_buku }}</td>
                                    <td>{{ $book->penulis }}</td>
                                    <td>{{ $book->penerbit }}</td>
                                    <td>{{ $book->kota_terbit }}</td>
                                    <td>{{ $book->nama_kategori}}</td>
                                    <td>{{ $book->tahun_terbit }}</td>
                                    <td>{{ $book->ISBN }}</td>
                                    <td>{{ $book->jumlah }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div> -->

@endsection

