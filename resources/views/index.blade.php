
	<!-- Core JS files -->
	<script src="{{asset('/global_assets')}}/js/main/jquery.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/main/bootstrap.bundle.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/loaders/blockui.min.js"></script>
	<link rel="shortcut icon" href="{{asset('logo_sekolah.ico')}}" />
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('/global_assets')}}/js/plugins/visualization/d3/d3.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/ui/moment/moment.min.js"></script>
	<script src="{{asset('/global_assets')}}/js/plugins/visualization/echarts/echarts.min.js"></script>

	<script src="{{asset('/assets')}}/js/app.js"></script>
    <script src="{{asset('/global_assets')}}/js/demo_pages/dashboard.js"></script>
	<script type="text/javascript" src="{{asset('/js')}}/Chart.js"></script>
	<script src="{{asset('/global_assets')}}/js/demo_pages/charts/echarts/areas.js"></script>
	<script src="{{asset('/global_assets')}}/js/demo_pages/layout_fixed_sidebar_custom.js"></script>


@extends('dashboard.base')


<!-- Main navbar -->
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
			@section('content')
            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    </div>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>
        </div>
        <!-- /page header -->

		<!-- Content area -->
		<div class="content">

			<!-- Main charts -->
			<div class="row">
				<div class="col-lg-3">
				
					<!--Anggota -->
					<div class="card bg-teal-400">
						<div class="card-body" style="height:130px">
							<div class="d-flex">
								<h3 class="font-weight-semibold mb-0">{{$siswa->count() + $guru->count()}}</h3>
								<div class="list-icons ml-auto">
									<a href="#" class="list-icons-item badge bg-hijau-400 rounded-circle badge-icon "><i class="icon-user font-size-sm opacity-75" style="font-size:28px" ></i></a>
								</div>
					        </div>
					        <div>
							Data Anggota
							</div>
						</div>
						<div class="container">
							<div ></div>
						</div>
					</div>
					<!-- /anggota -->
				</div>
				<div class="col-lg-3">
					<!-- Total Buku -->
					<div class="card bg-blue-400">
						<div class="card-body" style="height:130px">
							<div class="d-flex">
								<h3 class="font-weight-semibold mb-0">{{$buku->count()}}</h3>
									<div class="list-icons ml-auto">
										<a href="#" class="list-icons-item badge bg-biru-400 rounded-circle badge-icon "><i class="icon-book3 font-size-sm opacity-75" style="font-size:28px" ></i></a>
						            </div>
					        </div>
					        <div>
								Data Buku
							</div>
						</div>
						<div ></div>
					</div>
					<!-- /total buku -->
				</div>
				<div class="col-lg-3">
					<!-- Total peminjaman buku -->
					<div class="card bg-danger-400">
						<div class="card-body" style="height:130px">
							<div class="d-flex">
								<h3 class="font-weight-semibold mb-0">{{ $datas->where('status_id','=', 3)->count()}}</h3>
								<div class="list-icons ml-auto">
						            <div class="list-icons-item dropdown">
						                <a href="#" class="list-icons-item badge bg-bulat-400 rounded-circle badge-icon "><i class="icon-sync font-size-sm opacity-75" style="font-size:28px" ></i></a>
						            </div>
					            </div>
					        </div>
					        <div>
							Peminjaman Buku
							</div>
						</div>
						<div ></div>
					</div>
					<!-- /peminjaman buku -->
				</div>
				<div class="col-lg-3">

					<!-- pengembalian -->
					<div class="card bg-red-400">
						<div class="card-body" style="height:130px">
							<div class="d-flex">
								<h3 class="font-weight-semibold mb-0">{{ $datas2->where('status_id','=', 2)->count()}}</h3>
								<div class="list-icons ml-auto">
									<a href="#" class="list-icons-item badge bg-oranye-400 rounded-circle badge-icon "><i class="icon-download7 font-size-sm opacity-75" style="font-size:28px" ></i></a>
								</div>
							</div>
					    <div>
						Pengembalian Buku
						</div>
					</div>
					<div class="container-fluid">
						<div ></div>
					</div>
				</div>
				<!-- /pengembalian -->
			</div>
			<div class="col-xl-8">

				<!-- Basic columns -->
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Jumlah Transaksi Peminjaman dan Pengembalian</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                	</div>
	                	</div>
					</div>

					<div class="card-body">
						<div class="chart">
						<div style="width: 600px; height: 373px; margin-top:25px">
							<canvas id="myChart"></canvas>
						</div>
						</div>
					</div>
				</div>
				<!-- /basic columns -->
			</div>

				<div class="col-xl-4">
					<!-- Latest posts -->
					<div class="card">
						<div class="card-header header-elements-inline">
							<h6 class="card-title">Daftar Buku Terbaru</h6>
		                </div>
						<div class="card-body">
							<div class="row">
							@foreach($terbaru as $new)
								<div class="media flex-column flex-sm-row mt-0 mb-3">
				        			<div class="mr-sm-3 mb-2 mb-sm-0">
										<div class="card-img-actions">
											<a href="#">
												<img class="img-fluid" width="78px" src="{{ url('/uploads/'.$new->cover) }}">													</a>
										</div>
									</div>
											
				        			<div class="media-body">
										<h6 class="media-title"><a href="{{ url('/buku/' . $new->id) }}">{{$new->judul_buku}}</a></h6>
											Penulis : {{$new->penulis}}  <br>
											Penerbit : {{$new->penerbit}}  <br>
											jumlah : {{$new->jumlah}}
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
						
				<!-- /latest posts -->
			</div>
		</div>
		<!-- /main charts -->
				
		<!-- Basic pie -->
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title " style="text-align: center">Data Kategori Buku</h5>
				<div class="header-elements">
					<div class="list-icons">
				        <a class="list-icons-item" data-action="collapse"></a>
				    </div>
			    </div>
			</div>
			<div id="canvas-holder" style="width:70%; height: 400px; margin-top:17px; margin-left:80px">
				<canvas id="chart-area"></canvas>
			</div>
		</div>
		<!-- /basic pie -->	

		<!-- Show values -->
		<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Data Usulan Buku</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                	</div>
	                	</div>
					</div>

					<div class="card-body">
						<div class="chart-container">
							<div class="chart has-fixed-height" id="area_basic"></div>
						</div>
					</div>
				</div>
				<!-- /show values -->

		<script>
											
			var ctx = document.getElementById("myChart").getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'bar',

					// Setup grid
					grid: {
					left: 0,
					right: 40,
					top: 35,
					bottom: 0,
					containLabel: true
					},
					// Add legend
					legend: {
						label: ['Peminjaman', 'Pengembalian'],
						itemHeight: 8,
						itemGap: 20,
						textStyle: {
							padding: [0, 5]
							}
						},
									
						data: {
							labels: <?php echo json_encode($label); ?>,
								datasets: [{
									label: 'Peminjaman',
									backgroundColor: '#F44336',
									borderColor: 'rgba(0,0,0,0.01)',
									data: {!!json_encode($jumlah_produk)!!},
									borderWidth: 1
									},
									{
									label: 'Perpanjangan',
									backgroundColor: '#2ec7c9',
									borderColor: 'rgba(0,0,0,0.01)',
									data: {!!json_encode($jumlah_produk4)!!},
									borderWidth: 1
										
									},
									{
									label: 'Pengembalian',
									backgroundColor: '#FF9800',
									borderColor: 'rgba(0,0,0,0.01)',
									data: {!!json_encode($jumlah_produk2)!!},
									borderWidth: 1
									}
								
								]
								},
								
								options: {
									scales: {
										yAxes: [{
											ticks: {
												beginAtZero:true
											}
										}]
									}
								}
								
							});
	
					</script>
					<script>
					  var area_basic_element = document.getElementById('area_basic');
					 // Basic area chart
					 if (area_basic_element) {

						// Initialize chart
						var area_basic = echarts.init(area_basic_element);


						//
						// Chart config
						//

						// Options
						area_basic.setOption({

							// Define colors
							color: ['#b6a2de','#2ec7c9','#c25c97','#ffb980','#d87a80'],

							// Global text styles
							textStyle: {
								fontFamily: 'Roboto, Arial, Verdana, sans-serif',
								fontSize: 13
							},

							// Chart animation duration
							animationDuration: 750,

							// Setup grid
							grid: {
								left: 0,
								right: 40,
								top: 35,
								bottom: 0,
								containLabel: true
							},

							// Add legend
							legend: {
								data: [ 'Disetujui', 'Ditolak','Diproses'],
								itemHeight: 8,
								itemGap: 20
							},

							// Add tooltip
							tooltip: {
								trigger: 'axis',
								backgroundColor: 'rgba(0,0,0,0.75)',
								padding: [10, 15],
								textStyle: {
									fontSize: 13,
									fontFamily: 'Roboto, sans-serif'
								}
							},

							// Horizontal axis
							xAxis: [{
								type: 'category',
								boundaryGap: false,
								data: <?php echo json_encode($label); ?>,
								axisLabel: {
									color: '#333'
								},
								axisLine: {
									lineStyle: {
										color: '#999'
									}
								},
								splitLine: {
									show: true,
									lineStyle: {
										color: '#eee',
										type: 'dashed'
									}
								}
							}],

							// Vertical axis
							yAxis: [{
								type: 'value',
								axisLabel: {
									color: '#333'
								},
								axisLine: {
									lineStyle: {
										color: '#999'
									}
								},
								splitLine: {
									lineStyle: {
										color: '#eee'
									}
								},
								splitArea: {
									show: true,
									areaStyle: {
										color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
									}
								}
							}],

							// Add series
							series: [
								{
									name: 'Disetujui',
									type: 'line',
									data: {!!json_encode($jumlah_usul3)!!},
									areaStyle: {
										normal: {
											opacity: 0.25
										}
									},
									smooth: true,
									symbolSize: 7,
									itemStyle: {
										normal: {
											borderWidth: 2
										}
									}
								},
								{
									name: 'Ditolak',
									type: 'line',
									smooth: true,
									symbolSize: 7,
									itemStyle: {
										normal: {
											borderWidth: 2
										}
									},
									areaStyle: {
										normal: {
											opacity: 0.25
										}
									},
									data: {!!json_encode($jumlah_usul2)!!},
								},
								{
									name: 'Diproses',
									type: 'line',
									smooth: true,
									symbolSize: 7,
									itemStyle: {
										normal: {
											borderWidth: 2
										}
									},
									areaStyle: {
										normal: {
											opacity: 0.25
										}
									},
									data: {!!json_encode($jumlah_usul)!!},
								}
							]
						});
						}


						</script>
					<script>
					
					var config = {
						type: 'pie',
								
						data: {
							datasets: [{
								data:{!!json_encode($jumlah_produk3)!!},
								backgroundColor: [
									'#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80',
									'#8d98b3','#e5cf0d','#97b552','#95706d','#dc69aa',
									'#07a2a4','#9a7fd1','#588dd5','#f5994e','#c05050',
									'#59678c','#c9ab00','#7eb00a','#6f5553','#c14089'
								],
							}],
					
						labels: {!!json_encode($produk)!!}							
								
						},
						options: {
							responsive: true,
							
							title:{
								display: true,
								position:"top",

							},
							legend:{
								display : true,
								position:"left"
							},
							tooltip: {
								trigger: 'item',
								backgroundColor: 'rgba(0,0,0,0.75)',
								padding: [10, 15],
								textStyle: {
									fontSize: 13,
									fontFamily: 'Roboto, sans-serif'
								},
								formatter: "{a} <br/>{b}: {c} ({d}%)"
							},
							
						}
					};
			
					window.onload = function() {
						var ctx = document.getElementById('chart-area').getContext('2d');
						window.myPie = new Chart(ctx, config);
					};
			
					document.getElementById('randomizeData').addEventListener('click', function() {
						config.data.datasets.forEach(function(dataset) {
							dataset.data = dataset.data.map(function() {
								return randomScalingFactor();
							});
						});
			
						window.myPie.update();
					});
			
					var colorNames = Object.keys(window.chartColors);
					document.getElementById('addDataset').addEventListener('click', function() {
						var newDataset = {
							backgroundColor: [],
							data: [],
							label: 'New dataset ' + config.data.datasets.length,
						};
			
						for (var index = 0; index < config.data.labels.length; ++index) {
							newDataset.data.push(randomScalingFactor());
			
							var colorName = colorNames[index % colorNames.length];
							var newColor = window.chartColors[colorName];
							newDataset.backgroundColor.push(newColor);
						}
			
						config.data.datasets.push(newDataset);
						window.myPie.update();
					});
			
					document.getElementById('removeDataset').addEventListener('click', function() {
						config.data.datasets.splice(0, 1);
						window.myPie.update();
					});
				</script>
			

			</div>
			<!-- /content area -->

			</div>
		<!-- /main content -->

	</div>
	
@endsection

