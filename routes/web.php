<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// admin


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'UserController@index')->name('dashboard');
Route::get('/', 'HomeController@index');

// Route::get('/home', 'UserController@index');
// Route::get('/login', 'UserController@login');
// Route::post('/loginPost', 'UserController@loginPost');
// Route::get('/register', 'UserController@register');
// Route::post('/registerPost', 'UserController@registerPost');
Route::get('/logout', 'UserController@logout');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', 'UserController@profileShow')->name('profile_show');
    Route::get('/profile/edit', 'UserController@profile')->name('profile_edit');
    Route::put('/profile/update', 'UserController@updateProfile')->name('profile.update');
    Route::put('/profile/updatePhoto', 'UserController@updateProfilePhoto')->name('profilePhoto.update');
    Route::post('/profile/update_password', 'UserController@updatePasswordAdmin')->name('profile.updatePassword');
});

Route::group(['middleware' => ['auth','CheckRole:1']], function () {
    Route::get('/staff', 'StaffController@index')->name('staff.index');
    Route::get('/tambah_staff', 'StaffController@create')->name('staff.create');
    Route::post('/staff', 'StaffController@store')->name('staff.store');
    Route::get('/staff/{staff_id}', 'StaffController@show')->name('staff.show');
    Route::get('/staff/{staff_id}/edit', 'StaffController@edit')->name('staff.edit');
    Route::put('/staff/{staff_id}', 'StaffController@update')->name('staff.update');
    Route::get('/staff/{staff_id}/editPhoto', 'StaffController@editPhoto')->name('staff.editPhoto');
    Route::put('/staff/{staff_id}/edit', 'StaffController@updatePhoto')->name('staff.updatePhoto');
    Route::put('/ubah_passwordStaffAdmin/{staff_id}', 'StaffController@updatePasswordAdmin')->name('changeStaffAdmin.password');
    Route::get('staff/delete/{id}', 'StaffController@destroy');
    Route::get('/sekolah', 'SekolahController@index')->name('sekolah.index');
    Route::get('/sekolah/{sekolah_id}/edit', 'SekolahController@edit')->name('sekolah.edit');
    Route::put('/sekolah/{sekolah_id}', 'SekolahController@update')->name('sekolah.update');
});
    Route::group(['middleware' => ['auth','CheckRole:1,2']], function () {
        Route::get('/siswa', 'SiswaController@index')->name('siswa.index');
        Route::get('/tambah_siswa', 'SiswaController@create')->name('siswa.create');
        Route::post('/siswa', 'SiswaController@store')->name('siswa.store');
        Route::get('/siswa/{siswa_id}', 'SiswaController@show')->name('siswa.show');
        Route::get('/siswa/{siswa_id}/edit', 'SiswaController@edit')->name('siswa.edit');
        Route::put('/siswa/{siswa_id}', 'SiswaController@update')->name('siswa.update');
        Route::get('/kartu_siswa/{siswa_id}/pdf', 'SiswaController@kartuPdf')->name('siswa.kartuPdf');
        Route::put('/siswa/{siswa_id}/edit', 'SiswaController@updatePhoto')->name('siswa.updatePhoto');
        Route::put('/ubah_passwordSiswaAdmin/{siswa_id}', 'StaffController@updatePasswordAdmin')->name('changeSiswaAdmin.password');
        Route::get('siswa/delete/{id}', 'SiswaController@destroy');
        Route::get('/format_siswa', 'SiswaController@format');
        Route::post('/import_siswa', 'SiswaController@import');

        Route::resource('guru', 'GuruController');
        Route::get('/kartu_guru/{guru_id}/pdf', 'GuruController@kartuPdf')->name('guru.kartuPdf');
        Route::put('/guru/{guru_id}/edit', 'GuruController@updatePhoto')->name('guru.updatePhoto');
        Route::get('guru/delete/{id}', 'GuruController@destroy');
        Route::get('/format_guru', 'GuruController@format');
        Route::post('/import_guru', 'GuruController@import'); 
        
    });

    Route::group(['middleware' => ['auth','CheckRole:1,3']], function () {
        Route::get('/peminjaman', 'PeminjamanController@index')->name('peminjaman.index');
        Route::get('/tambah_peminjaman', 'PeminjamanController@create')->name('peminjaman.create');
        Route::post('/peminjaman', 'PeminjamanController@store')->name('peminjaman.store');
        Route::get('/peminjaman/{peminjaman_id}/show', 'PeminjamanController@show')->name('peminjaman.show');
        Route::put('/peminjaman/{peminjaman_id}', 'PeminjamanController@update')->name('peminjaman.update');
        Route::get('/perpanjangan/{perpanjangan_id}/edit', 'PeminjamanController@perpanjangan')->name('perpanjangan.edit');
        Route::put('/perpanjangan/{perpanjangan_id}', 'PeminjamanController@updatePerpanjangan')->name('perpanjangan.update');
        Route::get('/tambah_pengembalian{pengembalian_id}/edit', 'PeminjamanController@tambah_Pengembalian')->name('tambah.pengembalian.edit');
        Route::get('peminjaman/delete/{peminjaman_id}', 'PeminjamanController@destroy')->name('peminjaman.destroy');
        Route::delete('myproductsDeleteAll', 'PeminjamanController@deleteAll');

        Route::put('/pengembalian/{pengembalian_id}', 'PeminjamanController@updatePengembalian')->name('pengembalian.update');
        Route::get('/pengembalian/{pengembalian_id}/edit', 'PeminjamanController@tambahPengembalian')->name('pengembalian.edit');

        Route::get('/laporan/trs', 'LaporanController@transaksi')->name('report.transaksi1');
        Route::get('/laporan/transaksi', 'LaporanController@transaksiPerpus')->name('report.transaksi');
        Route::get('/laporan/trs_peminjaman', 'LaporanController@transaksiPeminjaman')->name('report.peminjaman');
        Route::get('/laporan/trs_pengembalian', 'LaporanController@transaksiPengembalian')->name('report.pengembalian');
        Route::get('/laporan/trs_perpanjangan', 'LaporanController@transaksiPerpanjangan')->name('report.perpanjangan');
        Route::get('/laporan/trs/pdf', 'LaporanController@transaksiPdf')->name('report.transaksiPdf');
        Route::get('/laporan/trs/pdfTerlambat', 'LaporanController@transaksiPdfTerlambat')->name('report.transaksiPdfTerlambat');
        Route::get('/laporan/trs/pdf/{status_id}', 'LaporanController@transaksiPdfFilter');
        Route::get('/laporan/trs/pdf_peminjaman', 'LaporanController@transaksiPdfPeminjaman');
        Route::get('/laporan/trs/pdf_pengembalian', 'LaporanController@transaksiPdfPengembalian');
        Route::get('/laporan/trs/pdf_perpanjangan', 'LaporanController@transaksiPdfPerpanjangan');
        Route::get('/laporan/trs/excel', 'LaporanController@export2')->name('report.Excel');
        Route::get('/laporan/trs/excelKeterlambatan', 'LaporanController@exportKeterlambatan')->name('report.ExcelKeterlambatan');
        Route::get('/laporan/trs/excel/{daterange}', 'LaporanController@exportFilter')->name('report.ExcelFilter');
        Route::get('/laporan/trs/excel_peminjaman', 'LaporanController@exportPeminjaman')->name('report.peminjamanExcel');
        Route::get('/laporan/trs/excel_peminjaman/{daterange}', 'LaporanController@exportFilterPeminjaman')->name('report.peminjamanExcelFilter');
        Route::get('/laporan/trs/excel_perpanjangan', 'LaporanController@exportPerpanjangan')->name('report.perpanjanganExcel');
        Route::get('/laporan/trs/excel_perpanjangan/{daterange}', 'LaporanController@exportFilterPerpanjangan')->name('report.perpanjanganExcelFilter');
        Route::get('/laporan/trs/excel_pengembalian', 'LaporanController@exportPengembalian')->name('report.pengembalianExcel');
        Route::get('/laporan/trs/excel_pengembalian/{daterange}', 'LaporanController@exportFilterPengembalian')->name('report.pengembalianExcelFilter');

        Route::get('/laporan/barcode', 'BarcodeController@index');
        Route::get('/prnpriviewBook','LaporanController@prnpriviewBook');
        Route::get('/prnpriviewTransaksi','LaporanController@prnpriviewTransaksi');
        Route::get('/order', 'LaporanController@exportTanggal')->name('report.order');
        Route::get('/order/pdf/{daterange}', 'LaporanController@orderReportPdf')->name('report.order_pdf');
        Route::get('/transaksi/pdf/{daterange}', 'LaporanController@transaksiReportPdf')->name('transaksi.laporan_pdf');
        Route::get('/transaksi/perpanjangan/pdf/{daterange}', 'LaporanController@transaksiPerpanjanganReportPdf');
        Route::get('/transaksi/pengembalian/pdf/{daterange}', 'LaporanController@transaksiPengembalianReportPdf');

    });
    
    Route::group(['middleware' => ['auth','CheckRole:1,4']], function () {
        Route::resource('buku', 'BukuController');
        Route::get('buku/delete/{id}', 'BukuController@destroy');
        Route::put('buku/{barcode_id}/edit_barcode', 'BukuController@updateBarcode')->name('buku.updateBarcode');
        Route::get('buku/{barcode_id}/barcode_show', 'BukuController@showBarcode')->name('barcode.show');
        Route::get('/noted/{buku_id}/editPhoto', 'BukuController@editPhoto')->name('buku.editPhoto');
        Route::put('/buku/{buku_id}/edit', 'BukuController@updatePhoto')->name('buku.updatePhoto');
        Route::get('/format_buku', 'BukuController@format');
        Route::post('/import_buku', 'BukuController@import');
        Route::delete('mybookDeleteAll', 'BukuController@deleteAll');
        Route::put('/usulan_buku/{usulan_id}', 'GuruController@updateUsulan')->name('usulan.user');

        Route::get('/kategori', 'KategoriController@index')->name('kategori.index');
        Route::get('/tambah_kategori', 'KategoriController@create')->name('kategori.create');
        Route::post('/kategori', 'KategoriController@store')->name('kategori.store');
        Route::get('/kategori/{kategori_id}/edit', 'KategoriController@edit')->name('kategori.edit');
        Route::put('/kategori/{kategori_id}', 'KategoriController@update')->name('kategori.update');
        Route::get('kategori/delete/{kategori_id}', 'KategoriController@destroy')->name('kategori.destroy');
        
        Route::get('/buku/pdf', 'LaporanController@exportTanggal')->name('buku.laporanPdf');
        Route::get('/buku/pdf/{daterange}', 'LaporanController@bukuReportPdf')->name('buku.laporan_pdf');
        Route::get('/buku/excel/{daterange}', 'LaporanController@exportFilterBuku')->name('report.BukuExcelFilter');
        Route::get('/prnpriview/{barcode_id}','BarcodeController@prnpriview');
        Route::get('/laporan/buku', 'LaporanController@buku');
        Route::get('/laporan/buku/pdf', 'LaporanController@bukuPdf');
        Route::get('/laporan/buku/pdfKosong', 'LaporanController@bukuKosong');
        Route::get('/laporan/buku/pdfPinjam', 'LaporanController@bukuDipinjam')->name('buku.laporanPdfPinjam');
        Route::get('/laporan/buku/pdfPinjam/{daterange}', 'LaporanController@bukuPinjamTanggal')->name('buku.laporanPdfPinjamTanggal');
        Route::get('/laporan/{barcode_id}/pdf', 'LaporanController@barcodePdf');
        Route::get('/laporan/buku/excel', 'LaporanController@export')->name('report.bukuExcel');
        Route::get('/laporan/buku/bukuKosong', 'LaporanController@exportKosong')->name('report.bukuExcelKosong');
        Route::get('/laporan/buku/excelDipinjam', 'LaporanController@exportDipinjam')->name('report.bukuExcelDipinjam');
        Route::get('/laporan/buku/excelDipinjam/{daterange}', 'LaporanController@exportFilterBukuDipinjam')->name('report.bukuExcelSeringDipinjam');
        Route::get('/laporan/buku/excel/{daterange}', 'LaporanController@exportFilterBuku')->name('report.bukuExcelFilter');
        Route::post('/laporan/buku', 'LaporanController@store')->name('laporan.store');
    });
    Route::group(['middleware' => ['auth','CheckRole:1,2,3,4']], function () {
        Route::resource('noted', 'NotedController');
        Route::get('noted/delete/{id}', 'NotedController@destroy');
    });


//User

Route::group(['middleware' => ['auth','CheckRole:5,6']], function () {
  
    Route::get('/koleksi', 'BukuController@bukuUser')->name('koleksi.buku');
    Route::get('/buku_list/{buku_id}', 'BukuController@showBook')->name('bukuSiswa.show');

    Route::get('/detail_peminjaman/{peminjaman_id}/show', 'PeminjamanController@showBook')->name('peminjaman.showBook');
    Route::get('/transaksi', 'PeminjamanController@transaksiUser')->name('transaksi.index');
    Route::get('/detail_transaksi/{transaksi_id}/show', 'PeminjamanController@DetailtransaksiUser')->name('Detailtransaksi.show');

    Route::get('/profile_guru', 'GuruController@profileShow')->name('profileGuru.show');
    Route::get('/profile/{guru_id}/edit_guru', 'GuruController@profileEdit')->name('profileGuru.edit');
    Route::put('/profile/{update_guru}', 'GuruController@updateProfileGuru')->name('guruProfile.update');
    Route::put('/profilePhoto_guru/{update_guru}', 'GuruController@updatePhotoGuru')->name('photoGuru.update');
    Route::get('/password/edit', 'GuruController@ubahPassword')->name('password.edit');
    Route::post('/ubah_password', 'GuruController@updatePassword')->name('change.password');
    Route::get('/usulan', 'GuruController@Usulan')->name('usulan.guru');
    Route::get('/kirim_usulan', 'GuruController@createUsulan')->name('kirimusulan.guru');
    Route::post('/usulan/guru', 'GuruController@storeUsulan')->name('usulan.store');

    Route::get('/profile_siswa', 'SiswaController@profileShowSiswa')->name('profileSiswa.show');
    Route::get('/profile/{siswa_id}/edit_siswa', 'SiswaController@profileEditSiswa')->name('profileSiswa.edit');
    Route::put('/profile_siswa/{update_siswa}', 'SiswaController@updateProfileSiswa')->name('siswaProfile.update');
    Route::get('/profilePhoto/{siswa_id}/editPhoto_siswa', 'SiswaController@editPhotoSiswa')->name('photoSiswa.edit');
    Route::put('/profilePhoto_siswa/{update_siswa}', 'SiswaController@updatePhotoSiswa')->name('photoSiswa.update');
    Route::get('/password/edit_siswa', 'SiswaController@ubahPassword')->name('passwordSiswa.edit');
    Route::post('/ubah_passwordSiswa', 'SiswaController@updatePassword')->name('changeSiswa.password');
    Route::get('/usulan_siswa', 'SiswaController@Usulan')->name('usulan.siswa');
    Route::get('/kirim_usulanSiswa', 'SiswaController@createUsulan')->name('kirimusulan.siswa');
    Route::post('/usulan/siswa', 'SiswaController@storeUsulan')->name('usulanSiswa.store');

  
    // Route::get('/pagination/fetch_data', 'HomeController@fetch_data')->name('pagination.fecth_data');
});
