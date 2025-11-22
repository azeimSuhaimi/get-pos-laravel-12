<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\wasteController;

use App\Models\User;

Route::controller(AuthController::class)->group(function () {

    Route::get('/','index')->name('auth')->middleware('guest');
    Route::post('/auth','authenticate')->name('auth.login')->middleware(['guest']);

    Route::get('/logout','logout')->name('auth.logout');

    Route::get('/forgot-password', 'forgotPassword')->name('auth.forgot.password')->middleware('guest');
    Route::post('/forgot-password', 'forgotPasswordEmail')->name('auth.forgot.password.email')->middleware('guest');

    Route::get('/reset-password/{token}','reset')->name('password.reset')->middleware('guest');
    Route::post('/reset-password','resetPassword')->name('password.update')->middleware('guest');

    Route::get('/auth/github/redirect', 'githubRedirect')->name('github-varify');
    Route::get('/auth/github/callback', 'githubCallBack');

    Route::get('/auth/google/redirect', 'googleRedirect')->name('google-varify');
    Route::get('/auth/google/callback', 'googleCallBack');

    Route::get('/auth/linkedin/redirect', 'linkedinRedirect')->name('linkedin-varify');
    Route::get('/auth/linkedin/callback', 'linkedinCallBack');

    Route::get('/confirm-password', 'comfirmPassword')->middleware('auth')->name('password.confirm');
    Route::post('/confirm-password', 'comfirmPasswordCheck')->name('password.confirm.check')->middleware(['auth', 'throttle:6,1']);

});// end group auth

Route::controller(DashboardController::class)->group(function () {

    Route::get('/dashboard','index')->name('dashboard')->middleware(['auth']);

});//end group

Route::controller(UserController::class)->group(function () {
   
    Route::get('/profiles','index')->name('user.profile')->middleware(['auth']);
    Route::get('/activity-log','activityLog')->name('user.activity.log')->middleware(['auth','verified',/*,'check_toyyip',*/'password.confirm']);

    Route::get('/change-password','changePassword')->name('user.change.password')->middleware(['auth','verified']);
    Route::post('/change-password','changePasswordUpdate')->name('user.change.password.update')->middleware(['auth','verified']);
    
    
    Route::post('/user-update-profile','updateProfile')->name('user.update.profile')->middleware(['auth','is_admin']);
    Route::post('/user-remove-image','removeImage')->name('user.remove.image')->middleware(['auth','is_admin']);

    Route::get('/company-detail','companyDetail')->name('user.comapany.detail')->middleware(['auth','is_admin']);
    Route::post('/company-update-detail','updateProfileCompany')->name('user.company.update.detail')->middleware(['auth','is_admin']);
    Route::post('/company-remove-image','removeImageCompany')->name('user.company.remove.image')->middleware(['auth','is_admin']);


}); //end group user

Route::controller(EmployeeController::class)->group(function () {
   
    Route::get('/employee','index')->name('employee')->middleware(['auth','is_admin']);

    Route::get('/employee-create','create')->name('employee.create.page')->middleware(['auth','verified','is_admin']);
    Route::post('/employee-create','store')->name('employee.create.store')->middleware(['auth','verified','is_admin']);
    
    Route::get('/employee-view','view')->name('employee.view')->middleware(['auth','is_admin']);
    Route::post('/employee-update-profile','updateProfile')->name('employee.update.profile')->middleware(['auth','is_admin']);
    Route::post('/employee-remove-image','removeImage')->name('employee.remove.image')->middleware(['auth','is_admin']);

    Route::post('/employee-status','status')->name('employee.status')->middleware(['auth','is_admin']);


}); //end group employee














Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect(route('dashboard'))->with('success','Verification Email Success');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');






