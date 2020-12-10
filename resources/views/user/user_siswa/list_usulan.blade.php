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
    <script src="{{asset('/global_assets')}}/js/demo_pages/gallery_library.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/datatables_extension_fixed_header.js"></script>
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
                        <span class="breadcrumb-item active">List usulan</span>
                    </div>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>
        </div>
        <!-- /page header -->

        <div class="content">
            <!-- Search field -->
            <div class="card">
                <div class="card-body">
                <div class="alert bg-green alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Usulan buku ditujukan untuk mengusulkan buku yang tidak tersedia di dalam koleksi perpustakaan
                </div>
                    <div class=" table-bordered table-responsive ">
                        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                            <div class="d-flex">
                                <div class="breadcrumb">
                                    <h5 class="breadcrumb-item" style="padding-top:15px">Daftar Usulan Buku</h5>
                                </div>
                            </div>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a href="{{ route('kirimusulan.siswa') }}" class="btn btn-green">
                                    <i class="icon-paperplane mr-2"></i>
                                        <span>
                                            Kirim Usulan
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div> 
                        <div class="card-header ">
                        <table class="table datatable-header-footer">
                            <thead>
                                <tr class="bg-green">
                                    <th>No</th>
                                    <th>Judul Buku </th>
                                    <th>Pengarang </th>
                                    <th >Keterangan tambahan</th>
                                    <th>Tanggal Usulan</th>
                                    <th>Status</th>
					            </tr>
                            </thead>
                            <tbody>
                            @php $i=1 @endphp
                            @foreach($usulan as $noted)
                                <tr>
                                    <td>{{ $i++}}</td>
                                    <td>{{ $noted->judul }}</td>
                                    <td>{{ $noted->pengarang }}</td>
                                    <td>{{ $noted->deskripsi }}</td>
                                    <td>{{  date('d F Y', strtotime($noted->tanggal_usulan)) }}</td>
                                    @if($noted->status == 'Disetujui')
                                    <td class="text-center"><span class="badge badge-success badge-pill">{{ $noted->status }}</span></td>
                                    @elseif($noted->status == 'Ditolak')
                                    <td class="text-center"><span class="badge badge-danger badge-pill">{{ $noted->status }}</span></td>
                                    @else
                                    <td class="text-center"><span class="badge badge-primary badge-pill">{{ $noted->status }}</span></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        <!-- /left fixed column -->
                    </div> 
                </div>
                    <!-- /left content -->
            </div>
        </div>
        <!-- /content area -->
	</div>
	<!-- /main content -->
</div>
<!-- /page content -->
<script src="{{asset('/js')}}/sweetalert2.all.js"></script>
	@include('sweetalert::alert')
</body>
</html>

@endsection