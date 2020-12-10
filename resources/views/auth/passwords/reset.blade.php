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
                                            <span class="px-2">Reset Password</span>
                                            </div>

                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
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

                                        <input type="hidden" name="token" value="{{ $token }}">

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="icon-user"></i>
                                                    </span>
                                                </div>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                    

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="icon-lock"></i>
                                                    </span>
                                                </div>
                                                <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control" name="password" required>
                                            </div>
                                    

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="icon-lock"></i>
                                                    </span>
                                                </div>
                                                <input id="password-confirm" type="password"  class="form-control" placeholder="{{ __('Konfirmasi Password') }}" name="password_confirmation" required>

                                                @if ($errors->has('password_confirmation'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <button type="submit" class="btn btn-block btn-green">
                                                Reset Password
                                            </button>
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


