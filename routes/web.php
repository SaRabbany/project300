<?php

use App\Http\Controllers\authenticationController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\transectionHandleController;
use App\Http\Controllers\UserFundWithdrawController;
use App\Http\Middleware\ensureUserIsSuperAdmin;
use App\Models\userFundWithdraw;
use Illuminate\Support\Facades\Route;

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

// --------------------------   public routes -------------------------


Route::post('first-register', [authenticationController::class, 'firstRegister'])->name('firstRegister');
Route::post('crypto-success', [OrderController::class, 'cryptosuccess'])->name('crypto-success');




// ---------------------------  Protected Routes ---------------------------------


Route::middleware(['auth:sanctum'])->group(function () {


    Route::get('auth-redirector',function()
    {
        if(auth()->user()->role_id == 1){
            return redirect()->route('superAdmin');

        }elseif(auth()->user()->role_id == 2 ){
            return redirect()->route('dashboard');
        }

    } )->name('auth-redirector');


    Route::get('/dashboard', [indexController::class, 'index'])->name('dashboard');
    Route::post('order-confirmation', [OrderController::class, 'store'])->name('order-confirmation');
    Route::get('order', [OrderController::class, 'orderProduct'])->name('order');
    Route::post('newsletter-save', [NewsletterController::class, 'store'])->name('newsletter-save');
    Route::get('order-unsuccessfull', [OrderController::class, 'orderUnsuccessfull'])->name('order-unsuccessfull');
    Route::post('order-success', [OrderController::class, 'ordersuccessfull'])->name('order-success');
    Route::get('profile',[SettingController::class, 'personal'])->name('personal');


    // super admin routes
    Route::middleware(ensureUserIsSuperAdmin::class)->group(function () {
        Route::get('super-admin', [SuperAdminController::class, 'index'])->name('superAdmin');
        Route::get('pending-orders', [SuperAdminController::class, 'pendingOrders'])->name('pendingOrders');
        Route::get('all-orders', [SuperAdminController::class, 'allOrders'])->name('allOrders');
        Route::post('order-approve', [SuperAdminController::class, 'approve'])->name('order-approve');
        Route::post('delete-order', [SuperAdminController::class, 'destroyOrder'])->name('delete-order');
        Route::post('decline-order', [SuperAdminController::class, 'decline'])->name('decline-order');
        Route::get('declined-order', [SuperAdminController::class, 'declinedOrders'])->name('declined-order');
        Route::get('affiliator-income', [SuperAdminController::class, 'affiliatorIncome'])->name('affiliator-income');
        Route::get('settings',[SettingController::class, 'index'])->name('settings');

        Route::post('settings-update',[SettingController::class, 'update'])->name('setting.save');
        Route::get('affiliator-payment-request', [SuperAdminController::class, 'affiliatorPaymentRequest'])->name('affiliator-payment-request');
        Route::post('affiliator-payment-request-approve', [SuperAdminController::class, 'affiliatorPaymentRequestApprove'])->name('affiliator-payment-request-approve');
        Route::post('affiliator-payment-request-reject', [SuperAdminController::class, 'affiliatorPaymentRequestRejct'])->name('affiliator-payment-request-reject');

    });



    route::post('affiliator_switch', [indexController::class, 'affiliatorSwitch'])->name('affiliator_switch');
    Route::post('withdrawRequest', [UserFundWithdrawController::class, 'withdrawRequest'])->name('withdrawRequest');

});

Route::get('get-pending-orders', [indexController::class, 'pendingOrderCount'])->name('get-pending-orders');



// ---------------------------- Never Touch this route ------------------------------------
Route::get('/',[indexController::class, 'user'])->name('home');
Route::get('/{reffer_code}',[indexController::class, 'user']);

//---------------------



