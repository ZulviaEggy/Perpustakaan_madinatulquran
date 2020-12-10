<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style type="text/css">
		    table {
    border-spacing: 0;
    width: 100%;
    }
    th {
    background: #404853;
    background: linear-gradient(#687587, #404853);
    border-left: 1px solid rgba(0, 0, 0, 0.2);
    border-right: 1px solid rgba(255, 255, 255, 0.1);
    color: #fff;
    padding: 8px;
    text-align: left;
    text-transform: uppercase;
    }
    th:first-child {
    border-top-left-radius: 4px;
    border-left: 0;
    }
    th:last-child {
    border-top-right-radius: 4px;
    border-right: 0;
    }
    td {
    border-right: 1px solid #c6c9cc;
    border-bottom: 1px solid #c6c9cc;
    padding: 8px;
    }
    td:first-child {
    border-left: 1px solid #c6c9cc;
    }
    tr:first-child td {
    border-top: 0;
    }
    tr:nth-child(even) td {
    background: #e8eae9;
    }
    tr:last-child td:first-child {
    border-bottom-left-radius: 4px;
    }
    tr:last-child td:last-child {
    border-bottom-right-radius: 4px;
    }
   
    .center {
    	text-align: center;
    }
    .badge {
    display: inline-block;
    padding: 0.25em 0.4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    
    border-radius: 0.25rem; }
    .badge-warning {
    color: #212529;
    background-color: #ffaf00; }
    .badge-warning[href]:hover, .preview-list .preview-item .preview-thumbnail [href].badge.badge-busy:hover, .badge-warning[href]:focus, .preview-list .preview-item .preview-thumbnail [href].badge.badge-busy:focus {
      color: #212529;
      text-decoration: none;
      background-color: #cc8c00; }

  .badge-success, .preview-list .preview-item .preview-thumbnail .badge.badge-online {
    color: #fff;
    background-color: #00ce68; }
    .badge-success[href]:hover, .preview-list .preview-item .preview-thumbnail [href].badge.badge-online:hover, .badge-success[href]:focus, .preview-list .preview-item .preview-thumbnail [href].badge.badge-online:focus {
      color: #fff;
      text-decoration: none;
      background-color: #009b4e; }
  .badge-primary {
    color: #fff;
    background-color: #2196F3; }
    a.badge-primary:hover, a.badge-primary:focus {
      color: #fff;
      text-decoration: none; }
      a.badge-primary:hover:not(.badge-light), a.badge-primary:focus:not(.badge-light) {
        box-shadow: 0 0 0 62.5rem rgba(0, 0, 0, 0.075) inset; }
  .badge-secondary {
    color: #fff;
    background-color: #777; }
    a.badge-secondary:hover, a.badge-secondary:focus {
      color: #fff;
      text-decoration: none; }
      a.badge-secondary:hover:not(.badge-light), a.badge-secondary:focus:not(.badge-light) {
        box-shadow: 0 0 0 62.5rem rgba(0, 0, 0, 0.075) inset; }
      
	</style>
  <link rel="stylesheet" href="">
	<title>Laporan Data Transaksi</title>
</head>
<body>
  <header>
    <table align="center" class="table-header" width="100%">
      <tr>
        <th>
          <img src="{{public_path('/global_assets')}}/images/logo_sekolah.png" width="60" height="60" align="center" style="margin-left:32px">
        </th>
        <th>
          <h1 style="margin-left:20px">LAPORAN BUKU YANG SERING DIPINJAM ({{ $date[0] }} - {{ $date[1] }})</h1>
        </th>
      </tr>
	 </table>
	 <hr style="width:100%">
  </header>
  <table id="pseudo-demo">
    <thead>
      <tr>
        <th>
          No
        </th>
        <th>
          Kode Buku
        </th>
        <th>
          Judul
        </th>
        <th>
          Penulis
        </th>
        <th>
         Penerbit
        </th>
        <th>
         Tahun Terbit
        </th>
        <th>
         ISBN
        </th>
        <th>
         Jumlah
        </th>
       
      </tr>
    </thead>
    <tbody>
    @php $i=1 @endphp
    @foreach($datas as $data)
    <tr>
      <td class="py-1">
        {{$i++}}
      </td>
      <td >
        {{$data->kode_buku}}
      </td>
      <td>
        {{$data->judul_buku}}
      </td>
      <td >
        {{$data->penulis}}
      </td>
      <td>
        {{$data->penerbit}}
      </td>
      <td >
        {{$data->tahun_terbit}}
      </td>
      <td>
        {{$data->ISBN}}
      </td>
      <td>
        {{$data->count}}
      </td>
    
    </tr>
    @endforeach
    </tbody>
  </table>
  </body>
</html>