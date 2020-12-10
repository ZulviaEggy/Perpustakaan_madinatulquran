@extends('dashboard.master')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Perpustakaan</title>
  <link rel="shortcut icon" href="{{asset('logo_sekolah.ico')}}" />

	<!-- Global stylesheets -->
    <link href="{{asset('/assets')}}/css/colors.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/assets')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/assets')}}/css/bootstrap.css" rel="stylesheet" type="text/css">
</head>

<body class="bg-login">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

        	<!-- Login form -->
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3 text-black">
              <img src="{{asset('/global_assets')}}/images/logo_sekolah.png" width="90" height="90" alt="">
              <h2 style="color:black">SI Perpustakaan</h2>
                <p class="d-block text-muted">Pondok Pesantren Madinatul Quran</p>
							</div>
              
                <div class="card mb-0">
                  <div class="card-body">
                  <div class="form-group text-center text-muted content-divider">
                      <span class="px-2">Forgot Password</span>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        @foreach ($errors->all() as $error)
                          <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach 

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="icon-user"></i>
                            </span>
                          </div>
                            <input class="form-control" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required autofocus>
                              @error('email')
                                  <span class="invalid-feedback">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                        </div>

                        <div class="form-group">
                          <button type="submit" class="btn btn-block btn-green">
                            Send Password Reset Link
                          </button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
        </div>
        <!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>

