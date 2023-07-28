<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\CaptureImageController;
use App\Http\Controllers\PrntController;
use App\Http\Controllers\ExamineeController;
use App\Http\Controllers\ConfirmController;
use App\Http\Controllers\AcceptedController;
use App\Http\Controllers\PortalController;
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
Route::get('/', [LoginController::class, 'main'])->name('main');
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
Route::get('/emp', [LoginController::class, 'index'])->name('index');
Route::post('emp/user_login',[LoginController::class, 'emp_login'])->name('emp_login');

Route::group(['middleware' => 'auth.user'], function(){
    
    Route::get('master', [ControlController::class, 'master'])->name('master'); 
    Route::get('user-settings', [SettingController::class, 'userSettings'])->name('user-settings'); 
    Route::get('logout',[LoginController::class, 'logout'])->name('logout');   
    
    Route::prefix('emp/control')->group(function () {
        Route::get('/', [ControlController::class, 'home'])->name('home');
    });

    Route::prefix('emp/settings')->group(function () {
        Route::get('/', [SettingController::class, 'settings'])->name('settings');
        Route::get('/usermasterList', [SettingController::class, 'usermasterList'])->name('usermasterList');
        Route::post('/create', [SettingController::class, 'createUser'])->name('createUser');
        Route::get('/account/{id}/edit', [SettingController::class, 'account_edit'])->name('account_edit'); 
        Route::put('/account/{id}/update', [SettingController::class, 'account_update'])->name('account_update');  
        Route::get('/account/{id}/delete', [SettingController::class, 'account_delete'])->name('account_delete');
        Route::get('/account/{id}/changepass', [SettingController::class, 'changepass'])->name('changepass'); 
        Route::put('/account/{id}/changepassUpdate', [SettingController::class, 'changepassUpdate'])->name('changepassUpdate'); 
    });

    Route::prefix('emp/admission')->group(function () {
        
        Route::get('/', [AdmissionController::class, 'index'])->name('admission-index'); 
    
        Route::prefix('applicant')->group(function () {
                Route::get('/add', [AdmissionController::class, 'applicant_add'])->name('applicant-add');
                Route::get('/slots', [AdmissionController::class, 'slots'])->name('slots'); 
                Route::get('/list', [AdmissionController::class, 'applicant_list'])->name('applicant-list');
                Route::get('/list/srchappList', [AdmissionController::class, 'srchappList'])->name('srchappList');
                Route::get('/{id}/edit', [AdmissionController::class, 'applicant_edit'])->name('applicant_edit');
                Route::put('/update/{id}', [AdmissionController::class, 'applicant_update'])->name('applicant_update');
                Route::put('/updateExaminee/{id}', [ExamineeController::class, 'applicant_update_nd'])->name('applicant_update_nd');
                Route::get('/{id}/schedule', [AdmissionController::class, 'applicant_schedule'])->name('applicant_schedule');
                Route::get('/{id}/delete', [AdmissionController::class, 'applicant_delete'])->name('applicant_delete');
                Route::get('/{id}/confirm', [AdmissionController::class, 'applicant_confirm'])->name('applicant_confirm');
                Route::get('/capture/{id}', [CaptureImageController::class, 'applicant_capture_image'])->name('applicant_capture_image');
                Route::get('/{id}/print', [PrntController::class, 'applicant_print'])->name('applicant_print');
                Route::get('/{id}/permit', [PrntController::class, 'applicant_permit'])->name('applicant_permit');
                Route::get('/{id}/view', [PrntController::class, 'applicant_genPDF'])->name('applicant_genPDF');
                Route::get('/{id}/viewPermit', [PrntController::class, 'applicant_genPermit'])->name('applicant_genPermit');
                Route::post('applicant-add', [AdmissionController::class, 'post_applicant_add'])->name('post-applicant-add');
                Route::post('/capture/{id}/save', [CaptureImageController::class, 'applicant_save_image'])->name('applicant_save_image');
                Route::put('/schedule/{id}/save', [AdmissionController::class, 'applicant_schedule_save'])->name('applicant_schedule_save');
            });

        Route::prefix('examinee')->group(function () {
            Route::get('/{id}/edit', [ExamineeController::class, 'examinee_edit'])->name('examinee_edit');
            Route::get('/examineeList', [ExamineeController::class, 'examinee_list'])->name('examinee-list');
            Route::get('/{id}/assignresult', [ExamineeController::class, 'assignresult'])->name('assignresult');
            Route::get('/list/srchexamineeList', [ExamineeController::class, 'srchexamineeList'])->name('srchexamineeList');
            Route::get('/{id}/delete', [ExamineeController::class, 'examinee_delete'])->name('examinee_delete');
            Route::get('/result/list', [ExamineeController::class, 'result_list'])->name('result-list');
            Route::put('/result/{id}/save', [ExamineeController::class, 'examinee_result_save'])->name('examinee_result_save');
            Route::put('/result/{id}/save', [ExamineeController::class, 'examinee_result_save_nd'])->name('examinee_result_save_nd');
            Route::get('/{id}/confirm', [ExamineeController::class, 'examinee_confirm'])->name('examinee_confirm');
            Route::get('/list/srchexamineeResultList', [ExamineeController::class, 'srchexamineeResultList'])->name('srchexamineeResultList');
            Route::get('/{id}/printPreEnrolment', [PrntController::class, 'pre_enrolment_print'])->name('pre_enrolment_print');
            Route::get('/{id}/view', [PrntController::class, 'genPreEnrolment'])->name('genPreEnrolment');
            Route::get('/{id}/confirmPreEnrolment', [ExamineeController::class, 'confirmPreEnrolment'])->name('confirmPreEnrolment');      
        });

        Route::prefix('confirm')->group(function () {    
            Route::get('/list', [ConfirmController::class, 'examinee_confirm'])->name('examinee-confirm');
            Route::get('/list/srchconfirmList', [ConfirmController::class, 'srchconfirmList'])->name('srchconfirmList');
            Route::get('/{id}/deptInterview', [ConfirmController::class, 'deptInterview'])->name('deptInterview');
            Route::put('/rating/{id}/save', [ConfirmController::class, 'save_applicant_rating'])->name('save_applicant_rating');
            Route::get('/{id}/saveapplicant', [ConfirmController::class, 'save_accepted_applicant'])->name('save_accepted_applicant');
            Route::get('/accepted', [AcceptedController::class, 'applicant_accepted'])->name('applicant-accepted');
            Route::get('/list/acceptedList', [AcceptedController::class, 'srchacceptedList'])->name('srchacceptedList');
        });

        Route::prefix('reports')->group(function () {    
            Route::get('/applicant', [PrntController::class, 'applicant_printing'])->name('applicant_printing');
            Route::get('/schedules', [PrntController::class, 'schedules_printing'])->name('schedules_printing');
            Route::get('/schedulesReports', [PrntController::class, 'schedules_reports'])->name('schedules_reports');
            Route::get('/applicantReports', [PrntController::class, 'applicant_reports'])->name('applicant_reports');
            Route::get('/examination', [PrntController::class, 'examination_printing'])->name('examination_printing');
            Route::get('/examinationReports', [PrntController::class, 'examination_reports'])->name('examination_reports');
            Route::get('/qualified', [PrntController::class, 'qualified_printing'])->name('qualified_printing');
            Route::get('/qualifiedReports', [PrntController::class, 'qualified_reports'])->name('qualified_reports');
            Route::get('/accepted', [PrntController::class, 'accepted_printing'])->name('accepted_printing');
            Route::get('/acceptedReports', [PrntController::class, 'accepted_reports'])->name('accepted_reports');
            Route::get('/confirm', [PrntController::class, 'confirm_printing'])->name('confirm_printing');
            Route::get('/confirmReports', [PrntController::class, 'confirm_reports'])->name('confirm_reports');
        });

        Route::prefix('configure')->group(function () {    
            Route::get('/', [AdmissionController::class, 'configure_admission'])->name('configure_admission');
            Route::post('add', [AdmissionController::class, 'add_Program'])->name('add_Program');
            Route::post('addStrand', [AdmissionController::class, 'add_Strand'])->name('add_Strand');
            Route::post('addAdmissionDate', [AdmissionController::class, 'add_admission_date'])->name('add_admission_date');
            Route::get('/programEdit/{id}/edit', [AdmissionController::class, 'edit_program'])->name('edit_program');
            Route::post('/programEdit/{id}', [AdmissionController::class, 'programEdit'])->name('programEdit');
            Route::get('/programDelete/{id}/delete', [AdmissionController::class, 'programDelete'])->name('programDelete');
            Route::get('/strandEdit/{id}/edit', [AdmissionController::class, 'edit_strand'])->name('edit_strand');
            Route::post('/strandEdit/{id}', [AdmissionController::class, 'strandEdit'])->name('strandEdit');
            Route::get('/strandDelete/{id}/delete', [AdmissionController::class, 'strandDelete'])->name('strandDelete');
            Route::get('/dateEdit/{id}/edit', [AdmissionController::class, 'edit_date'])->name('edit_date');
            Route::post('/dateEdit/{id}', [AdmissionController::class, 'dateEdit'])->name('dateEdit');
            Route::get('/dateDelete/{id}/delete', [AdmissionController::class, 'dateDelete'])->name('dateDelete');
            Route::post('addAdmissionTime', [AdmissionController::class, 'add_admission_time'])->name('add_admission_time');
            Route::get('/timeEdit/{id}/edit', [AdmissionController::class, 'edit_time'])->name('edit_time');
            Route::post('/timeEdit/{id}', [AdmissionController::class, 'timeEdit'])->name('timeEdit');
            Route::get('/timeDelete/{id}/delete', [AdmissionController::class, 'timeDelete'])->name('timeDelete');
            Route::post('addAdmissionVenue', [AdmissionController::class, 'add_admission_venue'])->name('add_admission_venue');
            Route::get('/venueEdit/{id}/edit', [AdmissionController::class, 'edit_venue'])->name('edit_venue');
            Route::post('/venueEdit/{id}', [AdmissionController::class, 'venueEdit'])->name('venueEdit');
            Route::get('/venueDelete/{id}/delete', [AdmissionController::class, 'venueDelete'])->name('venueDelete');
        });
    });
});

Route::prefix('/portal')->group(function () {
    Route::get('/', [PortalController::class, 'index'])->name('admission-portal');
    // Route::get('/apply', [PortalController::class, 'admission_apply'])->name('admission-apply');
    // Route::get('/admission_current', [PortalController::class, 'admission_data_current'])->name('admission-data-current');
    Route::get('/track-status', [PortalController::class, 'admission_track_status'])->name('admission-track-status');
    Route::get('/track', [PortalController::class, 'admission_track'])->name('admission-track');
    Route::post('/post_admission_apply', [PortalController::class, 'post_admission_apply'])->name('post_admission_apply');
});


