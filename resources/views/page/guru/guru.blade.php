
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
                        <span class="breadcrumb-item active">Guru</span>
                    </div>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>
        </div>
        <!-- /page header -->

		<!-- Content area -->
		<div class="content">

            <!-- Basic datatable -->
            <div class="card">
                <div class="card-header header-elements-inline">
                <h5 class="card-title">Daftar Guru</h5>
                    <div class="header-elements">
                        <div class="list-icons">
							<a href="{{ route('guru.create') }}" class="btn btn-green">
                                <i class="icon-plus-circle2 mr-2"></i>
                                <span>
                                Tambah Guru
                                </span>
                            </a>        
                            <a href="{{url('format_guru')}}" class="btn btn-xs btn-info"><i class="icon-file-spreadsheet2 mr-2"></i>Format Import</a>
                            <button type="button" class="btn btn-info " data-toggle="modal" data-target="#importExcel">
                            <i class="icon-printer2 mr-2"></i>Import Excel
                        </button>
						</div>
                    </div>
                </div>                    
                <div class="table-bordered table-responsive">
                        <div class="card-header header-elements-inline">
                        @if ($errors->any())
                                <script>
                                    $(document).ready(function () {
                                    $('#importExcel').modal('show');
                                    });
                                </script>
                        @endif
                            
                        <!-- Import Excel -->
                        <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form method="post" action="{{ url('import_guru') }}" enctype="multipart/form-data">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title" id="exampleModalLabel">Import Data Excel</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                            <!-- @if (session()->has('failures'))

                                            <table class="table table-danger">
                                                <tr>
                                                    <th>Row</th>
                                                    <th>Attribute</th>
                                                    <th>Errors</th>
                                                    <th>Value</th>
                                                </tr>

                                                @foreach (session()->get('failures') as $validation)
                                                    <tr>
                                                        <td>{{ $validation->row() }}</td>
                                                        <td>{{ $validation->attribute() }}</td>
                                                        <td>
                                                            <ul>
                                                                @foreach ($validation->errors() as $e)
                                                                    <li>{{ $e }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            {{ $validation->values()[$validation->attribute()] }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>

                                            @endif -->
                                            <h6 class="font-weight-semibold">Pilih file excel</h6>
                                            <div class="form-group">
                                                <input type="file" name="file">
                                                <span class="form-text text-muted">Upload file with format .xls or .xlsx</span>
                                                <!-- @if ($errors->any())
                                                    <span class="help-block">
                                                            @foreach ($errors->all() as $error)
                                                           <strong>{{ $error }}</strong>
                                                            @endforeach
                                                    </span>
                                                @endif -->
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Import</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>               
					<table class="table table-striped datatable-fixed-guru" width="100%">
						<thead>
					        <tr class="bg-green">
								<th>No</th>
					            <th>NIP</th>
					            <th>Nama Lengkap</th>
                                <th>No Telp</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
							</tr>
                        </thead>
						<tbody>
                            @php $i=1 @endphp
                            @foreach($guru as $g)
                            <tr>
                                <td>{{ $i++}}</td>
                                <td>{{ $g->NIP }}</td>
                                <td>{{ $g->nama_lengkap }}</td>
                                <td>{{ $g->no_telp }}</td>
                                <td>{{ $g->email }}</td>
                                @if($g->status == 'Aktif')
                                <td class="text-center"><span class="badge badge-success badge-pill">{{ $g->status }}</span></td>
                                @else
                                <td class="text-center"><span class="badge badge-danger badge-pill">{{ $g->status }}</span></td>
                                @endif
                                <td class="list-icons"> 
                                    <a href="{{ url('/guru/' . $g->id) }}" class="btn btn-success btn-icon btn-sm"><i class="icon-menu7"></i></a>
                                    <a href="{{ url('/guru/' . $g->id . '/edit') }}" class="btn btn-primary btn-icon btn-sm"><i class="icon-pencil5"></i></a>
                                    <a href="/guru/delete/{{$g->id}}" class="btn btn-danger btn-icon btn-sm delete-confirm"><i class="icon-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
					</table>
                </div>
			</div>
			<!-- /left fixed column -->
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
