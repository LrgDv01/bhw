<?php

use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\MapController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ProfileController;
//use App\Http\Controllers\user\bhw\ReportsController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Super_adminController;
use App\Http\Controllers\BhwregistrationController;
use App\Http\Controllers\admin\admin_mdwf\ScheduleController;
use App\Http\Controllers\DutyScheduleController;
use App\Http\Controllers\MaternalCareController; 
use App\Http\Controllers\ChildCensusController;
use App\Http\Controllers\MyscheduleController;
use App\Http\Controllers\admin\admin_mdwf\UseractivityController;
use App\Http\Controllers\BhwFormController;
use App\Http\Controllers\FamilyPlanningController;
use App\Http\Controllers\WreproductiveAgeController;
use App\Http\Controllers\DewormingController;
use App\Http\Controllers\CensusModelController;
use App\Http\Controllers\SummaryListController;

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
        Route::get('/admin/get_dashboard_info', [dashboardController::class, 'get_dashboard_info'])->name('admin.get_dashboard_info');
        Route::get('/admin/get_map_locations', [MapController::class, 'get_map_locations'])->name('admin.map_locations');
        Route::get('/admin/announcement', [Super_adminController::class, 'announcement'])->name('admin.announcement');
     
        Route::delete('/admin/announcement/{id}', [AnnouncementController::class, 'destroy'])->name('admin.announcement.destroy');
        Route::get('/admin/summary-list', [Super_adminController::class, 'summaryList']);

        // Summary List 
        Route::get('/admin/summary-list/census', [SummaryListController::class, 'getCensus'])->name('admin.summary-list.census');
        Route::get('/admin/summary-list/maternal-care', [SummaryListController::class, 'getMaternalCare'])->name('admin.summary-list.maternal-care');
        Route::get('/admin/summary-list/deworming', [SummaryListController::class, 'getDeworming'])->name('admin.summary-list.deworming');
        Route::get('/admin/summary-list/familyplanning', [SummaryListController::class, 'getFamilyPlanning'])->name('admin.summary-list.family-planning');
        Route::get('/admin/summary-list/wreproductive-age', [SummaryListController::class, 'getWreproductiveAge'])->name('admin.summary-list.wreproductive-age');
        Route::get('/admin/summary-list/immunization', [SummaryListController::class, 'getImmunization'])->name('admin.summary-list.immunization');
        Route::get('/admin/summary-list/monthly-report', [SummaryListController::class, 'getReport'])->name('admin.summary-list.monthly-report');

        // Analytics
        Route::get('/admin/analytics/census', [SummaryListController::class, 'getCensusAnalytics'])->name('admin.analytics.census');
        Route::get('/admin/analytics/maternal-care', [SummaryListController::class, 'getMaternalCareAnalytics'])->name('admin.analytics.maternal-care');
        Route::get('/admin/analytics/deworming', [SummaryListController::class, 'getDewormingAnalytics'])->name('admin.analytics.deworming');
        Route::get('/admin/analytics/familyplanning', [SummaryListController::class, 'getFamilyPlanningAnalytics'])->name('admin.analytics.family-planning');
        Route::get('/admin/analytics/wreproductive-age', [SummaryListController::class, 'getWreproductiveAgeAnalytics'])->name('admin.analytics.wreproductive-age');
        Route::get('/admin/analytics/immunization', [SummaryListController::class, 'getImmunizationAnalytics'])->name('admin.analytics.immunization');
        // Route::get('/admin/analytics/monthly-report', [SummaryListController::class, 'getReportAnalytics'])->name('admin.analytics.monthly-report');

        Route::get('/admin/list_bhw', [Super_adminController::class, 'listBHW'])->name('admin.list_bhw');
        Route::get('/admin/bhwregistration', [BhwregistrationController::class, 'index'])->name('admin.bhwregistration.index');
        Route::get('/bhw/dashboard', [BhwregistrationController::class, 'index'])->name('bhw.dashboardss');
        Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard'); 
        Route::middleware(['web'])->group(function () {
            Route::post('/admin/bhwregistration/submit', [BhwregistrationController::class, 'bhwregistration'])->name('admin.bhwregistration.submit');
            Route::post('/admin/announcement', [AnnouncementController::class, 'store'])->name('admin.announcement.store');
        });
    })->middleware('redirect.nonadmin');
    
    Route::middleware(['admin.midwife'])->group(function () {
        Route::get('/admin-midwife/dashboard', [dashboardController::class, 'display_dashboard'])->name('admin.midwife.dashboard');
        Route::get('/admin-midwife/get_dashboard_info', [dashboardController::class, 'get_dashboard_info'])->name('admin.midwife.get_dashboard_info');
        Route::get('/admin-midwife/get_map_locations', [MapController::class, 'get_map_locations'])->name('admin.midwife.map_locations');
        Route::get('/admin-midwife/list_bhw', [Super_adminController::class, 'listBHW']);
        Route::get('/user/services', [ServicesController::class, 'index'])->name('user.services');
        Route::get('/admin-midwife/schedule', [ScheduleController::class, 'index'])->name('admin.schedule.index');
        Route::post('/schedule/add', [ScheduleController::class, 'store'])->name('admin.schedule.add');
        Route::delete('/admin-midwife/schedule/{id}', [ScheduleController::class, 'destroy'])->name('admin.schedule.delete');
        Route::get('admin/duty', [DutyScheduleController::class, 'index'])->name('admin.duty.index');
        Route::post('admin/duty/add', [DutyScheduleController::class, 'store'])->name('admin.duty.add');
        Route::delete('admin/duty/{id}', [DutyScheduleController::class, 'destroy'])->name('admin.duty.delete');
        Route::put('/admin/duty/update-attendance/{id}', [DutyScheduleController::class, 'updateAttendance'])->name('admin.duty.updateAttendance');
        Route::get('/admin-midwife/user-activity', [UseractivityController::class, 'userActivity'])->name('bhw.user_activity');
        Route::get('/admin/Announcement', [ScheduleController::class, 'announcement'])->name('admin.Announcement');
        Route::get('/user-activity', [UseractivityController::class, 'index'])->name('user.activity');

        Route::middleware(['web'])->group(function () {
            Route::post('/user/update-field', [ProfileController::class, 'updateField'])->name('user.update-profile');
            Route::post('/user/update-profile', [ProfileController::class, 'updateProfile'])->name('user.update-profile');
        });
    });

    Route::middleware(['bhw'])->group(function () {
        Route::get('/bhw/dashboard', [dashboardController::class, 'display_dashboard'])->name('bhw.dashboard');
        Route::get('/bhw/get_dashboard_info', [dashboardController::class, 'get_dashboard_info'])->name('bhw.get_dashboard_info');
        Route::get('/bhw/schedule', [ServicesController::class, 'schedule'])->name('bhw.schedule');
        Route::get('/bhw/duty', [ServicesController::class, 'duty'])->name('bhw.duty');
        Route::get('/bhw/child', [ServicesController::class, 'child'])->name('bhw.child');
        //Route::get('/user/reports', [ReportsController::class, 'index'])->name('user.reports');
        Route::get('/user/settings', [ProfileController::class, 'index'])->name('user.settings');
        Route::get('/child-census', [ChildCensusController::class, 'create'])->name('child.census.create');
        Route::post('/child-census', [ChildCensusController::class, 'store'])->name('child.census.store');
        Route::get('/bhw/maternal-care', [MaternalCareController::class, 'index'])->name('bhw.maternal-care');
        Route::get('/bhw/services', [ServicesController::class, 'Serv'])->name('bhw.services');
        Route::get('/bhw/census-form', [CensusModelController::class, 'create'])->name('bhw.census-form');
        Route::post('/bhw/census-store', [CensusModelController::class, 'store'])->name('bhw.census-store');
        Route::post('/bhw/maternal-care/submit', [MaternalCareController::class, 'submitReport'])->name('bhw.maternal-care.submit');

        Route::get('/bhw/monthly-report', [MaternalCareController::class, 'print'])->name('bhw.monthly-report');
        Route::get('/bhw/list', [MaternalCareController::class, 'showList'])->name('bhw.pages.list');
        Route::get('/family-member/{id}', [MaternalCareController::class, 'viewData'])->name('bhw.pages.viewData');
        Route::delete('/family-member/{id}', [MaternalCareController::class, 'destroy'])->name('bhw.pages.deleteData');
        Route::get('/child/{id}/view', [ChildCensusController::class, 'viewChildData'])->name('bhw.pages.viewChildData');
        Route::delete('/child/{id}/delete', [ChildCensusController::class, 'deleteChildData'])->name('bhw.pages.deleteChildData');
        Route::get('/bhw/Announcement', [ServicesController::class, 'announcement'])->name('bhw.Announcement');
        Route::get('/myschedules', [MyscheduleController::class, 'index'])->name('myschedules.index');
        Route::get('/myschedules/{id}', [MyscheduleController::class, 'show'])->name('myschedules.show');
        Route::post('/myschedules', [MyscheduleController::class, 'store'])->name('myschedules.store');
        Route::patch('/myschedules/{id}/update-status', [MyscheduleController::class, 'updateStatus'])->name('myschedules.updateStatus');

        Route::get('/bhw/bhwform', [BhwformController::class, 'bhwform'])->name('bhw.bhwform');
        Route::Post('/bhw/bhwform', [BhwformController::class, 'store'])->name('bhwform.store');
        
        

        Route::get('/familyplanning', [FamilyPlanningController::class, 'index'])->name('bhw.familyplanning');
        Route::post('/familyplanning/store', [FamilyPlanningController::class, 'store'])->name('bhw.familyplanning.store');

        Route::get('/wreproductiveage', [WreproductiveAgeController::class, 'index'])->name('bhw.wreproductiveage.index');
        Route::get('/wreproductiveage/create', [WreproductiveAgeController::class, 'create'])->name('bhw.wreproductiveage.create');
        Route::post('/wreproductiveage', [WreproductiveAgeController::class, 'store'])->name('bhw.wreproductiveage.store');
        Route::get('/wreproductiveage/{id}/edit', [WreproductiveAgeController::class, 'edit'])->name('bhw.wreproductiveage.edit');
        Route::put('/wreproductiveage/{id}', [WreproductiveAgeController::class, 'update'])->name('bhw.wreproductiveage.update');
        Route::delete('/wreproductiveage/{id}', [WreproductiveAgeController::class, 'destroy'])->name('bhw.wreproductiveage.destroy');

        Route::get('/deworming', [DewormingController::class, 'index'])->name('bhw.deworming.index');
        Route::get('/deworming/create', [DewormingController::class, 'create'])->name('bhw.deworming.create');
        Route::post('/deworming', [DewormingController::class, 'store'])->name('bhw.deworming.store');
        Route::get('/deworming/{id}/edit', [DewormingController::class, 'edit'])->name('bhw.deworming.edit');
        Route::put('/deworming/{id}', [DewormingController::class, 'update'])->name('bhw.deworming.update');
        Route::delete('/deworming/{id}', [DewormingController::class, 'destroy'])->name('bhw.deworming.destroy');

        Route::middleware(['web'])->group(function () {
            //Route::post('/reports/submit', [ReportsController::class, 'submitReport'])->name('reports.submit');
            Route::post('/user/update-field', [ProfileController::class, 'updateField'])->name('user.update-profile');
            Route::post('/user/update-profile', [ProfileController::class, 'updateProfile'])->name('user.update-profile');
        
        });
    });

});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




