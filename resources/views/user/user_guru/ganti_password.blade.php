@extends('dashboard.base')

@section('css')

	<!-- Core JS files -->
	<script src="{{asset('/global_assets')}}/js/main/jquery.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/main/bootstrap.bundle.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
    <script src="{{asset('/global_assets')}}/js/plugins/forms/selects/select2.min.js"></script>
    <script src="{{asset('/global_assets')}}/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="{{asset('/global_assets')}}/js/plugins/forms/validation/validate.min.js"></script>

	<script src="{{asset('/assets')}}/js/app.js"></script>
	<script src="{{asset('/global_assets')}}/js/demo_pages/form_inputs.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/form_layouts.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/form_validation.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/form_checkboxes_radios.js"></script>
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
							<span class="breadcrumb-item active">Ganti Password</span>
					</div>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">
           
				<!-- Form inputs -->
				<div class="card">

               		<!-- Basic layout-->
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Ubah password</h5>
					</div>
							
					<div class="card-body">
                        <form method="POST" action="{{ route('change.password') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- @foreach ($errors->all() as $error)
                    	<div class="alert alert-danger">{{ $error }}</div>
                        @endforeach  -->

                        <div class="form-group row{{ $errors->has('current_password') ? ' has-error' : '' }}">
                        	<label for="password" class="col-lg-3 col-form-label">Current password</label>
                            <div class="col-lg-9">
								<input id="password" type="password" name="current_password" class="form-control" placeholder="Current Password" autocomplete="current-password">
								@if ($errors->has('current_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current_password') }}</strong>
                                </span>
                            	@endif
							</div>
                    	</div>

						<div class="form-group row">
							<label for="password" class="col-lg-3 col-form-label">New password</label>
							<div class="col-lg-9">
								<input id="new_password" type="password"  placeholder="{{ __('Password') }}" class="form-control" onkeyup='check();' name="new_password" autocomplete="current-password">
								@if ($errors->has('new_password'))
								<span class="help-block">
									<strong>{{ $errors->first('new_password') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row{{ $errors->has('new_confirm_password') ? ' has-error' : '' }}">
							<label for="password-confirm" class="col-lg-3 col-form-label">Re-type new password</label>
							<div class="col-lg-9">
								<input id="new_confirm_password" type="password" class="form-control" onkeyup="check()" placeholder="{{ __('Konfirmasi Password') }}" name="new_confirm_password" autocomplete="current-password">
								@if ($errors->has('new_confirm_password'))
								<span class="help-block">
									<strong>{{ $errors->first('new_confirm_password') }}</strong>
								</span>
								@endif
									<span id='message'></span>
							</div>
						</div>
                                    
						<div class="text-right">
                            <button class="btn btn-success col-lg-2 ml-1" type="submit" >Ubah Password</button>
						</div>
						</form>
					</div>
				</div>
				<!-- /form inputs -->
			</div>
			<!-- /content area -->
		</div>
		<!-- /page header -->
	</div>
	<!-- /main content -->
</div>
<!-- /page content -->

    <script src="{{asset('/js')}}/sweetalert2.all.js"></script>
        @include('sweetalert::alert')
@endsection
