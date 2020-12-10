<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Perpustakaan</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset('/global_assets')}}/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
	<link href="{{asset('/assets')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="{{asset('/assets')}}/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="{{asset('/assets')}}/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="{{asset('/assets')}}/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="{{asset('/assets')}}/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<!-- /theme JS files -->

</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark fixed-top">

<!-- Header with logos -->
<div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
<div class="navbar-brand">
    <a href="index.html" class="d-inline-block">
        <img src="{{asset('/global_assets')}}/images/perpus.png" alt="">
    </a>
</div>
    
    
</div>
<!-- /header with logos -->

<!-- Navbar content -->
<div class="collapse navbar-collapse" id="navbar-mobile">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                <i class="icon-paragraph-justify3"></i>
            </a>
        </li>
    </ul>
    <span class="badge bg-success badge-pill ml-md-3 mr-md-auto">Online</span>
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
                <div class="dropdown-content-header">
                    <span class="font-weight-semibold">Messages</span>
                    <a href="#" class="text-default"><i class="icon-compose"></i></a>
                </div>
            </div>
        </li>

        <li class="nav-item dropdown dropdown-user">
            <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('/global_assets')}}/images/placeholders/placeholder.jpg" class="rounded-circle mr-2" height="34" alt="">
                <span>Admin</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ url('/profile') }}" class="nav-link" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                <a href="#" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
            </div>
        </li>
    </ul>
</div>
<!-- /navbar content -->

</div>
<!-- /main navbar -->

            
<!-- Page content -->
<div class="page-content">

<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-fixed sidebar-expand-md">

    <!-- Sidebar content -->
    <div class="sidebar-content">
        
        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        <a href="#"><img src="{{asset('/global_assets')}}/images/placeholders/placeholder.jpg" width="38" height="38" class="rounded-circle" alt=""></a>
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">Admin</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-pin font-size-sm"></i>Admin Anggota
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

  
				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">
					<!-- Main -->
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
						<li class="nav-item ">
							<a href="{{ url('/') }}" class="nav-link ">
								<i class="icon-home4"></i>
								<span>
									Dashboard
								</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ url('/kategori') }}" class="nav-link ">
								<i class="icon-file-text"></i>
								<span>
									Kategori
								</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ url('/buku') }}" class="nav-link active">
								<i class="icon-book3"></i>
								<span>
								Buku
								</span>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{ url('/absensi') }}" class="nav-link  ">
								<i class="icon-book"></i>
								<span>
								Laporan
								</span>
							</a>
						</li>
                <!-- /page kits -->
                </ul>
        </div>
        <!-- /main navigation -->


    </div>
    <!-- /sidebar content -->
    
</div>
<!-- /main sidebar -->


<!-- Main content -->
<div class="content-wrapper">
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">							
                </div>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Buku</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

            <div class="header-elements d-none">
                <div class="breadcrumb justify-content-center">
                    
                    <div class="breadcrumb-elements-item dropdown p-0">
                        <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-gear mr-2"></i>
                            Settings
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
                            <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
                            <a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->


			<!-- Content area -->
			<div class="content">

                     <!-- Basic datatable -->
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Daftar Buku</h5>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a href="{{ route('buku.create') }}" class="btn btn-green">
                                        <i class="icon-plus-circle2 mr-2"></i>
                                        <span>
                                        Tambah buku
                                        </span>
                                    </a>
                                </div>
                            </div>
                    </div>                    
                    <div class=" table-bordered table-responsive ">
                    <table class="table datatable-fixed-left" width="100%">
						<thead>
					        <tr class="bg-green">
					           <th>No</th>
					            <th>Kode Buku</th>
					            <th>Judul</th>
					            <th>Penulis</th>
					            <th>Penerbit</th>
					            <th>Kategori</th>
                                <th>Rak</th>
					            <th>Tahun Terbit</th>
					            <th>ISBN</th>
                                <th>Jumlah</th>
                                <th>Dipinjam</th>
                                <th class="text-center">Actions</th>                              
					        </tr>
					    </thead>
					    <tbody>
                          @foreach($buku as $book)
                            <tr>
                              <td>{{ $book->id }}</td>
                              <td>{{ $book->kode_buku }}</td>
                              <td>{{ $book->judul_buku }}</td>
                              <td>{{ $book->penulis }}</td>
                              <td>{{ $book->penerbit }}</td>
                              <td>{{ $book->kategori->nama_kategori}}</td>
                              <td>{{ $book->kategori->rak}}</td>
                              <td>{{ $book->tahun_terbit }}</td>
                              <td>{{ $book->ISBN }}</td>
                              <td>{{ $book->jumlah }}</td>
                              <td>{{ $book->ISBN }}</td>
                              <td class="list-icons"> 
                                <button><a href="{{ url('/buku/' . $book->id) }}" class="text-success"><i class="icon-menu6"></i></a></button>
                                <button><a href="{{ url('/buku/' . $book->id . '/edit') }}" class="text-primary-600"><i class="icon-pencil5"></i></a></button>
                                <button><a href="/buku/delete/{{$book->id}}" class="text-danger delete-confirm"><i class="icon-trash"></i></a></button>
                              
                                <!-- <form action="{{ route('buku.destroy', $book->id ) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="text-danger delete-confirm" type="submit"><i class="icon-trash"></i></button>
                                </form>
                                 -->
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

	</div>
	<!-- /page content -->

</body>
</html>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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