<?php

use App\Events\CountdownUpdated;
use App\Http\Controllers\admin\CallendarController;
use App\Http\Controllers\admin\library\VisitorController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\BlockedAccountController;
use App\Http\Controllers\Library\FacilitiesController;
use App\Http\Controllers\Library\PdlController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\user\BookingController;
use App\Http\Controllers\admin\AdminBookingController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ModuleAccessController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\user\VisitController;

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
    $showAnnouncement = new AnnouncementController();
    $announcement = $showAnnouncement->showAnnouncementLandingPage();
    // CountdownUpdated::dispatch('HEwloooooow');
    return view('welcome', compact('announcement'));
})->name('home')->middleware('redirect.nonlogin');


Route::get('/home', function () {
    return view('welcome');
})->middleware('redirect.nonlogin');


Route::middleware(['redirect.nonlogin', 'guest'])->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/codelogin', 'auth.codelogin')->name('codelogin');
    // Route::view('/register', 'auth.register')->name('register');
    Route::post('/loginsubmit', [AuthController::class, 'login']);
    // Route::post('/registersubmit', [AuthController::class, 'register']);
    
    
    Route::get('/announcement', [AnnouncementController::class, 'showAnnouncement'])->name('announcement');
    Route::get('/announcement/{id}', [AnnouncementController::class, 'showAnnouncement'])->name('announcement');
    Route::view('/guidelines', 'frontpage.guide')->name('guidelines');
    Route::view('/about', 'frontpage.about')->name('about');
    Route::view('/contact', 'frontpage.contact')->name('contact');
    Route::view('/mission_vision', 'frontpage.mission_vision')->name('mission_vision');
});


Route::middleware(['auth'])->group(function () {
    
    // Admin routes
    Route::middleware(['admin'])->group(function () {
        // View Route
        Route::get('/admin', [dashboardController::class, 'display_dashboard'])->name('admin.dashboard');
        // Settings
        Route::middleware(['check.module.access:1007'])->group(function () {
            Route::view('/admin/settings', 'admin.pages.settings')->name('settings');
        });
        // User Management
        Route::middleware(['check.module.access:1000'])->group(function () {
            Route::view('/admin/add_account', 'admin.pages.add_account')->name('add_account');
            Route::view('/admin/users_management', 'admin.pages.users_management')->name('users_management');
            Route::view('/admin/users_verification', 'admin.pages.users_verification')->name('users_verification');
        });
        // Announcement
        Route::middleware(['check.module.access:1005'])->group(function () {
            Route::view('/admin/announcement', 'admin.pages.announcement')->name('announcement');
            Route::view('/admin/add_announcement', 'admin.pages.add_announcement')->name('add_announcement');
        });
        // Jail Library
        Route::middleware(['check.module.access:1003'])->group(function () {
            Route::get('/admin/add_visitor/{id}', [VisitorController::class, 'show_add_visitor_page'])->name('add_visitor');
            Route::get('/admin/update_pdl/{id}', [PdlController::class, 'showUpdatePdlData'])->name('update_pdl');
            Route::view('/admin/library', 'admin.pages.library')->name('library');
            Route::view('/admin/add_pdl', 'admin.pages.library.add_pdl')->name('add_pdl');
            Route::view('/admin/add_facility', 'admin.pages.library.add_facility')->name('add_facility');
        });
        // Visitation Request
        Route::middleware(['check.module.access:1001'])->group(function () {
            Route::view('/admin/visitation/physical', 'admin.pages.request.physical')->name('physical_request');
            Route::view('/admin/visitation/virtual', 'admin.pages.request.virtual')->name('virtual_request');
        });
        // Audit Trail
        Route::middleware(['check.module.access:1006'])->group(function () {
            Route::view('/admin/audit', 'admin.pages.audit')->name('audit');
        });
        // Schedule Calendar
        Route::middleware(['check.module.access:1002'])->group(function () {
            Route::view('/admin/schedule', 'admin.pages.schedule.calendar')->name('calendar');
            Route::view('/admin/schedule/onsite', 'admin.pages.schedule.onsite')->name('schedule.onsite');
            Route::view('/admin/schedule/virtual', 'admin.pages.schedule.virtual')->name('schedule.virtual');
        });
        Route::middleware(['check.module.access:1002'])->group(function () {
            Route::view('/videocall', 'videocall.index')->name('videocall');
        });
        Route::middleware(['check.module.access:2000'])->group(function () {
            Route::view('/admin/qr_scanner', 'admin.pages.qr_scanner')->name('admin.qr_scanner');
        });
        // Get Data For Datatable
        Route::get('/admin/get_dashboard_info', [dashboardController::class, 'get_dashboard_info'])->name('get_dashboard_info');
        Route::get('/admin/dashboard/get_monthly_counts', [dashboardController::class, 'get_monthly_counts'])->name('get_monthly_counts');

        Route::get('/admin/get_users', [UsersController::class, 'get_users'])->name('get_users');
        Route::get('/admin/get_specific_user', [UsersController::class, 'get_specific_user'])->name('get_specific_user');
        Route::get('/admin/get_users_as_visitor', [UsersController::class, 'get_users_as_visitor'])->name('get_users_as_visitor');
        Route::get('/admin/get_announcement', [AnnouncementController::class, 'get_announcement'])->name('get_announcement');
        Route::get('/admin/get_audit', [AuditController::class, 'index'])->name('get_audit');
        Route::get('/admin/get_pdl', [PdlController::class, 'index'])->name('get_pdl');
        Route::get('/admin/get_facility', [FacilitiesController::class, 'index'])->name('get_facility');
        Route::get('/admin/get_visitor_list', [VisitorController::class, 'get_visitor_info'])->name('get_visitor_list');
        
        Route::get('/admin/events', [CallendarController::class, 'index'])->name('events');
        Route::get('/admin/get-dates', [CallendarController::class, 'getDates']);
        
        Route::get('/admin/calendarbook', [CallendarController::class, 'calendarbook'])->name('calendarbook');
        Route::get('/admin/feedback', [FeedbackController::class, 'view'])->name('view_feedback');
        
        Route::view('/admin/help', 'admin.pages.help')->name('help');
        
        Route::middleware(['web'])->group(function () {
            // Function routes
            Route::post('/admin/add_announcement_submit', [AnnouncementController::class, 'store'])->name('add_announcement_submit');
            Route::match(['get', 'post'], '/admin/update_announcement/{id}', [AnnouncementController::class, 'updateAnnouncement'])->name('update_announcement');
            Route::match(['get', 'post'], '/admin/update_announcement_submit', [AnnouncementController::class, 'update'])->name('update_announcement_submit');
            Route::post('/admin/delete_announcement_submit', [AnnouncementController::class, 'delete'])->name('delete_announcement_submit');
            
            Route::post('/admin/block-dates', [CallendarController::class, 'blockDates']);
            Route::post('/admin/slot-dates', [CallendarController::class, 'slotDates']);
            Route::post('/admin/delete-event', [CallendarController::class, 'deleteEvent'])->name('admin.deleteEvent');
            
            Route::post('/admin/user_verification', [UsersController::class, 'verifyUser']);
            
            Route::post('/admin/add_facilities_submit', [FacilitiesController::class, 'add_facilities_submit'])->name('admin.add_facilities_submit');
            Route::post('/admin/update_facility_status', [FacilitiesController::class, 'update_facility_status'])->name('admin.update_facility_status');
            
            Route::post('/admin/add_account_submit', [UsersController::class, 'add_account_submit'])->name('admin.add_account_submit');
            Route::post('/admin/update_app_info', [SettingsController::class, 'updateapp_info'])->name('admin.updateAppInfo');
            
            Route::post('/admin/add_pdl_submit', [PdlController::class, 'add_pdl_submit'])->name('admin.add_pdl_submit');
            Route::post('/admin/update_pdl_submit', [PdlController::class, 'update_pdl_submit'])->name('admin.update_pdl_submit');
            
            Route::post('/admin/change_password', [UsersController::class, 'changePassword'])->name('admin.changepassword');
            Route::post('/admin/reset_password', [UsersController::class, 'resetPassword'])->name('admin.resetPassword');
        
            Route::post('/admin/blocked-account', [BlockedAccountController::class, 'add_blocked_account'])->name('add_blocked_account');
            Route::delete('/admin/activate_user/{id}', [BlockedAccountController::class, 'delete_blocked_account'])->name('delete_blocked_account');
        
            Route::get('/admin/bookingrequest/{type}', [AdminBookingController::class, 'get_booking_per_type'])->name('get_booking');
            Route::get('/admin/bookingdetails/{transaction_number}/{bookID}', [AdminBookingController::class, 'get_booking'])->name('get_booking');
            Route::get('/admin/user_profile/{id}', [UsersController::class, 'display_user_profile'])->name('display_module_access');
            Route::get('/admin/module_access/{id}', [ModuleAccessController::class, 'display_module_access'])->name('display_module_access');
            Route::post('/admin/decline-booking', [AdminBookingController::class, 'cancel_booking'])->name('cancel_booking');
            Route::post('/admin/booking/approve', [AdminBookingController::class, 'approve_booking'])->name('approve_booking');
            Route::post('/admin/update_meeting_link', [AdminBookingController::class, 'update_meeting_link'])->name('update_meeting_link');
            
            Route::get('/admin/get_visitation_of_pdl', [AdminBookingController::class, 'get_visitation_of_pdl'])->name('get_visitation_of_pdl');
            Route::get('/admin/get_custom_booking', [AdminBookingController::class, 'get_custom_booking'])->name('get_custom_booking');
            Route::post('/admin/custom_booking_submit', [AdminBookingController::class, 'custom_booking_submit'])->name('custom_booking_submit');
            Route::post('/admin/custom_booking_delete/{id}', [AdminBookingController::class, 'custom_booking_delete'])->name('custom_booking_delete');
            
            Route::post('/admin/tag_visitor', [VisitorController::class, 'tag_visitor'])->name('tag_visitor');
            Route::delete('/admin/delete_visitor/{id}', [VisitorController::class, 'deleteVisitor'])->name('delete_visitor');
            
            Route::post('/admin/add_module_access', [ModuleAccessController::class, 'add_module_access'])->name('module_access.add_module_access');
            Route::delete('/admin/module_access/{id}/{userid}', [ModuleAccessController::class, 'delete_module_access'])->name('module_access.delete_module_access');
            Route::post('/admin/update_pdl_status', [PdlController::class, 'update_pdl_status'])->name('admin.update_pdl_status');
        
            Route::get('/admin/get_pendings/', [AdminBookingController::class, 'get_pendings'])->name('get_pendings');
        
            Route::get('/admin/getfeedback', [FeedbackController::class, 'getFeedback'])->name('admin.getFeedback');

        });
    })->middleware('redirect.nonadmin');
    
    
    Route::middleware(['visitor'])->group(function () {
        Route::get('/user/home', function () {
            return view('user.home');
        })->name('user.home');
        Route::middleware(['web'])->group(function () {
            Route::post('/user/update-profile', [UsersController::class, 'updateProfile'])->name('update-profile');
            Route::get('/user/visit-form/physical', [VisitController::class, 'display_form_physical'])->name('physical_visitform');
            Route::get('/user/visit-form/virtual', [VisitController::class, 'display_form_virtual'])->name('virtual_visitform');
            Route::get('/user/visitor_list', [VisitController::class, 'get_tag_visitor'])->name('get_tag_visitor');
            Route::get('/user/visitor_status', [VisitController::class, 'get_booking'])->name('get_booking');
            Route::post('/user/add_booking_submit', [VisitController::class, 'add_booking_submit'])->name('add_booking_submit');
            Route::get('/user/get-dates', [CallendarController::class, 'getDates']);
            Route::get('/user/events', [CallendarController::class, 'index'])->name('events');
            Route::get('/user/get-booking', [BookingController::class, 'get_booking'])->name('get_booking');
            Route::get('/user/get-booking/{transaction_number}/{bookID}', [BookingController::class, 'get_booking'])->name('get_booking');
            Route::post('/user/cancel-booking', [BookingController::class, 'cancel_booking'])->name('get_booking');
            Route::get('/user/help', function () {
                return view('user.pages.help');
            })->name('user.help');
            Route::get('/user/about', function () {
                return view('user.pages.about');
            })->name('user.about');
        });
        Route::view('/videocall/{code}', 'videocall.index')->name('videocall');
    });
    
    Route::get('/notifications/unread', [NotificationController::class, 'getUnreadNotifications']);
    Route::post('/notifications/mark-read', [NotificationController::class, 'markNotificationsAsRead']);
    Route::post('/submit-feedback', [FeedbackController::class, 'create_feedback'])->name('submit.feedback');
    Route::get('/check-access', [ModuleAccessController::class, 'checkAccess']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
