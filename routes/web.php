<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\RequestDocumentController;
use App\Http\Controllers\User\TrackDocumentController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ReportController;
use App\Http\Controllers\User\SupportController;
use App\Http\Controllers\User\AccountController;

use App\Http\Controllers\Recipient\_AuthController;
use App\Http\Controllers\Recipient\_DashboardController;
use App\Http\Controllers\Recipient\_AccountController;
use App\Http\Controllers\Recipient\_ReportController;
use App\Http\Controllers\Recipient\_SupportController;
use App\Http\Controllers\Recipient\_TrackDocumentReviewController;
use App\Http\Controllers\Recipient\_RequestDocumentReviewController;

use App\Http\Controllers\Admin\__AuthController;
use App\Http\Controllers\Admin\__DashboardController;
use App\Http\Controllers\Admin\__AccountController;
use App\Http\Controllers\Admin\__ReportController;
use App\Http\Controllers\Admin\__SupportController;
use App\Http\Controllers\Admin\__UserController;
use App\Http\Controllers\Admin\__RecipientController;
use App\Http\Controllers\Admin\__AdminController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('process.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/recipient/login', [_AuthController::class, 'index'])->name('recipient.login');
Route::post('/recipient/login', [_AuthController::class, 'login'])->name('recipient.process.login');
Route::post('/recipient/logout', [_AuthController::class, 'logout'])->name('recipient.logout');

Route::get('/admin/login', [__AuthController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [__AuthController::class, 'login'])->name('admin.process.login');
Route::post('/admin/logout', [__AuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [__DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::get('/admin/change-password', [__AccountController::class, 'changePassword'])->name('admin.account.change-password');
    Route::get('/admin/edit-profile', [__AccountController::class, 'editProfile'])->name('admin.account.edit-profile');
    Route::post('/admin/update-profile', [__AccountController::class, 'updateProfile'])->name('admin.account.update-profile');
    Route::post('/admin/update-change-password', [__AccountController::class, 'updatePassword'])->name('admin.account.update_change_password');
    Route::get('/admin/reports', [__ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/admin/support', [__SupportController::class, 'index'])->name('admin.support.index');

    Route::get('/admin/users', [__UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/add', [__UserController::class, 'add'])->name('admin.users.add');
    Route::post('/admin/users/store', [__UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/search', [__UserController::class, 'search'])->name('admin.users.search');
    Route::get('/admin/users/{id}', [__UserController::class, 'view'])->name('admin.users.view');
    Route::get('/admin/users/edit/{id}', [__UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/update/{id}', [__UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [__UserController::class, 'destroy'])->name('admin.users.destroy');

    // Route::get('/admin/recipients', [__RecipientController::class, 'index'])->name('admin.recipients.index');
    // Route::get('/admin/recipients/add', [__RecipientController::class, 'add'])->name('admin.recipients.add');
    // Route::get('/admin/recipients/search', [__RecipientController::class, 'search'])->name('admin.recipients.search');
    // Route::get('/admin/recipients/{id}', [__RecipientController::class, 'view'])->name('admin.recipients.view');
    // Route::get('/admin/recipients/edit/{id}', [__RecipientController::class, 'edit'])->name('admin.recipients.edit');

    Route::get('/admin/recipients', [__RecipientController::class, 'index'])->name('admin.recipients.index');
    Route::get('/admin/recipients/add', [__RecipientController::class, 'add'])->name('admin.recipients.add');
    Route::post('/admin/recipients/store', [__RecipientController::class, 'store'])->name('admin.recipients.store');
    Route::get('/admin/recipients/search', [__RecipientController::class, 'search'])->name('admin.recipients.search');
    Route::get('/admin/recipients/{id}', [__RecipientController::class, 'view'])->name('admin.recipients.view');
    Route::get('/admin/recipients/edit/{id}', [__RecipientController::class, 'edit'])->name('admin.recipients.edit');
    Route::put('/admin/recipients/update/{id}', [__RecipientController::class, 'update'])->name('admin.recipients.update');
    Route::delete('/admin/recipients/{id}', [__RecipientController::class, 'destroy'])->name('admin.recipients.destroy');

    // Route::get('/admin/admins', [__AdminController::class, 'index'])->name('admin.admins.index');
    // Route::get('/admin/admins/add', [__AdminController::class, 'add'])->name('admin.admins.add');
    // Route::get('/admin/admins/search', [__AdminController::class, 'search'])->name('admin.admins.search');
    // Route::get('/admin/admins/{id}', [__AdminController::class, 'view'])->name('admin.admins.view');
    // Route::get('/admin/admins/edit/{id}', [__AdminController::class, 'edit'])->name('admin.admins.edit');
    
    Route::get('/admin/admins', [__AdminController::class, 'index'])->name('admin.admins.index');
    Route::get('/admin/admins/add', [__AdminController::class, 'add'])->name('admin.admins.add');
    Route::post('/admin/admins/store', [__AdminController::class, 'store'])->name('admin.admins.store');
    Route::get('/admin/admins/search', [__AdminController::class, 'search'])->name('admin.admins.search');
    Route::get('/admin/admins/{id}', [__AdminController::class, 'view'])->name('admin.admins.view');
    Route::get('/admin/admins/edit/{id}', [__AdminController::class, 'edit'])->name('admin.admins.edit');
    Route::put('/admin/admins/update/{id}', [__AdminController::class, 'update'])->name('admin.admins.update');
    Route::delete('/admin/admins/{id}', [__AdminController::class, 'destroy'])->name('admin.admins.destroy');

});

Route::middleware(['auth:recipient'])->group(function () {
    Route::get('/recipient/dashboard', [_DashboardController::class, 'index'])->name('recipient.dashboard.index');
    Route::get('/recipient/change-password', [_AccountController::class, 'changePassword'])->name('recipient.account.change-password');
    Route::get('/recipient/edit-profile', [_AccountController::class, 'editProfile'])->name('recipient.account.edit-profile');
    Route::post('/recipient/update-profile', [_AccountController::class, 'updateProfile'])->name('recipient.account.update-profile');
    Route::post('/recipient/update-change-password', [_AccountController::class, 'updatePassword'])->name('recipient.account.update_change_password');
    Route::get('/recipient/reports', [_ReportController::class, 'index'])->name('recipient.reports.index');
    Route::get('/recipient/support', [_SupportController::class, 'index'])->name('recipient.support.index');
    Route::get('/recipient/track-document-reviews', [_TrackDocumentReviewController::class, 'index'])->name('recipient.track-document-reviews.index');
    Route::get('/recipient/track-document-reviews/search', [_TrackDocumentReviewController::class, 'search'])->name('recipient.track-document-reviews.search');
    Route::get('/recipient/track-document-reviews/qr-scanner', [_TrackDocumentReviewController::class, 'qrScanner'])->name('recipient.track-document-reviews.qr-scanner');
    Route::post('/recipient/track-document-reviews/qr-scanner', [_TrackDocumentReviewController::class, 'qrScannerResult'])->name('recipient.track-document-reviews.qr-scanner-result');
    Route::get('/recipient/track-document-reviews/{id}', [_TrackDocumentReviewController::class, 'view'])->name('recipient.track-document-reviews.view');
    Route::post('/recipient/change-recipient-status/{id}', [_TrackDocumentReviewController::class, 'changeRecipientStatus'])->name('recipient.change-recipient-status.track');
    Route::get('/recipient/request-document-reviews', [_RequestDocumentReviewController::class, 'index'])->name('recipient.request-document-reviews.index');
    Route::get('/recipient/request-document-reviews/search', [_RequestDocumentReviewController::class, 'search'])->name('recipient.request-document-reviews.search');
    Route::get('/recipient/request-document-reviews/{id}', [_RequestDocumentReviewController::class, 'view'])->name('recipient.request-document-reviews.view');
    Route::post('/recipient/request-change-recipient-status/{id}', [_RequestDocumentReviewController::class, 'changeRequestDocumentStatus'])->name('recipient.change-recipient-status.request');
});

Route::middleware(['auth:normal'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/track-documents', [TrackDocumentController::class, 'index'])->name('track-documents.index');
    Route::get('/track-documents/search', [TrackDocumentController::class, 'search'])->name('track-documents.search');
    Route::delete('/track-documents/{id}', [TrackDocumentController::class, 'destroy'])->name('track-documents.destroy');
    Route::get('/track-documents/compose', [TrackDocumentController::class, 'composeIndex'])->name('track-documents.compose');
    Route::post('/track-documents/store', [TrackDocumentController::class, 'composeStore'])->name('track-documents.store');
    Route::get('/track-documents/edit/{id}', [TrackDocumentController::class, 'composeEdit'])->name('track-documents.edit');
    Route::put('/track-documents/update/{id}', [TrackDocumentController::class, 'update'])->name('track-documents.update');
    Route::get('track-documents/{id}', [TrackDocumentController::class, 'view'])->name('track-documents.view');
    Route::get('/request-documents', [RequestDocumentController::class, 'index'])->name('request-documents.index');
    Route::get('/request-documents/search', [RequestDocumentController::class, 'search'])->name('request-documents.search');
    Route::delete('/request-documents/{id}', [RequestDocumentController::class, 'destroy'])->name('request-documents.destroy');
    Route::get('/request-documents/add', [RequestDocumentController::class, 'add'])->name('request-documents.add');
    Route::post('/request-documents/store', [RequestDocumentController::class, 'store'])->name('request-documents.store');
    Route::get('/request-documents/edit/{id}', [RequestDocumentController::class, 'edit'])->name('request-documents.edit');
    Route::put('/request-documents/update/{id}', [RequestDocumentController::class, 'update'])->name('request-document.update');
    Route::get('/request-documents/{id}', [RequestDocumentController::class, 'view'])->name('request-documents.view');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/support', [SupportController::class, 'index'])->name('support.index');
    Route::get('/change-password', [AccountController::class, 'changePassword'])->name('account.change-password');
    Route::get('/edit-profile', [AccountController::class, 'editProfile'])->name('account.edit-profile');
    Route::post('/update-profile', [AccountController::class, 'updateProfile'])->name('account.update_profile'); 
    Route::post('/update-change-password', [AccountController::class, 'updatePassword'])->name('account.update_change_password'); 
});