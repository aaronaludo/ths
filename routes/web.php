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
use App\Http\Controllers\Recipient\_NotificationController;

use App\Http\Controllers\Admin\__AuthController;
use App\Http\Controllers\Admin\__DashboardController;
use App\Http\Controllers\Admin\__AccountController;
use App\Http\Controllers\Admin\__ReportController;
use App\Http\Controllers\Admin\__SupportController;
use App\Http\Controllers\Admin\__UserController;
use App\Http\Controllers\Admin\__RecipientController;
use App\Http\Controllers\Admin\__AdminController;

use App\Http\Controllers\Admin\__AboutContentController;
use App\Http\Controllers\Admin\__AcademicCalendarContentController;
use App\Http\Controllers\Admin\__FaqsContentController;
use App\Http\Controllers\Admin\__GalleryShowcaseContentController;
use App\Http\Controllers\Admin\__HomeContentController;
use App\Http\Controllers\Admin\__NewsContentController;
use App\Http\Controllers\Admin\__TeacherSpotlightContentController;


Route::get('/', [__HomeContentController::class, 'home'])->name('home');
Route::get('/about', [__AboutContentController::class, 'home'])->name('about');
Route::get('/academic-calendar', [__AcademicCalendarContentController::class, 'home'])->name('academic-calendar');
Route::get('/faqs', [__FaqsContentController::class, 'home'])->name('faqs');
Route::get('/gallery-showcase', [__GalleryShowcaseContentController::class, 'home'])->name('gallery-showcase');
Route::get('/news', [__NewsContentController::class, 'home'])->name('news');
Route::get('/teacher-spotlight', [__TeacherSpotlightContentController::class, 'home'])->name('teacher-spotlight');

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
    Route::put('/admin/users/{id}', [__UserController::class, 'archive'])->name('admin.users.archive');

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
    Route::put('/admin/recipients/{id}', [__RecipientController::class, 'archive'])->name('admin.recipients.archive');

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
    Route::put('/admin/admins/{id}', [__AdminController::class, 'archive'])->name('admin.admins.archive');

    Route::get('/admin/about', [__AboutContentController::class, 'index'])->name('admin.about.index');
    Route::get('/admin/about/add', [__AboutContentController::class, 'add'])->name('admin.about.add');
    Route::get('/admin/about/search', [__AboutContentController::class, 'search'])->name('admin.about.search');
    Route::post('/admin/about/store', [__AboutContentController::class, 'store'])->name('admin.about.store');
    Route::get('/admin/about/{id}', [__AboutContentController::class, 'view'])->name('admin.about.view');
    Route::get('/admin/about/edit/{id}', [__AboutContentController::class, 'edit'])->name('admin.about.edit');
    Route::put('/admin/about/update/{id}', [__AboutContentController::class, 'update'])->name('admin.about.update');
    Route::delete('/admin/about/{id}', [__AboutContentController::class, 'destroy'])->name('admin.about.destroy');

    Route::get('/admin/academic-calendar', [__AcademicCalendarContentController::class, 'index'])->name('admin.academic-calendar.index');
    Route::get('/admin/academic-calendar/add', [__AcademicCalendarContentController::class, 'add'])->name('admin.academic-calendar.add');
    Route::get('/admin/academic-calendar/search', [__AcademicCalendarContentController::class, 'search'])->name('admin.academic-calendar.search');
    Route::post('/admin/academic-calendar/store', [__AcademicCalendarContentController::class, 'store'])->name('admin.academic-calendar.store');
    Route::get('/admin/academic-calendar/{id}', [__AcademicCalendarContentController::class, 'view'])->name('admin.academic-calendar.view');
    Route::get('/admin/academic-calendar/edit/{id}', [__AcademicCalendarContentController::class, 'edit'])->name('admin.academic-calendar.edit');
    Route::put('/admin/academic-calendar/update/{id}', [__AcademicCalendarContentController::class, 'update'])->name('admin.academic-calendar.update');
    Route::delete('/admin/academic-calendar/{id}', [__AcademicCalendarContentController::class, 'destroy'])->name('admin.academic-calendar.destroy');

    Route::get('/admin/faqs', [__FaqsContentController::class, 'index'])->name('admin.faqs.index');
    Route::get('/admin/faqs/add', [__FaqsContentController::class, 'add'])->name('admin.faqs.add');
    Route::get('/admin/faqs/search', [__FaqsContentController::class, 'search'])->name('admin.faqs.search');
    Route::post('/admin/faqs/store', [__FaqsContentController::class, 'store'])->name('admin.faqs.store');
    Route::get('/admin/faqs/{id}', [__FaqsContentController::class, 'view'])->name('admin.faqs.view');
    Route::get('/admin/faqs/edit/{id}', [__FaqsContentController::class, 'edit'])->name('admin.faqs.edit');
    Route::put('/admin/faqs/update/{id}', [__FaqsContentController::class, 'update'])->name('admin.faqs.update');
    Route::delete('/admin/faqs/{id}', [__FaqsContentController::class, 'destroy'])->name('admin.faqs.destroy');

    Route::get('/admin/gallery-showcase', [__GalleryShowcaseContentController::class, 'index'])->name('admin.gallery-showcase.index');
    Route::get('/admin/gallery-showcase/add', [__GalleryShowcaseContentController::class, 'add'])->name('admin.gallery-showcase.add');
    Route::get('/admin/gallery-showcase/search', [__GalleryShowcaseContentController::class, 'search'])->name('admin.gallery-showcase.search');
    Route::post('/admin/gallery-showcase/store', [__GalleryShowcaseContentController::class, 'store'])->name('admin.gallery-showcase.store');
    Route::get('/admin/gallery-showcase/{id}', [__GalleryShowcaseContentController::class, 'view'])->name('admin.gallery-showcase.view');
    Route::get('/admin/gallery-showcase/edit/{id}', [__GalleryShowcaseContentController::class, 'edit'])->name('admin.gallery-showcase.edit');
    Route::put('/admin/gallery-showcase/update/{id}', [__GalleryShowcaseContentController::class, 'update'])->name('admin.gallery-showcase.update');
    Route::delete('/admin/gallery-showcase/{id}', [__GalleryShowcaseContentController::class, 'destroy'])->name('admin.gallery-showcase.destroy');

    Route::get('/admin/home', [__HomeContentController::class, 'index'])->name('admin.home.index');
    Route::get('/admin/home/add', [__HomeContentController::class, 'add'])->name('admin.home.add');
    Route::get('/admin/home/search', [__HomeContentController::class, 'search'])->name('admin.home.search');
    Route::post('/admin/home/store', [__HomeContentController::class, 'store'])->name('admin.home.store');
    Route::get('/admin/home/{id}', [__HomeContentController::class, 'view'])->name('admin.home.view');
    Route::get('/admin/home/edit/{id}', [__HomeContentController::class, 'edit'])->name('admin.home.edit');
    Route::put('/admin/home/update/{id}', [__HomeContentController::class, 'update'])->name('admin.home.update');
    Route::delete('/admin/home/{id}', [__HomeContentController::class, 'destroy'])->name('admin.home.destroy');

    Route::get('/admin/news', [__NewsContentController::class, 'index'])->name('admin.news.index');
    Route::get('/admin/news/add', [__NewsContentController::class, 'add'])->name('admin.news.add');
    Route::get('/admin/news/search', [__NewsContentController::class, 'search'])->name('admin.news.search');
    Route::post('/admin/news/store', [__NewsContentController::class, 'store'])->name('admin.news.store');
    Route::get('/admin/news/{id}', [__NewsContentController::class, 'view'])->name('admin.news.view');
    Route::get('/admin/news/edit/{id}', [__NewsContentController::class, 'edit'])->name('admin.news.edit');
    Route::put('/admin/news/update/{id}', [__NewsContentController::class, 'update'])->name('admin.news.update');
    Route::delete('/admin/news/{id}', [__NewsContentController::class, 'destroy'])->name('admin.news.destroy');

    Route::get('/admin/teacher-spotlight', [__TeacherSpotlightContentController::class, 'index'])->name('admin.teacher-spotlight.index');
    Route::get('/admin/teacher-spotlight/add', [__TeacherSpotlightContentController::class, 'add'])->name('admin.teacher-spotlight.add');
    Route::get('/admin/teacher-spotlight/search', [__TeacherSpotlightContentController::class, 'search'])->name('admin.teacher-spotlight.search');
    Route::post('/admin/teacher-spotlight/store', [__TeacherSpotlightContentController::class, 'store'])->name('admin.teacher-spotlight.store');
    Route::get('/admin/teacher-spotlight/{id}', [__TeacherSpotlightContentController::class, 'view'])->name('admin.teacher-spotlight.view');
    Route::get('/admin/teacher-spotlight/edit/{id}', [__TeacherSpotlightContentController::class, 'edit'])->name('admin.teacher-spotlight.edit');
    Route::put('/admin/teacher-spotlight/update/{id}', [__TeacherSpotlightContentController::class, 'update'])->name('admin.teacher-spotlight.update');
    Route::delete('/admin/teacher-spotlight/{id}', [__TeacherSpotlightContentController::class, 'destroy'])->name('admin.teacher-spotlight.destroy');
});

Route::middleware(['auth:recipient'])->group(function () {
    Route::get('/recipient/dashboard', [_DashboardController::class, 'index'])->name('recipient.dashboard.index');
    Route::get('/recipient/change-password', [_AccountController::class, 'changePassword'])->name('recipient.account.change-password');
    Route::get('/recipient/edit-profile', [_AccountController::class, 'editProfile'])->name('recipient.account.edit-profile');
    Route::post('/recipient/update-profile', [_AccountController::class, 'updateProfile'])->name('recipient.account.update-profile');
    Route::post('/recipient/update-change-password', [_AccountController::class, 'updatePassword'])->name('recipient.account.update_change_password');
    Route::get('/recipient/reports', [_ReportController::class, 'index'])->name('recipient.reports.index');
    Route::get('/recipient/support', [_SupportController::class, 'index'])->name('recipient.support.index');
    Route::get('/recipient/notifications', [_NotificationController::class, 'index'])->name('recipient.notifications.index');
    Route::put('/recipient/notifications/{id}', [_NotificationController::class, 'status'])->name('recipient.notifications.status');
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
    Route::put('/track-documents/{id}', [TrackDocumentController::class, 'archive'])->name('track-documents.archive');


    Route::get('/track-documents/compose', [TrackDocumentController::class, 'composeIndex'])->name('track-documents.compose');
    Route::post('/track-documents/store', [TrackDocumentController::class, 'composeStore'])->name('track-documents.store');
    Route::get('/track-documents/edit/{id}', [TrackDocumentController::class, 'composeEdit'])->name('track-documents.edit');
    Route::put('/track-documents/update/{id}', [TrackDocumentController::class, 'update'])->name('track-documents.update');
    Route::get('track-documents/{id}', [TrackDocumentController::class, 'view'])->name('track-documents.view');
    Route::get('/request-documents', [RequestDocumentController::class, 'index'])->name('request-documents.index');
    Route::get('/request-documents/search', [RequestDocumentController::class, 'search'])->name('request-documents.search');
    Route::delete('/request-documents/{id}', [RequestDocumentController::class, 'destroy'])->name('request-documents.destroy');
    Route::put('/request-documents/{id}', [RequestDocumentController::class, 'archive'])->name('request-documents.archive');

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