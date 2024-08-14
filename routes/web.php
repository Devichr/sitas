<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SkripsiController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ScheduleController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});

Route::middleware('auth')->group(function () {
    Route::middleware([RoleMiddleware::class . ':mahasiswa'])->group(function () {
        Route::get('/dashboard', [SkripsiController::class, 'index'])->name('dashboard');
        Route::get('/mahasiswa/dokumen', [FormController::class, 'index'])->name('dokumen');
        Route::post('/mahasiswa/dokumen', [FormController::class, 'upload'])->name('dokumen.upload');
        Route::resource('skripsi', SkripsiController::class);
        Route::resource('proposal', ProposalController::class);
    });
    Route::middleware([RoleMiddleware::class . ':dosen'])->name('dosen.')->group(function () {
        Route::get('/dosen/dashboard', [DosenController::class, 'index'])->name('dashboard');
        Route::get('/dosen/bimbingan', [DosenController::class, 'bimbingan'])->name('bimbingan');
        Route::get('/dosen/monitor', [DosenController::class, 'monitor'])->name('monitor');
        Route::get('/dosen/dokumen', [FormController::class, 'fetchDocumentsDosen'])->name('mahasiswa.documents');
        Route::get('/dosen/{student}/documents', [FormController::class, 'showDocuments'])->name('mahasiswa.view');
        Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
        Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    });

    Route::middleware([RoleMiddleware::class . ':admin'])->name('admin.')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('index');
        Route::get('/admin/users', [AdminController::class, 'users'])->name('users');
        Route::get('/admin/skripsi/pengajuan', [AdminController::class, 'skripsi'])->name('pengajuanSkripsi');
        Route::get('/admin/skripsi', [AdminController::class, 'semuaSkripsi'])->name('semuaSkripsi');
        Route::get('/admin/prodi', [AdminController::class, 'prodi'])->name('prodi');
        Route::get('/admin/skripsi/monitoring', [AdminController::class, 'monitoringSkripsi'])->name('monitoringSkripsi');
        Route::get('/admin/proposal', [AdminController::class, 'proposal'])->name('proposal');
        Route::post('/admin/proposal/{id}/approve', [AdminController::class, 'approveProposal'])->name('proposal.approve');
        Route::post('/admin/proposal/{id}/reject', [AdminController::class, 'rejectProposal'])->name('proposal.reject');
        Route::resource('users', AdminController::class);
        Route::resource('prodi', ProdiController::class);
        Route::get('mahasiswa', [AdminController::class, 'dosen'])->name('dosen');
        Route::get('dosen/{id}', [AdminController::class, 'editPembimbing'])->name('editPembimbing');
        Route::post('dosen/{id}', [AdminController::class, 'updatePembimbing'])->name('updatePembimbing');
        Route::post('/skripsi/{id}/approve', [AdminController::class, 'approve'])->name('skripsi.approve');
        Route::post('/skripsi/{id}/reject', [AdminController::class, 'reject'])->name('skripsi.reject');
        Route::get('/skripsi/{id}/download', [AdminController::class, 'download'])->name('skripsi.download');
        Route::get('/admin/dokumen', [FormController::class, 'fetchDocuments'])->name('mahasiswa.documents');
        Route::get('/admin/{student}/documents', [FormController::class, 'showDocuments'])->name('mahasiswa.view');
        Route::get('/admin/schedules', [ScheduleController::class, 'all'])->name('schedules');

    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('chat/show', [ChatController::class, 'show'])->name('chat.show');
    Route::get('/chatlist', [ChatController::class, 'chatList'])->name('chat.list');
    Route::get('messages/{user}', [ChatController::class, 'fetchMessages']);
    Route::post('messages', [ChatController::class, 'sendMessage']);
});

require __DIR__ . '/auth.php';
