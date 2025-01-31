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
use App\Http\Controllers\DutyScheduleController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ChildCensusController;
use App\Http\Controllers\MyscheduleController;
use App\Http\Controllers\admin\admin_mdwf\UseractivityController;
use App\Http\Controllers\BhwFormController;
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
        Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard'); 
        Route::get('/admin/get_map_locations', [MapController::class, 'get_map_locations'])->name('admin.map_locations');
        Route::get('/admin/get_dashboard_info', [dashboardController::class, 'get_dashboard_info'])->name('get_dashboard_info');
        Route::middleware(['web'])->group(function () {
        });
    })->middleware('redirect.nonadmin');
    
    Route::middleware(['admin.midwife'])->group(function () {
        Route::get('/admin-midwife/dashboard', [dashboardController::class, 'display_dashboard'])->name('admin.midwife.dashboard');
        Route::get('/admin-midwife/list_bhw', [Super_adminController::class, 'listBHW']);
        Route::get('/user/services', [ServicesController::class, 'index'])->name('user.services');
        
        Route::get('/admin-midwife/schedule', [ScheduleController::class, 'index'])->name('admin.schedule.index');
        Route::post('/schedule/add', [ScheduleController::class, 'store'])->name('admin.schedule.add');
        Route::delete('/admin-midwife/schedule/{id}', [ScheduleController::class, 'destroy'])->name('admin.schedule.delete');
        
        Route::get('admin/duty', [DutyScheduleController::class, 'index'])->name('admin.duty.index');
        Route::post('admin/duty/add', [DutyScheduleController::class, 'store'])->name('admin.duty.add');
        Route::delete('admin/duty/{id}', [DutyScheduleController::class, 'destroy'])->name('admin.duty.delete');
        Route::put('/admin/duty/update-attendance/{id}', [DutyScheduleController::class, 'updateAttendance'])->name('admin.duty.updateAttendance');

        Route::get('/admin/user-activity', [UseractivityController::class, 'userActivity'])->name('bhw.user_activity');

        Route::get('/admin/Announcement', [ScheduleController::class, 'announcement'])->name('admin.Announcement');

        Route::middleware(['web'])->group(function () {
            Route::post('/user/update-field', [ProfileController::class, 'updateField'])->name('user.update-profile');
            Route::post('/user/update-profile', [ProfileController::class, 'updateProfile'])->name('user.update-profile');
        });
    });

    Route::middleware(['bhw'])->group(function () {
       
        
        Route::get('/bhw/schedule', [ServicesController::class, 'schedule'])->name('bhw.schedule');
        Route::get('/bhw/duty', [ServicesController::class, 'duty'])->name('bhw.duty');
        
        Route::get('/bhw/child', [ServicesController::class, 'child'])->name('bhw.child');

        Route::get('/user/reports', [ReportsController::class, 'index'])->name('user.reports');
        Route::get('/user/settings', [ProfileController::class, 'index'])->name('user.settings');

        Route::get('/child-census', [ChildCensusController::class, 'create'])->name('child.census.create');
        Route::post('/child-census', [ChildCensusController::class, 'store'])->name('child.census.store');

        Route::get('/bhw/services', [FormController::class, 'showForm'])->name('bhw.services');
        
        Route::post('/form/save', [FormController::class, 'saveForm'])->name('form.save');

        Route::get('/bhw/print', [FormController::class, 'Print'])->name('bhw.Print');
        Route::get('/bhw/list', [FormController::class, 'showList'])->name('bhw.pages.list');

        Route::get('/family-member/{id}', [FormController::class, 'viewData'])->name('bhw.pages.viewData');
        Route::delete('/family-member/{id}', [FormController::class, 'destroy'])->name('bhw.pages.deleteData');
        Route::get('/child/{id}/view', [ChildCensusController::class, 'viewChildData'])->name('bhw.pages.viewChildData');
        Route::delete('/child/{id}/delete', [ChildCensusController::class, 'deleteChildData'])->name('bhw.pages.deleteChildData');

        Route::get('/bhw/Announcement', [ServicesController::class, 'announcement'])->name('bhw.Announcement');

        Route::get('/myschedules', [MyscheduleController::class, 'index'])->name('myschedules.index');
        Route::get('/myschedules/{id}', [MyscheduleController::class, 'show'])->name('myschedules.show');
        Route::post('/myschedules', [MyscheduleController::class, 'store'])->name('myschedules.store');
        Route::patch('/myschedules/{id}/update-status', [MyscheduleController::class, 'updateStatus'])->name('myschedules.updateStatus');

        Route::get('/bhw/bhwform', [BhwformController::class, 'bhwform'])->name('bhw.bhwform');
        Route::Post('/bhw/bhwform', [BhwformController::class, 'store'])->name('bhwform.store');
        

        Route::middleware(['web'])->group(function () {
            Route::post('/reports/submit', [ReportsController::class, 'submitReport'])->name('reports.submit');
            Route::post('/user/update-field', [ProfileController::class, 'updateField'])->name('user.update-profile');
            Route::post('/user/update-profile', [ProfileController::class, 'updateProfile'])->name('user.update-profile');
        });
    });

});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




