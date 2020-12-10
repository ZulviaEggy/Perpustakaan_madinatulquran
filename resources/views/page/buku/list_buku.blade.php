
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
    <script src="{{asset('/global_assets')}}/js/demo_pages/form_select2.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/datatables_extension_fixed_columns.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/gallery_library.js"></script>
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
                        <span class="breadcrumb-item active">Buku</span>
                    </div>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
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
                            <a href="{{url('format_buku')}}" class="btn btn-xs btn-info"><i class="icon-file-spreadsheet2 mr-2"></i>Format Excel</a>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importExcel">
                                <i class="icon-printer2 mr-2"></i>Import Excel
                                </button>
                        </div>
                    </div>
                </div> 
                <div class=" table-bordered table-responsive ">    
                    <div class="card">
                        <div class="">
                            <div class="header-elements">
                                <div class="list-icons ">
                                </div>
                            </div>  
                                
                                @if ($errors->any())
                                <script>
                                    $(document).ready(function () {
                                    $('#importExcel').modal('show');
                                    });
                                </script>
                                @endif

                            <!-- Import Excel -->
                            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="post" action="{{ url('import_buku') }}" enctype="multipart/form-data">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
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
                                            <h6 class="font-weight-semibold">Pilih file excel</h6>
                                            <div class="form-group">
                                                <input type="file" name="file">
                                                <span class="form-text text-muted">Upload file with format .xls or .xlsx</span>
                                                <!-- @if ($errors->any())
                                                    <span class="help-block">
                                                            @foreach ($errors->all() as $error)
                                                            <strong>{{ $error }}</strong>
                                                            @endforeach
                                                    </span>
                                                @endif -->
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Import</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>    
                                
                        <label style="margin-left:26px" ><b>Urutkan Menurut</b></label>
							<form action="{{ route('buku.index') }}" method="get">
							<div class="input-group mb-3 col-md-4 float-left" style="margin-left:15px">
                                <select name="kategori_id" class="form-control form-control-uniform">
									<option value="">--Kategori Buku--</option>
									@foreach($kategori as $cat)
									<option value="{{ $cat->id }}" @if($request->kategori_id == $cat->id) selected @endif>{{ $cat->nama_kategori}}</option>
									@endforeach
                                </select>
                                <button class="btn btn-info ml-2" type="submit">Filter</button>
                            </div>
                            </form>                           
                        <table class="table table-striped media-library" width="100%">
                            <thead>
                                <tr class="bg-green">
                                    <th>No</th>
                                    <th ><input type="checkbox" id="master"></th>
                                    <th>Kode Buku</th>
                                    <th>Judul</th>
                                    <th>Rak</th>
                                    <th>Jumlah</th>
                                    <th class="text-center">Actions</th>                              
                                </tr>
                            </thead>
                            <tbody>
                            @php $i=1 @endphp
                            @foreach($buku as $book)
                                <tr>
                                    <td>{{ $i++}}</td>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{$book->id}}" ></td>
                                    <td>{{ $book->kode_buku }}</td>
                                    <td><h7 class="font-weight-semibold">{{ $book->judul_buku }}</h7>
                                    <span class="d-block text-muted">Kategori: {{ $book->nama_kategori}}</span></td>
                                    <td>{{ $book->rak}}</td>
                                    <td>{{ $book->jumlah }}</td>
                                    <td class=""> 
                                        <a href="{{ url('/buku/' . $book->id) }}" class="btn btn-success btn-icon btn-sm"><i class="icon-menu7"></i></a>
                                        <a href="{{ url('/buku/' . $book->id . '/edit') }}" class="btn btn-primary btn-icon btn-sm"><i class="icon-pencil5"></i></a>
                                        <a href="/buku/delete/{{$book->id}}" class="btn btn-danger btn-icon btn-sm delete-confirm"><i class="icon-trash"></i></a>
                                    
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
				   
                    <button style="margin-bottom: 18px; margin-left:760px" class="btn  btn-xs btn-danger delete_all" data-url="{{ url('mybookDeleteAll') }}"><i class="icon-trash mr-2"></i>Delete All Selected</button>
			    </div>
			   
		    </div>
		    <!-- /basic database -->
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
<script src="{{asset('/js')}}/sweetalert.js"></script>
<script>
$('.delete-confirm').on('click', function (e) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'Delete this data. ',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true); 
         } else {  
            $(".sub_chk").prop('checked',false); 
         }  
        });

        $('.delete_all').on('click', function(e) {
            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  

            if(allVals.length <=0)  
            {  
                swal({
                    title: 'Please select checkbox!',
                    icon: 'info',
                })
            }  else {  
                var check =  swal({
                    title: 'Are you sure?',
                    text: 'Delete this selected data.',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then((check) => {
                
                if(check == true){  
                    var join_selected_values = allVals.join(","); 
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                    swal("Success.", "Book has been deleted!", "success");
                                });
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });

                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }
              }) 
            }  
        });

        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });

        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();

            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                       alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
            return false;
        });
    });
</script>
@endsection
