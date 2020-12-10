<style type="text/css">
		@page { size: 21.0cm 29.7cm;  margin: 0px 0px 0px 0px; padding: 0px 0px 0px 0px;  margin-top:0;}
		@media print { body {size: 21.0cm 29.7cm;  margin: 0px 0px 0px 0px; padding: 0px 0px 0px 0px;} }
		body { font-size: 50% }
		tr {padding: 5px}
		div .header {padding: 0px;}
</style>

<style type="text/css">
/*	th, td, tr {
		border: 1px solid black;
	}*/
	.tengah td {padding-left: 10px; margin-right: 0px; padding-right: 0px; font-weight: normal;}
	.ttd td {font-weight: bold;}
	.tengah {width: 70%; margin-left: 60px}
	.tbatas {width: 100%}
	.body {padding: 0px; margin: 0px}
	.card { width: 350px; height: 230px }
</style>
<body>
	<table align="center" style="margin-top: 20px;">
		<tr style=" height: 50px">
			<th width="48%">
			<input type="hidden" name="" value="" id="nimp">	
			<!-- kartu member tampak dari depan -->
			<div class="card" style="border-radius: 10px; border: 2px solid grey;">
				<div class="header" align="center" style=" padding: 0px; margin:0;border-bottom: 1px solid grey; background-color: #37c265;">
					<table align="center" class="tbatas">
						<th style="padding: 5px;" class="logos">
							<img src="{{public_path('/global_assets')}}/images/logo_sekolah.png" class="img-circle" alt="logo" width="35" height="35" style=" z-index: 1; margin: 20px 0px 0px 25px"></th> 
						</th>
						<th style="font-size: 100%">
							<h1 style="margin-right: 45px">Kartu Anggota Perpustakaan<br><small >Pondok Pesantren Madinatul Quran</small></h1>
						</th>                        
					</table>
				</div>
				<div class="body responsive" style="padding:10px;">
                    <table width ="100%" style="font-size: 100%" class="text-left">
                      	<tr >
							<th rowspan="5" width="20%" style="padding:0px;" >
							@if($guru->photo != NULL)
								<img width="60" height="60" id="viewfoto" src="{{public_path('/photo/guru/'.$guru->photo)}}" class="img-thumbnail fview" alt="Foto Anggota">
								@elseif($guru->photo == NULL)
								<img width="60" height="60" id="viewfoto" src="{{public_path('/global_assets')}}/images/placeholders/people.png" class="img-thumbnail fview" alt="Foto Anggota">
								@endif
							</th>
							<td style="padding-left:12px"><b>Nama<b></td>
							<th width="2%">:</th>
							<td>{{ $guru->nama_lengkap }}</td>
                    	</tr>  
						<tr>
							<td style="padding-left:12px"><b>NIP<b></td>
							<th width="2%">:</th>
							<td>{{ $guru->NIP }}</td>
                    	</tr> 
						<tr>
							<td style="padding-left:12px"><b>TTL<b></td>
							<th width="2%">:</th>
							<td>{{ $guru->tempat_lahir }}, {{  date('d F Y', strtotime($guru->tanggal_lahir)) }}</td>
						</tr>
						<tr>
							<td style="padding-left:12px"><b>Alamat<b></td>
							<th width="2%">:</th>
							<td>{{ $guru->alamat }}</td>
						</tr>
						<tr>
							<td style="padding-left:12px"><b>No Telp<b></td>
							<th width="2%">:</th>
							<td>{{ $guru->no_telp}}</td>
						</tr>
                	</table>
					<img style="padding-top:12px;padding-left:50px;font-size: 100%" src="data:image/png;base64,{{DNS1D::getBarcodePNG("$guru->NIP", 'C128',1,38,array(1,1,1), true)}}" alt="barcode" />
            	</div>
			</div>
			</th>
			<div style="padding: 3px"></div>
				<th align="right" class="pull-right">
				<!-- kartu member tampak dari belakang -->
				<div class="card" style="border-radius: 10px; padding: 0px; border: 2px solid grey;background-color: #37c265;">
					<div class="body" style=" padding: 0px; margin: 5px;">
						<h3 style="margin-right: 260px"><u>Catatan</u></h3>
						<br>
						<div style="font-size: 100%; margin-top: -15px; left: 150px; text-align: justify; padding-right: 5px" >
							<ol>
								<li>Kartu Anggota ini harus dibawa setiap kunjungan, pinjaman, pengembalian keperpustakaan.</li>
								<li>Tanpa kartu anggota, kunjungan, pinjaman, pengembalian tidak dilayani.</li>
								<li>Pengembalian lewat dari batas waktunya akan dikenakan denda.</li>
								<li>Waktu pinjaman lamanya 7 hari dan dapat diperpanjang 7 hari lagi.</li>
							</ol>
						</div>
						<br>
						<table style="padding: 0px; margin-top:-20px; width: 100%" >
							<th class="pull-right">
								
							</th>
						</table>
					</div>
				</div>
			</div>
		</tr>
	</table>
</body>
