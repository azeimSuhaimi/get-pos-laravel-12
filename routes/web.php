<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\WasteController;
use App\Http\Controllers\customerOrderController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ItemRedeemController;

use App\Models\User;

Route::controller(AuthController::class)->group(function () {

    Route::get('/','index')->name('login')->middleware('guest');
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

    Route::get('/email/verify', 'verificationNotice')->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verificationVerify')->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', 'verificationSend')->middleware(['auth', 'throttle:6,1'])->name('verification.send');

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
    Route::post('/employee-reset-password','resetPassword')->name('employee.reset.password')->middleware(['auth','is_admin']);

}); //end group employee

Route::controller(ItemController::class)->group(function () {
   
    Route::get('/item','index')->name('item')->middleware(['auth']);

    Route::get('/item-create','create')->name('item.create.page')->middleware(['auth','verified','is_admin']);
    Route::post('/item-create','store')->name('item.create.store')->middleware(['auth','verified','is_admin']);
    
    Route::get('/item-view','view')->name('item.view')->middleware(['auth']);
    Route::post('/item-update','update')->name('item.update.')->middleware(['auth','is_admin']);
    Route::post('/item-remove-image','removeImage')->name('item.remove.image')->middleware(['auth','is_admin']);

    Route::post('/item-status','status')->name('item.status')->middleware(['auth','is_admin']);
    Route::post('/item-status-quick','statusQuick')->name('item.status.quick')->middleware(['auth','is_admin']);

    Route::get('/do-create','createDo')->name('do.create.page')->middleware(['auth','verified','is_admin']);
    Route::post('/do-create','storeDo')->name('do.create.store')->middleware(['auth','verified','is_admin']);

    Route::get('/do-view','viewDo')->name('do.view')->middleware(['auth','verified','is_admin']);
    Route::post('/do-create-item','storeDoItem')->name('do.create.item')->middleware(['auth','verified','is_admin']);


}); //end group item

Route::controller(WasteController::class)->group(function () {
   
    Route::get('/waste','index')->name('waste')->middleware(['auth','is_admin']);

    Route::get('/waste-create','create')->name('waste.create.page')->middleware(['auth','verified','is_admin']);
    Route::post('/waste-create','store')->name('waste.create.store')->middleware(['auth','verified','is_admin']);
    
    Route::get('/waste-view','view')->name('waste.view')->middleware(['auth','is_admin']);
    
}); //end group waste

Route::controller(customerOrderController::class)->group(function () {

    
    Route::get('/customer-order','index')->name('customer.order')->middleware(['auth']);
    Route::get('/customer-order-create','create')->name('customer.order.create')->middleware(['auth','verified']);
    Route::post('/customer-order-store','store')->name('customer.order.store')->middleware(['auth']);
    Route::post('/customer-order-update-contact','updateContact')->name('customer.order.update.contact')->middleware(['auth']);
    Route::post('/customer-order-update-status','updateStatus')->name('customer.order.update.status')->middleware(['auth']);
    //Route::get('/customer_order_view','view')->name('customer_order.view')->middleware(['auth']);
    //Route::get('/customer_order_edit','edit')->name('customer_order.edit')->middleware(['auth']);
    //Route::post('/customer_order_update','update')->name('customer_order.update')->middleware(['auth']);
    Route::post('/customer-order-remove','remove')->name('customer.order.remove')->middleware(['auth']);

});

Route::controller(CustomerController::class)->group(function () {

    Route::get('/customer-create','create')->name('customer.create')->middleware(['auth','verified']);
    Route::post('/customer-store','store')->name('customer.store')->middleware(['auth']);
    Route::get('/customer-create-by-guest','createByGuest')->name('customer.create.by.guest')->middleware(['guest']);
    Route::post('/customer-store-by-guest','storeByGuest')->name('customer.store.by.guest')->middleware(['guest']);
    Route::get('/customer','index')->name('customer')->middleware(['auth']);
    Route::get('/customer-view','view')->name('customer.view')->middleware(['auth']);
    Route::post('/customer-update','update')->name('customer.update')->middleware(['auth']);
    Route::post('/customer-enter-member','enterMember')->name('customer.enter.member')->middleware(['auth']);
    

});

Route::controller(ExpenseController::class)->group(function () {

    
    Route::get('/expense_create','create')->name('expense.create')->middleware(['auth','verified']);
    Route::post('/expense_store','store')->name('expense.store')->middleware(['auth']);
    Route::get('/expense','index')->name('expense')->middleware(['auth']);
    Route::get('/expense_view','view')->name('expense.view')->middleware(['auth']);
    Route::get('/expense_edit','edit')->name('expense.edit')->middleware(['auth']);
    Route::post('/expense_update','update')->name('expense.update')->middleware(['auth']);
    Route::post('/expense_remove','remove')->name('expense.remove')->middleware(['auth']);
    
});


Route::controller(ItemRedeemController::class)->group(function () {

    Route::get('/item.redeem','index')->name('item.redeem')->middleware(['auth']);
    Route::get('/item.redeem_create','create')->name('item.redeem.create')->middleware(['auth','verified']);
    Route::post('/item.redeem_store','store')->name('item.redeem.store')->middleware(['auth']);
    Route::get('/item.redeem_view','view')->name('item.redeem.view')->middleware(['auth']);
    Route::post('/item.redeem_update','update')->name('item.redeem.update')->middleware(['auth']);
    Route::post('/item.redeem_status','status')->name('item.redeem.status')->middleware(['auth']);
    Route::post('/item.redeem_delete','delete')->name('item.redeem.delete')->middleware(['auth']);
    Route::get('/item.redeem_customer_redeem','customer_redeem')->name('item.redeem.customer_redeem')->middleware(['auth']);
    Route::get('/item.redeem_search_customer','search_customer')->name('item.redeem.search_customer')->middleware(['auth']);
    Route::post('/item.redeem_redeen','redeen')->name('item.redeem.redeen')->middleware(['auth']);
    //::post('/reset_password_employee','reset_password_employee')->name('employee.reset.password')->middleware(['auth']);
});














/*

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

*/





