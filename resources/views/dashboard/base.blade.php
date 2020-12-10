<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v3.0.0-alpha.1
* @link https://coreui.io
* Copyright (c) 2019 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Perpustakaan</title>
    <link rel="shortcut icon" href="{{asset('logo_sekolah.ico')}}" />

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset('/global_assets')}}/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
	<link href="{{asset('/assets')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="{{asset('/assets')}}/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="{{asset('/assets')}}/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="{{asset('/assets')}}/css/components.css" rel="stylesheet" type="text/css">
	<link href="{{asset('/assets')}}/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	@section('css')

    @show

  </head>
  <body class="navbar-top">
  <!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark fixed-top">
    @include('dashboard.navbar')

		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
			</ul>
            <span class="badge bg-success badge-pill ml-md-3 mr-md-auto">Online</span>

			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    @if(in_array(Auth::user()->role_id,[1,2,3,4]))
                        @if(Auth::user()->photo == '')

                    <img src="{{asset('/global_assets')}}/images/placeholders/people.png" class="rounded-circle mr-2" width="34" height="34" alt="">
                        @else

                        <img class="rounded-circle mr-2" src="{{ url('/photo/profile/'.Auth::user()->photo) }}" width="34" height="34" alt="">
                        @endif
                        <span>{{Auth::user()->nama}} <i>({{Auth::user()->role->privilege_level}})</i></span>
                    </a>
                    @elseif(Auth::user()->role_id == 6)
                        @if(Auth::user()->guru->photo == '')

                    <img src="{{asset('/global_assets')}}/images/placeholders/people.png" class="rounded-circle mr-2" width="34" height="34" alt="">
                        @else

                        <img class="rounded-circle mr-2" src="{{ url('/photo/guru/'.Auth::user()->guru->photo) }}"width="34" height="34" alt="">
                        @endif
                        <span>{{Auth::user()->guru->nama_lengkap}} <i>({{Auth::user()->role->privilege_level}})</i></span>
                    </a>
                    @else(Auth::user()->role_id == 5)
                        @if(Auth::user()->siswa->photo == '')

                    <img src="{{asset('/global_assets')}}/images/placeholders/people.png" class="rounded-circle mr-2" width="34" height="34" alt="">
                        @else

                        <img class="rounded-circle mr-2" src="{{ url('/photo/siswa/'.Auth::user()->siswa->photo) }}"width="34" height="34" alt="">
                        @endif
                        <span>{{Auth::user()->siswa->nama_siswa}} <i>({{Auth::user()->role->privilege_level}})</i></span>
                    </a>
                    @endif
                    

					<div class="dropdown-menu dropdown-menu-right">
                    @if(in_array(Auth::user()->role_id,[1,2,3,4]))
                        <a href="{{ route('profile_show') }}" class="nav-link" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                        @endif
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"> 
                            <i class="icon-switch2"></i>
                                <span>
                                Log Out
                                </span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                        </a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->

  <!-- Sidebar content -->
     <!-- partial -->
     <div class="sidebar sidebar-dark sidebar-main sidebar-fixed sidebar-expand-md">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar-content" id="sidebar">
      @section('sidebar')
      @include('dashboard.sidebar',['user' => Auth::User()])
      @show
      </nav>
        <div class="main-panel">
            <div class="content-wrapper">
            @yield('content')
            </div>
        <!-- partial -->
        </div>
<!-- /navbar content -->
  </body>
</html>
