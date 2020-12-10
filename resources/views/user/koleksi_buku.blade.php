@extends('dashboard.base')

@section('css')
	<!-- Core JS files -->
	<script src="{{asset('/global_assets')}}/js/main/jquery.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/main/bootstrap.bundle.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
    <script src="{{asset('/global_assets')}}/js/plugins/media/fancybox.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/forms/selects/select2.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/tables/datatables/extensions/fixed_columns.min.js"></script>

	<script src="{{asset('/assets')}}/js/app.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/gallery_library.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/datatables_extension_fixed_header.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/form_layouts.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                        <span class="breadcrumb-item active">Buku</span>
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
                    <div class=" table-bordered table-responsive ">
                        <!-- Basic datatable -->
                        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                            <div class="d-flex">
                                <div class="breadcrumb">
                                    <h5 class="breadcrumb-item" style="padding-top:15px">Koleksi Buku</h5>
                                </div>
                            </div>
                        </div> 
                        <label style="margin-left:26px;padding-top:18px" ><b>Urutkan Menurut</b></label>
							<form action="{{ route('koleksi.buku') }}" method="get">
							<div class="input-group mb-3 col-md-4 float-left" style="margin-left:15px">
                                <select name="kategori_id" class="form-control">
									<option value="">--Kategori Buku--</option>
									@foreach($kategori as $cat)
									<option value="{{ $cat->id }}" @if($request->kategori_id == $cat->id) selected @endif>{{ $cat->nama_kategori}}</option>
									@endforeach
                                </select>
                                <button class="btn btn-info ml-2" type="submit">Filter</button>
                            </div>
                            </form> <br>           
					    <div class="card-header ">
                        <table class="table table-striped datatable-header-basic">
                            <thead>
                                <tr class="bg-green">
                                    <th>No</th>
                                    <th>Cover</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Kategori</th>
                                    <th>Rak</th>
                                    <th>Stok</th>
                                    <th class="text-center">Actions</th>                              
                                </tr>
                            </thead>
                            <tbody>
                            @php $i=1 @endphp
                                @foreach($buku as $book)
                                <tr>
                                    <td>{{ $i++}}</td>
                                    @if($book->cover != '')
                                    <td><a href="{{ url('/uploads/'.$book->cover) }}" data-popup="lightbox">
                                            <img class="img-fluid" width="50px" src="{{ url('/uploads/'.$book->cover) }}">
                                            </a></td>
                                            @else
                                            <td>
                                            <img class="img-fluid" width="50px" src="{{ url('/uploads/'.$book->cover) }}">
                                            </td>
                                            @endif
                                    <td>{{ $book->judul_buku }}</td>
                                    <td>{{ $book->penulis }}</td>
                                    <td>{{ $book->nama_kategori}}</td>
                                    <td>{{ $book->rak}}</td>
                                    <td>{{ $book->jumlah }}</td>
                                    <td class="text-center"> 
                                       <a href="{{ url('/buku_list/' . $book->id) }}" class="btn btn-success btn-icon btn-sm"><i class="icon-menu7"></i></a>
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
                <!-- /content area -->
            </div>
            <!-- /content area -->
        </div>
        <!-- /content area -->
    </div>
    <!-- /content area -->
</div>
<!-- /content area -->

<script src="{{asset('/js')}}/sweetalert2.all.js"></script>
    @include('sweetalert::alert')
<script src="{{asset('/js')}}/sweetalert.js"></script>
<script>
    $('.delete-confirm').on('click', function (e) {
        event.preventDefault();
        const url = $(this).attr('href');
            swal({
            title: 'Apakah Yakin?',
            text: 'Ingin Menghapus data buku ',
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