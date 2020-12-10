
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
    <script src="{{asset('/global_assets')}}/js/plugins/media/fancybox.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/forms/styling/uniform.min.js"></script>

	<script src="{{asset('/assets')}}/js/app.js"></script>
	<script src="{{asset('/global_assets')}}/js/demo_pages/datatables_extension_fixed_columns.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/gallery_library.js"></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Page content -->
<div class="page-content">

    <!-- Main sidebar -->
    <div class="sidebar sidebar-dark sidebar-main sidebar-fixed sidebar-expand-md">

    </div>
        <!-- /sidebar content -->

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="{{ url('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                        <span class="breadcrumb-item active">Transaksi</span>
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
                    <h5 class="card-title">Data Transaksi</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a href="{{ url('/tambah_peminjaman') }}" class="btn btn-green">
                                <i class="icon-plus-circle2 mr-2"></i>
                                <span>
                                    Tambah Peminjaman
                                </span>
                            </a>                                
                        </div>
                    </div>
                </div> 
                
                <div class="table-bordered table-responsive ">
                    <div class="card">
                        <label style="margin-left:26px;margin-top:20px" ><b>Urutkan Menurut</b></label>
						<form action="{{ route('peminjaman.index') }}" method="get">
						<div class="input-group mb-3 col-md-4 float-left" style="margin-left:15px">
                            <select name="status_id" class="form-control">
								<option value="">--Status Transaksi--</option>
								@foreach($status as $s)
								<option value="{{ $s->id }}" @if($request->status_id == $s->id) selected @endif>{{ $s->name }}</option>
								@endforeach
                            </select>
                                <button class="btn btn-info ml-2" type="submit">Filter</button>
                        </div>
                        </form> 
                        <table class="table table-striped media-library" width="100%">
                            <thead>
                                <tr class="bg-green">
                                    <th>No</th>
                                    <th><input type="checkbox" id="master"></th>
                                    <th>No Peminjaman</th>
                                  
                                    <th>Judul</th>
                                  
                                    <th>Nama peminjam</th>
                                    <th>Tanggal pinjam</th>
                                    <th>Tanggal harus kembali</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                   
                                    <th class="text-center">Dikembalikan</th>
                                    <th class="text-center">Perpanjangan</th>
                                    <th class="text-center">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $i=1 @endphp
                            @foreach($peminjaman as $pinjam)
                                <tr>
                                    <td>{{ $i++}}</td>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{$pinjam->id}}" ></td>
                                    <td>{{ $pinjam->kode_pinjam }}</td>
                                   
                                    <td>{{ $pinjam->judul_buku }}</td>
                                    @if($pinjam->nip == '')
                                 
                                    <td>{{ $pinjam->nama_siswa }}</td>
                                    @else
                                   
                                    <td>{{ $pinjam->nama_lengkap }}</td>
                                    @endif
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
                                    <td>
                                    Terlambat {{ $terlambat }} Hari
                                    </td>
                                    <td>
                                    @if($pinjam->status_id == 1 ) 
                                        <a type="button" id="Btn" class="btn btn-outline-danger btn-sm" href="{{ url('/pengembalian/' . $pinjam->id . '/edit') }}">Dikembalikan</a></td>
                                    @elseif($pinjam->status_id == 3 ) 
                                        <a type="button"  id="Btn" class="btn btn-outline-danger btn-sm" href="{{ url('/pengembalian/' . $pinjam->id . '/edit') }}">Dikembalikan</a></td>
                                    @else
                                        <a type="button" id="Btn" class="btn btn-light btn-ladda btn-ladda-spinner ladda-button btn-sm" >Dikembalikan</a></td>
                                    @endif
                                   
                                    <td>
                                    @if($pinjam->status_id == 3 )
                                        <a type="button" class="btn btn-outline-primary btn-sm" href="{{ url('/perpanjangan/' . $pinjam->id . '/edit') }}" class="text-primary-600">Perpanjangan</a></td>
                                        @elseif($pinjam->status_id == 1)
                                        <a type="button" class="btn btn-outline-primary btn-sm" href="{{ url('/perpanjangan/' . $pinjam->id . '/edit') }}" class="text-primary-600">Perpanjangan</a></td>
                                    @else
                                        <a type="button" id="Btn" class="btn btn-light btn-ladda btn-ladda-spinner ladda-button btn-sm" >Perpanjangan</a></td>
                                    @endif
                                    <td class="list-icons"> 
                                        <a href="{{ url('/peminjaman/' . $pinjam->id . '/show') }}" class="btn btn-success btn-icon btn-sm"><i class="icon-menu7"></i></a>
                                        <a href="/peminjaman/delete/{{$pinjam->id}}" class="btn btn-danger btn-icon btn-sm delete-confirm"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>            
                    </div>
				<!-- /left fixed column -->
                <button style="margin-bottom: 18px; margin-left:760px" class="btn btn-xs btn-danger delete_all" data-url="{{ url('myproductsDeleteAll') }}"><i class="icon-trash mr-2"></i>Delete All Selected</button>
			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

<script>
    document.getElementById("Btn").disabled = true;
</script>

<script src="{{asset('/js')}}/sweetalert2.all.js"></script>
@include('sweetalert::alert')

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
                    title: 'Please select row',
                    icon: 'info',
                })
            }  else {  
                var check =  swal({
                    title: 'Are you sure?',
                    text: 'Delete this selected data. ',
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
                                    swal("Deleted!", "Data has been deleted!", "success");
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
              }); 
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
