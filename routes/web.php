<?php

use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\MapController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\bhw\ReportsController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Super_adminController;
use App\Http\Controllers\BhwregistrationController;
use App\Http\Controllers\admin\admin_mdwf\ScheduleController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
})->name('home')->middleware('redirect.nonlogin');


Route::middleware(['redirect.nonlogin', 'guest'])->group(function () { 
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/register', 'auth.register')->name('register'); 
    Route::post('/loginsubmit', [AuthController::class, 'login']);
    Route::post('/registersubmit', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class,'showRequestForm'])->name('request-form');
    Route::post('/request/reset-link', [AuthController::class, 'requestResetLink'])->name('request.reset-link');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
    Route::view('/contact', 'frontpage.contact')->name('contact');
});


Route::middleware(['auth'])->group(function () {
    Route::middleware(['superadmin.bhw.president'])->group(function () {    
        Route::get('/admin/dashboard', [dashboardController::class, 'display_dashboard'])->name('admin.dashboard');
        Route::get('/admin/announcement', [Super_adminController::class, 'announcement'])->name('admin.announcement');
        Route::post('/admin/announcement', [AnnouncementController::class, 'store'])->name('admin.announcement.store');
        Route::delete('/admin/announcement/{id}', [AnnouncementController::class, 'destroy'])->name('admin.announcement.destroy');
        Route::get('/admin/summary-list', [Super_adminController::class, 'summaryList']);
        Route::get('/admin/list_bhw', [Super_adminController::class, 'listBHW'])->name('admin.list_bhw');
        Route::get('/admin/bhwregistration', [BhwregistrationController::class, 'index'])->name('admin.bhwregistration.index');
        Route::post('/admin/bhwregistration/submit', [BhwregistrationController::class, 'bhwregistration'])->name('admin.bhwregistration.submit');
        Route::get('/bhw/dashboard', [BhwregistrationController::class, 'index'])->name('bhw.dashboardss');
        Route::view('/admin/map', 'admin.pages.map_locations')->name('admin.map'); 
        Route::get('/admin/get_map_locations', [MapController::class, 'get_map_locations'])->name('admin.map_locations');
        Route::get('/admin/get_dashboard_info', [dashboardController::class, 'get_dashboard_info'])->name('get_dashboard_info');
        Route::middleware(['web'])->group(function () {
        });
    })->middleware('redirect.nonadmin');
    
    Route::middleware(['admin.midwife'])->group(function () {
        Route::get('/admin-midwife/dashboard', [dashboardController::class, 'display_dashboard'])->name('admin.midwife.dashboard');
        Route::get('/admin-midwife/schedule', [ScheduleController::class, 'index']);
        Route::get('/admin-midwife/list_bhw', [Super_adminController::class, 'listBHW']);
        Route::get('/user/services', [ServicesController::class, 'index'])->name('user.services');
        Route::middleware(['web'])->group(function () {
            Route::post('/user/update-field', [ProfileController::class, 'updateField'])->name('user.update-profile');
            Route::post('/user/update-profile', [ProfileController::class, 'updateProfile'])->name('user.update-profile');
        });
    });

    Route::middleware(['bhw'])->group(function () {
        Route::get('/bhw/services', [ServicesController::class, 'index'])->name('bhw.services');
        Route::get('/bhw/list', [ServicesController::class, 'list'])->name('bhw.list');
        Route::get('/bhw/schedule', [ServicesController::class, 'schedule'])->name('bhw.schedule');
        Route::get('/bhw/user-activity', [ServicesController::class, 'userActivity'])->name('bhw.user_activity');

        Route::get('/user/reports', [ReportsController::class, 'index'])->name('user.reports');
        Route::get('/user/settings', [ProfileController::class, 'index'])->name('user.settings');
        Route::middleware(['web'])->group(function () {
            Route::post('/reports/submit', [ReportsController::class, 'submitReport'])->name('reports.submit');
            Route::post('/user/update-field', [ProfileController::class, 'updateField'])->name('user.update-profile');
            Route::post('/user/update-profile', [ProfileController::class, 'updateProfile'])->name('user.update-profile');
        });
    });

});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




