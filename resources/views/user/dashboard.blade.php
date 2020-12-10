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
    <script src="{{asset('/global_assets')}}/js/plugins/media/fancybox.min.js"></script>


	<script src="{{asset('/assets')}}/js/app.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/gallery_library.js"></script>
	<script src="{{asset('/global_assets')}}/js/demo_pages/datatables_extension_fixed_columns.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/dashboard.js"></script>
	<script src="{{asset('/global_assets')}}/js/demo_pages/layout_fixed_sidebar_custom.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/datatables_extension_fixed_header.js"></script>

            
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
            <!-- <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                </div>
                <div class="header-elements d-none">
                    <div class="d-flex justify-content-center">							
                    </div>
                </div>
            </div> -->
            <!-- <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div> -->
            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <span class="breadcrumb-item active">Dashboard</span>
                    </div>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>
        </div>
	    <!-- /page header -->
		

	
        <!-- Content area -->
        <div class="content">
            <!-- Search field -->
            <div class="card">
                <div class="card-body">
                    <h1 class="mb-3 text-center font-weight-semibold text-uppercase">Selamat Datang di SI Perpustakaan</h1>
                    <h3 class="mb-3 text-center font-weight-semibold">Sekolah Tahfids Madinatul Quran</h3>
                    <br>
                    <div class=" table-bordered table-responsive ">
            
                        <!-- Basic datatable -->
                        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                            <div class="d-flex">
                                <div class="breadcrumb">
                                    <h6 class="breadcrumb-item ">Daftar Transaksi Peminjaman dan Perpanjangan Buku</h6>
                                </div>
                            </div>
                        </div> 
                        <div class="card-header ">
                        <table class="table datatable-fixed-right" width="100%">
                            <thead>
                                <tr class="bg-green">
                                    <th>No</th>
                                    <th>No Peminjaman</th>
                                    <th>Kode Buku</th>
                                    <th>Judul</th>
                                    <th>Tanggal pinjam</th>
                                    <th>Tanggal harus kembali</th>
                                    <th>Status</th>
                                    <th>Keterlambatan (hari)</th>
                                    <th>Denda</th>
    					        </tr>
                            </thead>
                            <tbody>
                            @php $i=1 @endphp
                            @foreach($peminjaman as $pinjam)
                                <tr>
                                    <td>{{ $i++}}</td>
                                    <td>{{ $pinjam->kode_pinjam }}</td>
                                    <td>{{ $pinjam->buku_id }}</td>
                                    <td>{{ $pinjam->judul_buku }}</td>
                                    <td>{{  date('d F Y', strtotime($pinjam->tanggal_peminjaman)) }}</td>
                                    <td>{{  date('d F Y', strtotime($pinjam->tanggal_harus_kembali)) }}</td>
                                    <td> 
                                        <span class="{{ $pinjam->class }}">
                                            {{ $pinjam->name }}
                                        </span>
                                    </td>
                                        <?php 
                                            $denda = 0;
                                            $terlambat = 0;
                                            $tanggal_peminjaman = strtotime($pinjam->tanggal_peminjaman); 
                                            $tanggal_harus_kembali = strtotime(Carbon\Carbon::today()); 
                
                                            if ($tanggal_harus_kembali > $tanggal_peminjaman){
                                                $terlambat = round(abs($tanggal_harus_kembali - $tanggal_peminjaman) / 86400) - 7;
                                                $denda = 1000 * $terlambat;
                                            } if ($terlambat < 0){
                                                $terlambat = 0;
                                                $denda = 0;
                                            }
                                            ?>
                                    <td class="text-center">{{ $terlambat }}</td>
                                    <td class="text-center">Rp {{ $denda }}.00</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                        <!-- /left fixed column -->
                    </div>
                </div>
                <!-- /content area -->
            </div>

            <!-- Inner container -->
            <div class="d-flex align-items-start flex-column flex-md-row">
    

            <!-- Left content -->
            <div class="w-100 overflow-auto order-2 order-md-1">
                <div class="card">
                    <div class="card-body">
                        <div class=" table-bordered table-responsive ">
                        <!-- Basic datatable -->
                            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                                <div class="d-flex">
                                    <div class="breadcrumb">
                                        <h5 class="breadcrumb-item" style="padding-top:15px">Daftar Usulan Buku</h5>
                                    </div>
                                </div>
                            </div> 
                            <div class="card-header ">
                            <table class="table datatable-header-basic">
                                <thead>
                                    <tr class="bg-green">
                                        <th>No</th>
                                        <th>Judul Buku </th>
                                        <th>Pengarang </th>
                                        <th>Keterangan tambahan</th>
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
                <!-- /inner container -->

                <!-- Inner container -->
                <!-- <div class="d-flex align-items-start flex-column flex-md-row">

                   
                    <div class="w-100 overflow-auto order-2 order-md-1">
                        <div class="card">
                            <div class="breadcrumb" style="padding-left:20px">
                                <h6 class="breadcrumb-item ">Daftar Riwayat Peminjaman Buku</h6>
                            </div>
                        </div>
    
                        <div class="card-body" id="tag_container">
                        
                        </div>

                    </div> -->
                    <!-- /left content -->
                <!-- </div> -->
                <!-- /inner container -->
            </div>
            <!-- /content area -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->

<script>
        document.getElementById("Btn").disabled = true;
</script>
</body>
</html>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });
    
    $(document).ready(function()
    {
        $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
  
            var myurl = $(this).attr('href');
            var page=$(this).attr('href').split('page=')[1];
  
            getData(page);
        });
  
    });
  
    function getData(page){
        $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#tag_container").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
        });
    }
</script>
  
@endsection