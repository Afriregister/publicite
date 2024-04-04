<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DayController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PeriodController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdsTypeController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\AdsCycleController;
use App\Http\Controllers\Admin\PlatformController;
use App\Http\Controllers\Admin\AdsFormatController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\AccountMovementController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\ChannelController;

Route::group(['middleware' => ['guest:admin'], 'prefix' => 'akabanga', 'as' => 'admin.'], function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    //*

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    //*/
});

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'akabanga', 'as' => 'admin.'], function () {

    Route::get('/', [AuthenticatedSessionController::class, 'create'])
        ->name('index');

    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    //dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Resources

    Route::resources([
        'admins' => AdminController::class,
        'adsformats' => AdsFormatController::class,
        'adstypes' => AdsTypeController::class,
        'users' => UserController::class,
        'companies' => CompanyController::class,
        'accounts' => AccountController::class,
        'adscycles' => AdsCycleController::class,
        'platforms' => PlatformController::class,
        'media' => MediaController::class,
        'days' => DayController::class,
        'periods' => PeriodController::class,
        'channels' => ChannelController::class
    ]);

    //Ads Price

    Route::get('channels/{id}/price',[ChannelController::class, 'createAdsPrice'])->name('channels.adsprice');
    Route::post('channels/{id}/storepriceday',[ChannelController::class, 'storeAdsPriceDay'])->name('channels.adspriceday');
    Route::post('channels/{id}/storepriceperiod',[ChannelController::class, 'storeAdsPricePeriod'])->name('channels.adspriceperiod');
    Route::get('channels/{id}/program',[ChannelController::class, 'createProgram'])->name('channels.program');


    //Account mouvement
    Route::get('accountmovements/{id}', [AccountMovementController::class, 'index'])->name('accountmovements.index');
    Route::get('accountmovements/create/{id}', [AccountMovementController::class, 'create'])->name('accountmovements.create');
    Route::post('accountmovements/store/', [AccountMovementController::class, 'store'])->name('accountmovements.store');
    Route::post('accountmovements/edit/{id}', [AccountMovementController::class, 'edit'])->name('accountmovements.edit');
    Route::put('accountmovements/update/{id}', [AccountMovementController::class, 'update'])->name('accountmovements.update');
    Route::delete('accountmovements/delete/{id}', [AccountMovementController::class, 'destroy'])->name('accountmovements.destroy');

    //user
    Route::get('users/{id}/updatepassword', [UserController::class, 'updatePasswordForm'])->name('users.password');
    Route::put('users/{id}/updatepassword', [UserController::class, 'updatePassword'])->name('users.updatepassword');

    //admin
    Route::get('admins/{id}/updatepassword', [AdminController::class, 'updatePasswordForm'])->name('admins.password');
    Route::put('admins/{id}/updatepassword', [AdminController::class, 'updatePassword'])->name('admins.updatepassword');
});
