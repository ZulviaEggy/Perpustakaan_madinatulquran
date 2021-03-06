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
                        <span class="breadcrumb-item active">Kategori</span>
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
                    <h5 class="card-title">Daftar Kategori</h5>
                       	<div class="header-elements">
                        	<div class="list-icons">
                                <a href="{{ url('/tambah_kategori') }}" class="btn btn-green">
                                    <i class="icon-plus-circle2 mr-2"></i>
                                    <span>
                                    Tambah Kategori
                                    </span>
                                </a>                              	
                            </div>
                        </div>
                    </div>                    
					<div class="table-bordered table-responsive">
					<table class="table table-striped datatable-fixed-left3" width="100%">
						<thead>
					        <tr class="bg-green">
								<th>No</th>
					            <th>Kategori</th>
					            <th>Rak</th>
                                <th class="text-center">Actions</th>
                                </tr> 
                            </thead>
					    <tbody>
                          @php $i=1 @endphp
                          @foreach($kategorie as $kategori)
                            <tr>
                              <td>{{ $i++}}</td>
                              <td>{{ $kategori->nama_kategori}}</td>
                              <td>{{ $kategori->rak }}</td>
                              <td class="text-center"> 
                                <a href="{{ url('/kategori/' . $kategori->id . '/edit') }}" class="btn btn-primary btn-icon btn-sm"><i class="icon-pencil5"></i></a>
								<a href="/kategori/delete/{{$kategori->id}}" class="btn btn-danger btn-icon btn-sm delete-confirm"><i class="icon-trash"></i></a>

								<!-- <form action="{{ route('kategori.destroy', $kategori->id ) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="text-danger  delete-confirm" type="submit"><i class="icon-trash"></i></button>
                                </form> -->
                              </td>
                            </tr>
                          @endforeach
						</tbody>
					</table>
				</div>
				<!-- /left fixed column -->
			</div>
			<!-- /content area -->
		</div>
		<!-- /main content -->

<script src="{{asset('/js')}}/sweetalert2.all.js"></script>
@include('sweetalert::alert')
</body>
</html>
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