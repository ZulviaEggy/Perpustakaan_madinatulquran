
@extends('dashboard.base')

@section('css')
	<!-- Core JS files -->
	<script src="{{asset('/global_assets')}}/js/main/jquery.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/main/bootstrap.bundle.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('/global_assets')}}/js/plugins/forms/selects/select2.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/tables/datatables/extensions/fixed_columns.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/tables/datatables/datatables.min.js"></script>

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
                        <a href="{{ url('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                        <span class="breadcrumb-item active">Transaksi</span>
                    </div>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
                <div class="header-elements d-none">
                    <div class="breadcrumb justify-content-center">
                    </div>
                </div>
            </div>
        </div>
        <!-- /page header -->

        <div class="content">
            <!-- Search field -->
            <div class="card">
                <div class="card-body">
                    <div class=" table-bordered table-responsive ">
                        <!-- Basic datatable -->
                        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                            <div class="d-flex">
                                <div class="breadcrumb">
                                    <h5 class="breadcrumb-item" style="padding-top:15px">Transaksi Buku</h5>
                                </div>
                            </div>
                        </div> 
                        <div class="card-header ">
                        <table class="table table-striped datatable-fixed-right4" width="100%">
                            <thead>
                                <tr class="bg-green">
                                    <th>No</th>
                                    <th>No Peminjaman</th>
                                    <th>Judul</th>
                                    <th>Tanggal pinjam</th>
                                    <th>Tanggal kembali</th>
                                    <th>Status</th>
                                    <th class="text-center">Actions</th>         
                                </tr>
                            </thead>
                            @php $i=1 @endphp
                            <tbody>
                            @foreach($peminjaman as $pinjam)
                                <tr>
                                    <td>{{ $i++}}</td>
                                    <td>{{ $pinjam->kode_pinjam }}</td>
                                    <td>{{ $pinjam->judul_buku }}</td>
                                    <td>{{  date('d F Y', strtotime($pinjam->tanggal_peminjaman)) }}</td>
                                    <td>{{  date('d F Y', strtotime($pinjam->tanggal_harus_kembali)) }}</td>
                                    <td> 
                                        <span class="{{ $pinjam->class }}">
                                            {{ $pinjam->name }}
                                        </span>
                                    </td>
                                    <td class="text-center"> 
                                       <a href="{{ url('/detail_transaksi/' . $pinjam->kode_pinjam . '/show' ) }}" class="btn btn-success btn-icon btn-sm"><i class="icon-menu7"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
					    </table>
                        </div>
				    </div>
				    <!-- /left fixed column -->
                </div>
			</div>
		</div>
    </div>
	<!-- /main content -->
</div>
<!-- /page content -->

<script>
        document.getElementById("Btn").disabled = true;
</script>

<script src="{{asset('/js')}}/sweetalert2.all.js"></script>
	@include('sweetalert::alert')


<script src="{{asset('/js')}}/sweetalert.js"></script>
<script>
$('.delete-confirm').on('click', function (e) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Apakah Yakin?',
        text: 'Ingin Menghapus transaksi buku ini ',
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