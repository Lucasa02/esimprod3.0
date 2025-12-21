<?php

use App\Http\Controllers\Admin\GuideBookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\User\OptionsController;
use App\Http\Controllers\User\InventarisUserController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PerawatanController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\PeruntukanController;
use App\Http\Controllers\Admin\JenisBarangController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\Studio2Controller;
use App\Http\Controllers\Admin\PerawatanInventarisController;
use App\Http\Controllers\Admin\BmnController;

use App\Http\Controllers\Admin\RencanaPenghapusanController;
use App\Http\Controllers\Admin\DataPenghapusanController;
use App\Http\Controllers\User\PeminjamanController as UserPeminjamanController;
use App\Http\Controllers\User\PeminjamanController as PeminjamanUser;
use App\Http\Controllers\User\PengembalianController as PengembalianUser;


use App\Http\Controllers\User\LaporanKerusakanController;
use App\Http\Controllers\Admin\LaporanKerusakanAdminController;

Route::prefix('/')->group(function () {
	Route::get('/', [AuthController::class, 'index'])->name('login');
	Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');

	Route::middleware(['auth', 'role:superadmin,admin'])->group(function () {
		Route::get('/password', [AuthController::class, 'password'])->name('password');
		Route::post('/password', [AuthController::class, 'passwordValidation'])->name('password.validation');
		Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
		Route::post('/forgot-password', [AuthController::class, 'forgotPasswordProcess'])->name('password.email');
		Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
		Route::post('/reset-password', [AuthController::class, 'resetPasswordProcess'])->name('password.update');
	});
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// cek apakah semua user sudah login atau tidak
Route::middleware(['auth'])->group(function () {

	// pastikan admin atau superadmin sudah melakukan verifikasi dengan masukkan password
	Route::middleware('verified.password')->group(function () {

		Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('role:superadmin,admin');
		// Route::get('/dashboard_settings', [DashboardController::class, 'settings'])->name('dashboard.settings')->middleware('role:superadmin,admin');

		Route::prefix('barang')->group(function () {
			Route::middleware(['role:superadmin,admin'])->group(function () {
				Route::get('/', [BarangController::class, 'index'])->name('barang.index');
				Route::get('/tambah', [BarangController::class, 'create'])->name('barang.create');
				Route::post('/store', [BarangController::class, 'store'])->name('barang.store');
				Route::get('/detail/{uuid}', [BarangController::class, 'show'])->name('barang.show');
				Route::get('/print-barang', [BarangController::class, 'printBarang'])->name('barang.print-barang');
				Route::get('/print-qrcode', [BarangController::class, 'printQrCode'])->name('barang.print-qrcode');
				Route::get('/result', [BarangController::class, 'search'])->name('barang.search');
				Route::get('jenis-barang/{jenisBarang:uuid}', [BarangController::class, 'jenisBarang'])->name('barang.jenis-barang');
				Route::get('/export', [BarangController::class, 'export'])->name('barang.export');
				Route::post('import', [BarangController::class, 'import'])->name('barang.import');
			});

			Route::middleware('role:superadmin')->group(function () {
				Route::get('/edit/{uuid}', [BarangController::class, 'edit'])->name('barang.edit');
				Route::put('/update/{uuid}', [BarangController::class, 'update'])->name('barang.update');
				Route::delete('/destroy/{uuid}', [BarangController::class, 'destroy'])->name('barang.destroy');
			});
		});

		Route::middleware('role:superadmin,admin')->group(function () {

			Route::prefix('buku-panduan')->group(function () {
				Route::get('/', [GuideBookController::class, 'index'])->name('buku-panduan.index');
				Route::post('store', [GuideBookController::class, 'store'])->name('buku-panduan.store');
				Route::patch('used/{uuid}', [GuideBookController::class, 'used'])->name('buku-panduan.used');
				Route::delete('buku-panduan/{uuid}/delete', [GuideBookController::class, 'destroy'])->name('buku-panduan.destroy');
				Route::patch('unused/{uuid}', [GuideBookController::class, 'unused'])->name('buku-panduan.unused');
				Route::get('download', [GuideBookController::class, 'download'])->name('buku-panduan.download');
			});

			Route::prefix('jenis-barang')->group(function () {
				Route::get('/', [JenisBarangController::class, 'index'])->name('jenis-barang.index');
				Route::post('/store', [JenisBarangController::class, 'store'])->name('jenis-barang.store');
				Route::get('/edit/{uuid}', [JenisBarangController::class, 'edit'])->name('jenis-barang.edit');
				Route::put('/update/{uuid}', [JenisBarangController::class, 'update'])->name('jenis-barang.update');
				Route::delete('/destroy/{uuid}', [JenisBarangController::class, 'destroy'])->name('jenis-barang.destroy');
				Route::get('/result', [JenisBarangController::class, 'search'])->name('jenis-barang.search');
			});

			Route::prefix('peruntukan')->group(function () {
				Route::get('/', [PeruntukanController::class, 'index'])->name('peruntukan.index');
				Route::post('/store', [PeruntukanController::class, 'store'])->name('peruntukan.store');
				Route::get('/edit/{uuid}', [PeruntukanController::class, 'edit'])->name('peruntukan.edit');
				Route::put('/update/{uuid}', [PeruntukanController::class, 'update'])->name('peruntukan.update');
				Route::delete('/destroy/{uuid}', [PeruntukanController::class, 'destroy'])->name('peruntukan.destroy');
				Route::get('/result', [PeruntukanController::class, 'search'])->name('peruntukan.search');
			});

			Route::prefix('jabatan')->group(function () {
				Route::get('/', [JabatanController::class, 'index'])->name('jabatan.index');
				Route::post('/store', [JabatanController::class, 'store'])->name('jabatan.store');
				Route::get('/edit/{uuid}', [JabatanController::class, 'edit'])->name('jabatan.edit');
				Route::put('/update/{uuid}', [JabatanController::class, 'update'])->name('jabatan.update');
				Route::delete('/destroy/{uuid}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');
				Route::get('/result', [JabatanController::class, 'search'])->name('jabatan.search');
			});
		});

		Route::prefix('profil')->group(function () {
			Route::get('/', [ProfileController::class, 'index'])->name('profil.index');
			Route::patch('/ubah-profil', [ProfileController::class, 'updateProfil'])->name('profil.update-profil');
			Route::patch('/ubah-password', [ProfileController::class, 'updatePassword'])->name('profil.update-password');
		});

		Route::prefix('studio2')->name('studio2.')->group(function () {
			Route::get('/', [Studio2Controller::class, 'index'])->name('index');
			Route::get('/create', [Studio2Controller::class, 'create'])->name('create');
			Route::post('/store', [Studio2Controller::class, 'store'])->name('store');
			Route::get('/{id}/edit', [Studio2Controller::class, 'edit'])->name('edit');
			Route::put('/{id}/update', [Studio2Controller::class, 'update'])->name('update');
			Route::delete('/{id}/delete', [Studio2Controller::class, 'destroy'])->name('destroy');
			Route::get('/{id}/detail', [Studio2Controller::class, 'show'])->name('detail');
			Route::get('/print', [Studio2Controller::class, 'print'])->name('print');
		});
	}); // End of Route::middleware('role:superadmin,admin')->group(function () 

	Route::prefix('admin')->middleware(['auth', 'role:superadmin,admin'])->group(function () {
		Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
		Route::post('/slider', [SliderController::class, 'store'])->name('slider.store');
		Route::delete('/slider/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
	});

	// USERS MANAGEMENT
	Route::prefix('users')->middleware('role:superadmin,admin')->group(function () {
		Route::get('/', [UserController::class, 'index'])->name('users.index');
		Route::get('/tambah', [UserController::class, 'create'])->name('users.create');
		Route::post('/store', [UserController::class, 'store'])->name('users.store');
		Route::get('/detail/{uuid}', [UserController::class, 'show'])->name('users.show');
		Route::get('/roles', [UserController::class, 'filterByRole'])->name('users.role');
		Route::get('/jabatan', [UserController::class, 'filterByJabatan'])->name('users.jabatan');
		Route::get('/result', [UserController::class, 'search'])->name('users.search');
		Route::get('/id-card/{uuid}', [UserController::class, 'printIDCard'])->name('users.id.card');
		Route::get('/log/{uuid}', [UserController::class, 'log'])->name('users.log');
	});
	// Users Management (Superadmin Only - CRUD)
	Route::prefix('users')->middleware('role:superadmin')->group(function () {
		Route::get('/edit/{uuid}', [UserController::class, 'edit'])->name('users.edit');
		Route::put('/update/{uuid}', [UserController::class, 'update'])->name('users.update');
		Route::delete('/destroy/{uuid}', [UserController::class, 'destroy'])->name('users.destroy');
	});

	Route::prefix('users')->group(function () {
		Route::middleware('role:superadmin,admin')->group(function () {
			Route::get('/', [UserController::class, 'index'])->name('users.index');
			Route::get('/tambah', [UserController::class, 'create'])->name('users.create');
			Route::post('/store', [UserController::class, 'store'])->name('users.store');
			Route::get('/detail/{uuid}', [UserController::class, 'show'])->name('users.show');
			Route::get('/roles', [UserController::class, 'filterByRole'])->name('users.role');
			Route::get('/jabatan', [UserController::class, 'filterByJabatan'])->name('users.jabatan');
			Route::get('/result', [UserController::class, 'search'])->name('users.search');
			Route::get('/id-card/{uuid}', [UserController::class, 'printIDCard'])->name('users.id.card');
			Route::get('/log/{uuid}', [UserController::class, 'log'])->name('users.log');
		});

		Route::middleware('role:superadmin')->group(function () {
			Route::get('/edit/{uuid}', [UserController::class, 'edit'])->name('users.edit');
			Route::put('/update/{uuid}', [UserController::class, 'update'])->name('users.update');
			Route::delete('/destroy/{uuid}', [UserController::class, 'destroy'])->name('users.destroy');
		});
	});

	Route::middleware('role:superadmin,admin')->group(function () {
		Route::prefix('peminjaman')->group(function () {
			Route::get('/', [PeminjamanController::class, 'index'])->name('peminjaman.index');
			Route::get('/detail/{uuid}', [PeminjamanController::class, 'show'])->name('peminjaman.show');
			Route::get('/result', [PeminjamanController::class, 'search'])->name('peminjaman.search');
			Route::get('pdf/{uuid}', [PeminjamanController::class, 'print'])->name('peminjaman.print');
			Route::get('laporan-bulanan', [PeminjamanController::class, 'laporanBulanan'])->name('peminjaman.laporan.bulanan');
			Route::get('/laporan-bulanan/pdf', [PeminjamanController::class, 'exportLaporanBulanan'])->name('peminjaman.laporan-bulanan.pdf');
			Route::get('/peminjaman/laporan-bulanan', [PeminjamanController::class, 'laporanBulanan'])->name('peminjaman.laporan-bulanan');
			Route::get('catatan/{id}', [PeminjamanController::class, 'editCatatan'])->name('peminjaman.catatan');
			Route::patch('catatan/update/{id}', [PeminjamanController::class, 'updateCatatan'])->name('peminjaman.catatan.update');
		});

		Route::prefix('pengembalian')->group(function () {
			Route::get('/', [PengembalianController::class, 'index'])->name('pengembalian.index');
			Route::get('/detail/{uuid}', [PengembalianController::class, 'show'])->name('pengembalian.show');
			Route::get('/result', [PengembalianController::class, 'search'])->name('pengembalian.search');
			Route::get('/pengembalian/cetak', [PengembalianController::class, 'cetak'])->name('pengembalian.cetak');
		});

		Route::prefix('perawatan')->group(function () {

			// LIMIT HABIS
			Route::get('/limit-habis', [PerawatanController::class, 'limitHabis'])->name('perawatan.limit.habis.index');
			Route::get('/limit-habis/{uuid}', [PerawatanController::class, 'detailBarangHabis'])->name('perawatan.limit.habis.detail');
			Route::put('/limit-habis/reset/{uuid}', [PerawatanController::class, 'resetLimit'])->name('perawatan.limit.habis.reset');

			// BARANG HILANG
			Route::get('/barang-hilang', [PerawatanController::class, 'barangHilang'])->name('perawatan.barang.hilang.index');
			Route::get('/barang-hilang/{uuid}', [PerawatanController::class, 'detailBarangHilang'])->name('perawatan.barang.hilang.detail');
			Route::put('/barang-hilang/ubah-status/{uuid}', [PerawatanController::class, 'ubahStatus'])->name('perawatan.barang.hilang.ubah-status');
			Route::get('/barang-hilang/cetak/pdf', [PerawatanController::class, 'cetakPdfBarangHilang'])->name('perawatan.barang.hilang.cetak.pdf');
			Route::post('/barang-hilang/upload-surat/{uuid}', [PerawatanController::class, 'uploadSuratDitemukan'])->name('perawatan.barang.hilang.upload.surat');

			// BARANG RUSAK
			Route::get('/barang-rusak', [PerawatanController::class, 'barangRusak'])->name('perawatan.barang.rusak.index');
			Route::get('/barang-rusak/{uuid}', [PerawatanController::class, 'detailBarangRusak'])->name('perawatan.barang.rusak.detail');
			Route::get('/barang-rusak/cetak/pdf', [PerawatanController::class, 'cetakPdfBarangRusak'])->name('perawatan.barang.rusak.cetak.pdf');
			Route::get('/perawatan/lihat-surat', [PerawatanController::class, 'lihatSurat'])->name('perawatan.lihat.surat.index');
			Route::post('/perawatan/upload-surat/{uuid}', [PerawatanController::class, 'uploadSurat'])->name('perawatan.upload.surat');
			Route::delete('/surat/{id}', [PerawatanController::class, 'hapusSurat'])->name('perawatan.surat.hapus');
		});

		// ========================
		// ROUTE DATA BMN
		// ========================
		Route::prefix('admin/bmn')->middleware(['auth', 'verified.password', 'role:superadmin,admin'])->group(function () {
			// Route khusus QR All — harus di atas {ruangan}
			Route::get('/qr-all/download', [BmnController::class, 'downloadQRAll'])
				->name('bmn.qr_all.download');

			Route::get('/mcr', [BmnController::class, 'index'])->name('bmn.mcr.index')->defaults('ruangan', 'mcr');
			Route::get('/studio', [BmnController::class, 'index'])->name('bmn.studio.index')->defaults('ruangan', 'studio');
			Route::get('/peralatan', [BmnController::class, 'index'])->name('bmn.peralatan.index')->defaults('ruangan', 'peralatan');

			Route::get('/{ruangan}/create', [BmnController::class, 'create'])->name('bmn.create');
			Route::post('/{ruangan}/store', [BmnController::class, 'store'])->name('bmn.store');
			Route::get('/{ruangan}/edit/{id}', [BmnController::class, 'edit'])->name('bmn.edit');
			Route::put('/{ruangan}/update/{id}', [BmnController::class, 'update'])->name('bmn.update');
			Route::delete('/{ruangan}/delete/{id}', [BmnController::class, 'destroy'])->name('bmn.delete');
			Route::get('/{ruangan}', [BmnController::class, 'index'])->name('bmn.index');
			Route::get('/{ruangan}/show/{id}', [BmnController::class, 'show'])->name('bmn.show'); //
			// 🔹 Tambahkan route print di sini
			Route::get('/{ruangan}/print', [BmnController::class, 'print'])->name('bmn.print');
			Route::get('/{ruangan}/search', [BmnController::class, 'search'])->name('bmn.search');
			Route::get('/admin/bmn/{ruangan}/print-filter', [BmnController::class, 'printFiltered'])->name('bmn.printFiltered');
			Route::get('/admin/bmn/{ruangan}/print-filtered', [BmnController::class, 'printFiltered'])->name('bmn.printFiltered');
			Route::get('/admin/bmn/{ruangan}/filter-print', [BmnController::class, 'showFilterForm'])
				->name('bmn.filterPrint');
		});
	});
});

// User Route
Route::middleware(['role:user'])->group(function () {

	Route::get('user/options', [OptionsController::class, 'index'])->name('user.option');

	Route::get('user/profil', [OptionsController::class, 'profil'])->name('user.profil');
	Route::patch('user/profil/update', [OptionsController::class, 'updateProfil'])->name('user.profil.update');

	Route::prefix('user/peminjaman')->middleware(['auth', 'role:user'])->group(function () {
		Route::get('/', [PeminjamanUser::class, 'index'])->name('user.peminjaman.index');
		Route::post('/scan', [PeminjamanUser::class, 'scan'])->name('user.peminjaman.scan');
		Route::delete('/remove/{uuid}', [PeminjamanUser::class, 'removeItem'])->name('user.peminjaman.remove');
		Route::post('/store', [PeminjamanUser::class, 'store'])->name('user.peminjaman.store');
		Route::get('/report', [PeminjamanUser::class, 'report'])->name('user.peminjaman.report');
		Route::get('/pdf', [PeminjamanUser::class, 'printReport'])->name('user.peminjaman.pdf');
		Route::post('/peminjaman/send-email/{kodePeminjaman}', [PeminjamanUser::class, 'sendEmail'])
			->name('peminjaman.sendEmail');
	});

	Route::prefix('user/pengembalian')->group(function () {
		Route::get('/', [PengembalianUser::class, 'index'])->name('user.pengembalian.index');
		Route::post('/check', [PengembalianUser::class, 'checkPeminjaman'])->name('user.pengembalian.check');
		Route::post('/validation', [PengembalianUser::class, 'validateItem'])->name('user.pengembalian.validation');
		Route::post('/store', [PengembalianUser::class, 'store'])->name('user.pengembalian.store');
		Route::get('/report', [PengembalianUser::class, 'report'])->name('user.pengembalian.report');
		Route::post('/update_desc', [PengembalianUser::class, 'desc_update'])->name('user.pengembalian.update_desc');
		Route::get('/pdf', [PengembalianUser::class, 'printReport'])->name('user.pengembalian.pdf');
	});
});


Route::prefix('admin')->group(function () {

	// =======================
	// PERAWATAN
	// =======================
	Route::prefix('perawatan')->name('perawatan_inventaris.')->group(function () {

		Route::get('/', [PerawatanInventarisController::class, 'index'])->name('index');

		Route::post('/masuk/{barang_id}', [PerawatanInventarisController::class, 'storeFromBarang'])
			->name('storeFromBarang');

		Route::get('/detail/{id}', [PerawatanInventarisController::class, 'detail'])
			->name('detail');

		Route::get('/perbaiki/{id}', [PerawatanInventarisController::class, 'perbaiki'])
			->name('perbaiki');

		Route::get('/hapuskan/{id}', [PerawatanInventarisController::class, 'hapuskan'])
			->name('hapuskan');

		Route::get('/selesai/{id}', [PerawatanInventarisController::class, 'selesaiForm'])
			->name('selesaiForm');

		Route::post('/selesai/{id}', [PerawatanInventarisController::class, 'selesaiSubmit'])
			->name('selesaiSubmit');
	});


	// =======================
	// RENCANA PENGHAPUSAN
	// =======================
	Route::get(
		'/rencana-penghapusan',
		[RencanaPenghapusanController::class, 'index']
	)
		->name('rencana_penghapusan.index');
	Route::post(
		'/rencana-penghapusan/upload-surat/{id}',
		[RencanaPenghapusanController::class, 'uploadSurat']
	)
		->name('rencana_penghapusan.uploadSurat');

	Route::post(
		'/rencana-penghapusan/hapuskan/{id}',
		[RencanaPenghapusanController::class, 'hapuskan']
	)
		->name('rencana_penghapusan.hapuskan');



	// =======================
	// DATA PENGHAPUSAN
	// =======================
	Route::get(
		'/data-penghapusan',
		[DataPenghapusanController::class, 'index']
	)
		->name('data_penghapusan.index');

	Route::get(
		'/admin/penghapusan',
		[App\Http\Controllers\Admin\DataPenghapusanController::class, 'index']
	)->name('penghapusan.index');

	Route::get(
		'/admin/penghapusan/pdf',
		[App\Http\Controllers\Admin\DataPenghapusanController::class, 'cetakPdf']
	)->name('penghapusan.cetak.pdf');
});


// ============================
// ROUTE INVENTARIS USER
// ============================

Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {

	Route::middleware(['jabatan:Petugas Inventaris'])->group(function () {

		// Halaman daftar inventaris (index)
		Route::get(
			'/inventaris',
			[InventarisUserController::class, 'index']
		)
			->name('user.inventaris');

		// Halaman show_all setelah scan ALL (tampil semua barang)
		Route::get(
			'/inventaris/show_all',
			[InventarisUserController::class, 'showAll']
		)
			->name('user.inventaris.show_all');

		// Scan QR → cek apakah itu barang atau universal QR
		Route::get(
			'/scan-barang/{kode}',
			[InventarisUserController::class, 'scan']
		)
			->name('user.inventaris.scan');

		// Detail barang
		Route::get(
			'/inventaris/detail/{id}',
			[InventarisUserController::class, 'detail']
		)
			->name('user.inventaris.detail');

		// QR Universal helper (opsional) -> arahkan ke index
		Route::get('/inventaris/qr', function () {
			return redirect()->route('user.inventaris');
		})->name('user.inventaris.qr');

		// Download QR Universal
		Route::get(
			'/inventaris/qr/download',
			[InventarisUserController::class, 'downloadAllQR']
		)
			->name('user.inventaris.qr.download');
		// USER
		Route::get(
			'/user/inventaris/{id}/lapor-kerusakan',
			[InventarisUserController::class, 'laporKerusakanForm']
		)
			->name('user.inventaris.lapor-kerusakan.form');

		Route::post(
			'/user/inventaris/lapor-kerusakan',
			[InventarisUserController::class, 'laporKerusakanSubmit']
		)
			->name('user.inventaris.lapor-kerusakan.submit');

		// USER
		Route::get('/lapor-kerusakan/{id}', [LaporanKerusakanController::class, 'form'])
			->name('user.inventaris.lapor-kerusakan.form');

		Route::post('/lapor-kerusakan/store', [LaporanKerusakanController::class, 'store'])
			->name('user.inventaris.lapor-kerusakan.store');
	});
});

use App\Http\Controllers\QrController;

Route::prefix('qr')->group(function () {
	Route::get('/all', [QrController::class, 'qrAll'])->name('qr.inventaris.all');
	Route::get('/all/download/png', [QrController::class, 'downloadAllQrPng'])->name('qr.inventaris.all.download.png');
	Route::get('/all/download/pdf', [QrController::class, 'downloadAllQrPdf'])->name('qr.inventaris.all.download.pdf');

	Route::get('/barang/{kode}', [QrController::class, 'qrBarang'])->name('qr.inventaris.barang');
	Route::get('/barang/{kode}/download/png', [QrController::class, 'downloadQrBarangPng'])->name('qr.inventaris.barang.download.png');
	Route::get('/barang/{kode}/download/pdf', [QrController::class, 'downloadQrBarangPdf'])->name('qr.inventaris.barang.download.pdf');
});

// ADMIN
Route::prefix('admin/laporan-kerusakan')->name('admin.laporan-kerusakan.')->group(function () {

	Route::get('/', [LaporanKerusakanAdminController::class, 'index'])
		->name('index');

	Route::get('/{uuid}/detail', [LaporanKerusakanAdminController::class, 'detail'])
		->name('detail');

	Route::post('/{uuid}/setujui', [LaporanKerusakanAdminController::class, 'setujui'])
		->name('setujui');

	Route::post('/{uuid}/tolak', [LaporanKerusakanAdminController::class, 'tolak'])
		->name('tolak');
});
