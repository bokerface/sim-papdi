<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CertificateController as AdminCertificateController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Users\CertificateController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\RegistrationController;
use App\Http\Controllers\User\SelectCertificateController;
use App\Http\Controllers\User\TrainingController as UserTrainingController;
use App\Http\Controllers\Users\HomeController;
use App\Http\Controllers\Users\OrderController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('user.homepage');
Route::get('certificate', [SelectCertificateController::class, 'index'])->name('user.check_certificate');
Route::get('check-certificate', [SelectCertificateController::class, 'checkCertificate'])->name('user.select_certificate');
Route::get('login', [UserAuthController::class, 'form'])->name('user.login_form');
Route::post('login', [UserAuthController::class, 'authenticate'])->name('user.login_attempt');
Route::get('signup', [RegistrationController::class, 'form'])->name('user.registration_form');
Route::post('signup', [RegistrationController::class, 'register'])->name('user.submit_registration');

Route::get('forgot-password', [UserAuthController::class, 'askResetPasswordForm'])->name('user.ask_reset_password_form');
Route::post('forgot-password', [UserAuthController::class, 'sendResetPasswordForm'])->name('user.send_reset_password_form');

Route::get('reset-password', [UserAuthController::class, 'resetPasswordForm'])->name('user.reset_password_form');
Route::post('reset-password', [UserAuthController::class, 'resetPasswordAttempt'])->name('user.reset_password_attempt');

Route::get('t_image', [FileController::class, 'trainingBanner'])->name('training.image');

Route::get('trainings/{id}', [UserTrainingController::class, 'show'])->name('user.training_detail');

Route::get('certificate/{training_id}/{participant_email}', [CertificateController::class, 'download'])->name('user.download_certificate');

Route::get('certificate-background', [FileController::class, 'certificateBackground'])->name('uni.certificate_background_image');

// Route::middleware('auth.user')->group(function () {
//     Route::get('logout', [UserAuthController::class, 'logout'])->name('user.logout');
//     Route::prefix('trainings')->group(function () {
//         Route::get('{id}/checkout', [UserTrainingController::class, 'checkout'])->name('user.checkout_training');
//         Route::post('{id}/order', [OrderController::class, 'placeOrder'])->name('user.order_training');
//     });
//     Route::prefix('orders')->group(function () {
//         Route::get('/', [OrderController::class, 'index'])->name('user.order_index');
//         Route::get('{id}', [OrderController::class, 'show'])->name('user.detail_order');
//         Route::get('{id}/pay-order', [OrderController::class, 'midtransCheckoutProcess'])->name('user.pay_order');
//     });
//     // Route::prefix('certificates')->group(function () {
//     //     Route::get('/', [CertificateController::class, 'index'])->name('user.certificate_index');
//     //     Route::get('{id}', [CertificateController::class, 'show'])->name('user.preview_certificate');
//     //     Route::get('{id}/download', [CertificateController::class, 'show'])->name('user.download_certificate');
//     // });
// });

// Admin Routes

Route::prefix('admin')->group(function () {

    Route::get('login', [AuthController::class, 'form'])->name('admin.login_form');
    Route::post('login', [AuthController::class, 'authenticate'])->name('admin.login_attempt');

    Route::middleware('role.admin')->group(function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('trainings')->group(function () {
            Route::get('/', [TrainingController::class, 'index'])->name('admin.training_index');
            Route::get('create', [TrainingController::class, 'create'])->name('admin.create_new_training');
            Route::post('create', [TrainingController::class, 'store'])->name('admin.store_new_training');
            Route::get('{id}', [TrainingController::class, 'edit'])->name('admin.edit_training');
            Route::put('{id}', [TrainingController::class, 'update'])->name('admin.update_training');
            Route::get('{id}/participant', [TrainingController::class, 'participantIndex'])->name('admin.training_participant');
            Route::get('{id}/participant/create', [TrainingController::class, 'addParticipant'])->name('admin.add_training_participant');
            Route::post('{id}/participant/store', [TrainingController::class, 'storeParticipant'])->name('admin.store_training_participant');
            Route::delete('{id}/participant/{participant_id}/delete', [TrainingController::class, 'deleteTrainingParticipant'])->name('admin.delete_training_participant');
            Route::get('{id}/certificate-settings', [AdminCertificateController::class, 'certificateSettings'])->name('admin.certificate_settings');
            Route::post('{id}/certificate-settings', [AdminCertificateController::class, 'storeCertificateSettings'])->name('admin.store_certificate_settings');
        });

        Route::prefix('trainers')->group(function () {
            Route::get('/', [TrainerController::class, 'index'])->name('admin.trainer_index');
            Route::get('trainerByName', [TrainerController::class, 'trainerByName'])->name('admin.get_trainer_by_name');
            Route::get('create', [TrainerController::class, 'create'])->name('admin.create_new_trainer');
            Route::post('create', [TrainerController::class, 'store'])->name('admin.store_new_trainer');
        });

        Route::prefix('categories')->group(function () {
            Route::get('categoryByName', [CategoryController::class, 'categoryByName'])->name('admin.get_category_by_name');
            Route::get('create', [CategoryController::class, 'create'])->name('admin.create_new_category');
            Route::post('create', [CategoryController::class, 'store'])->name('admin.store_new_category');
        });

        Route::prefix('orders')->group(function () {
            Route::get('/', [AdminOrderController::class, 'index'])->name('admin.order_index');
            Route::get('{id}', [AdminOrderController::class, 'show'])->name('admin.detail_order');
            Route::get('{id}/confirm', [AdminOrderController::class, 'confirmPayment'])->name('admin.finish_order');
        });

        Route::prefix('cerificates')->group(function () {
            Route::get('/', [AdminCertificateController::class, 'index'])->name('admin.certificate_index');
            Route::get('settings', [AdminCertificateController::class, 'settingIndex'])->name('admin.certificate_setting_index');
            Route::get('settings/{id}', [AdminCertificateController::class, 'settingDetail'])->name('admin.certificate_setting_detail');
            Route::post('settings/{id}/preview', [AdminCertificateController::class, 'preview'])->name('admin.certificate_setting_preview');
        });
    });
});
