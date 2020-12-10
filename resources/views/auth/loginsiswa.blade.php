
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
              
              <form class="login-form" method="POST" action="{{ url('loginsiswa') }}">
                <div class="card mb-0">
                  <div class="card-body">
                  <div class="form-group text-center text-muted content-divider">
                      <span class="px-2">Login Untuk Admin</span>
                    </div>
                    @csrf
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach 

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text">
                          <i class="icon-user"></i>
                          </span>
                      </div>
                        <input class="form-control" type="text" placeholder="Masukkan NIS" name="nis" value="{{ old('nis') }}" required autofocus>
                          @error('nis')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                    </div>

                    <div class="input-group mb-4">
                      <div class="input-group-prepend">
                          <span class="input-group-text">
                          <i class="icon-lock"></i>
                          </span>
                      </div>
                        <input class="form-control" type="password" placeholder="{{ __('Password') }}" name="password" required>
                        @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>

                    <div class="form-group d-flex text-right">
                        <a href="{{route ('password.request') }}" class="ml-auto">{{ __('Forgot Your Password?') }}</a>
                    </div>

                    <button class="btn btn-block btn-green" type="submit">{{ __('Login') }}</button>

                    <div class="form-group  text-muted content-divider">
                    </div>
                      <span class=" textS text-center text-muted">
                    <div>Untuk Admin dan Guru silahkan login melaui link berikut:</span>
                    </div> 
                    <div class="row mt-3">
                      <div class="col-6">
                        <a href="{{route ('login') }}" class="textS"><small>Login Sebagai Admin</small></a>
                      </div>
                      <div class="col-6 text-right">
                        <a href="{{ url('/loginguru') }}" class="textS"><small>Login Sebagai Guru</small></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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

