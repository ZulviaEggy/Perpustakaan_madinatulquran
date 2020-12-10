@extends('dashboard.base')

@section('css')
	<!-- Core JS files -->
	<script src="{{asset('/global_assets')}}/js/main/jquery.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/main/bootstrap.bundle.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

    <script type="text/javascript" src="{{asset('/global_assets')}}/js/main/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{asset('/global_assets')}}/js/main/jquery-2.2.4.min.js"></script>
	<script type="text/javascript" src="{{asset('/global_assets')}}/js/main/jquery.printPage.js"></script>

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
                        <a href="{{ url('/buku') }}" class="breadcrumb-item">Buku</a>
                        <a href="{{ url('/buku/' . $book->id) }}" class="breadcrumb-item">Detail Buku</a>
                        <span class="breadcrumb-item active">Barcode</span>
                    </div>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>
        </div>
        <!-- /page header -->
        <div class="card">
            <div class="card-header header-elements-inline">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body header-elements-inline">
                            <h4 class="card-title">Generate Barcode Buku</h4>
                            <div class="text-right">
                                <a href="{{  url('/prnpriview/' . $book->id) }}" class="btnprn btn btn-green"><b><i class="icon-printer2 mr-2"></i>Cetak</b></a>
									<script type="text/javascript">
									$(document).ready(function(){
									$('.btnprn').printPage();
									});
									</script>			
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
            <html>
            <body>
            <div class="container">
                <div class="text-left">
                    <div style="margin-left: 3%; padding-bottom:10%">
                        <?php
                        for($i=1;$i<=$book->print_qty;$i++){
                            echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("$book->kode_buku", 'C128',2,48,array(1,1,1), true) . '" alt="barcode" style="padding-bottom: 15px;"/>&nbsp&nbsp&nbsp&nbsp&nbsp';
                            }
                        ?> 
                    </div>
                </div>
            </div>
            </body>
            </html>
            @endsection
