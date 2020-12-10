

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

	<script src="{{asset('/assets')}}/js/app.js"></script>
	<script src="{{asset('/global_assets')}}/js/demo_pages/datatables_extension_fixed_header.js"></script>
	
	<!-- /theme JS files -->

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
							<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Dashboard</span>
						</div>
						<a href="#" class="header-elements-toggle text-defau lt d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<!-- /page header -->

			<!-- Content area -->
			<div class="content">

                <!-- Basic datatable -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Noted</h5>
                       	<div class="header-elements">
                        	<div class="list-icons">
                            </div>
                        </div>
                    </div>                    
					<div class="table-bordered table-responsive ">
						<div class="card">
						<label style="margin-left:26px;margin-top:20px" ><b>Urutkan Menurut</b></label>
							<form action="{{ route('noted.index') }}" method="get">
							<div class="input-group mb-3 col-md-4 float-left" style="margin-left:15px">
								<select name="status" class="form-control">
									<option value="">--Status Usulan--</option>
									<option value="Diproses">Diproses</option>
									<option value="Disetujui">Disetujui</option>
									<option value="Ditolak">Ditolak</option>
								</select> 
									<button class="btn btn-info ml-2" type="submit">Filter</button>
							</div>
							</form>
							
							<table class="table datatable-header-noted">
								<thead>
									<tr class="bg-green">
										<th>No</th>
										<th>Nama </th>
										<th>Judul Buku </th>
										<th>Keterangan tambahan</th>
										<th>Tanggal Usulan</th>
										<th class="text-center">Status</th>
										<th class="text-center">Actions</th>
									</tr>
								<thead>
								<tbody>
								@php $i=1 @endphp
								@foreach($noted as $n)
									<tr>
										<td>{{ $i++}}</td>
										<td>{{ $n->nama }}</td>
										<td>{{ $n->judul }}</td>
										<td>{{ $n->deskripsi }}</td>
                                    	<td>{{  date('d F Y', strtotime($n->tanggal_usulan)) }}</td>
										@if($n->status == 'Diproses' )
										<td><form action="{{ route('usulan.user', $n->id) }}" method="post" enctype="multipart/form-data">
											@csrf
											@method('PUT')
													<select class="mdb-select dropdown-primary" placeholder="{{ $n->status }}" name="status">
														<option value="{{ $n->status }}" disabled selected>{{ $n->status }}</option>
														<option value="Disetujui">Disetujui</option>
														<option value="Ditolak">Ditolak</option>
													</select> 
													<button name='okk' class="btn btn-success btn-sm">ok</button>										
												</form>	
											</td>
											@else
											<td class="text-center">{{ $n->status }}</td>
											@endif
										<td class="text-center"> 
											<a href="{{  url('/noted/' . $n->id) }}" class="btn btn-success btn-icon btn-sm"><i class="icon-menu7"></i></a>
											<a href="/noted/delete/{{$n->id}}" class="btn btn-danger btn-icon btn-sm delete-confirm"><i class="icon-trash"></i></a>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
							</div>	 
							</div>
					
				</div>
				<!-- /basic database -->
			</div>
			<!-- /content area -->
		</div>
		<!-- /main content -->
</div>
<!-- /page content -->

<script src="{{asset('/js')}}/sweetalert2.all.js"></script>
@include('sweetalert::alert')
<script src="{{asset('/js')}}/sweetalert.js"></script>
<script>
    $('.delete-confirm').on('click', function (e) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Are you sure?',
            text: 'Delete this data. ',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });
</script>
@endsection


