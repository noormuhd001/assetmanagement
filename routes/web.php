<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\NotificationController;

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

Route::group(['middleware' => ['auth', 'role.check']], function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/Home', [AdminController::class, 'edashboard'])->name('edashboard');
    Route::get('/employeedetails', [EmployeeController::class, 'index'])->name('employeedetails');
    Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::get('/employee/delete/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');
    Route::post('employee/update', [EmployeeController::class, 'update'])->name('employee.update');
    Route::get('/employee/details/{id}', [EmployeeController::class, 'details'])->name('employee.details');

    Route::get('/employee/notification/count', [NotificationController::class, 'notificationCount'])->name('employee.notification.count');
    Route::get('/notification', [NotificationController::class, 'notifications'])->name('employee.notification');
    Route::get('user-notify', [NotificationController::class, 'index'])->name('notification.index');


    Route::get('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('markAsRead');

    Route::get('/index', [AssetController::class, 'index'])->name('asset.index');
    Route::get('/addasset', [AssetController::class, 'create'])->name('asset.create');
    Route::post('/store', [AssetController::class, 'store'])->name('asset.store');
    Route::get('/asset/edit/{id}', [AssetController::class, 'edit'])->name('asset.edit');
    Route::get('/asset/delete/{id}', [AssetController::class, 'delete'])->name('asset.delete');
    Route::post('/asset/update', [AssetController::class, 'update'])->name('asset.update');
    Route::get('/userview', [AssetController::class, 'listAsset'])->name('asset.list');
    Route::get('/addasset/{id}/{assetid}', [AssetController::class, 'addasset'])->name('addasset');
    Route::get('/remove/{id}', [AssetController::class, 'removeasset'])->name('removeasset');

    Route::get('/raiseticket', [TicketController::class, 'raise'])->name('ticket.raise');
    Route::post('/raiseticket/submit', [TicketController::class, 'submit'])->name('ticket.submit');
    Route::get('/showticket', [TicketController::class, 'display'])->name('ticket.display');
    Route::get('/ticket/status/{id}', [TicketController::class, 'show'])->name('ticket.show');
    Route::post('/ticket/status/employeereply/{id}', [TicketController::class, 'reply'])->name('ticket.reply');
    Route::get('/Adminticket', [TicketController::class, 'admindisplay'])->name('ticket.admindisplay');
    Route::get('/ticket/adminstatus/{id}', [TicketController::class, 'adminshow'])->name('ticket.adminshow');
    Route::get('/ticket/close/{id}', [TicketController::class, 'ticketclose'])->name('ticket.close');
    Route::post('/ticket/status/reply/{id}', [TicketController::class, 'adminreply'])->name('ticket.adminreply');
});

Route::get('/addemployee', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employeestore', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/verify/{id}', [EmployeeController::class, 'verify'])->name('employee.verify');
Route::get('/', [AdminController::class, 'loginpage'])->name('loginpage');
Route::get('/register', [AdminController::class, 'register'])->name('register');
Route::post('/signup', [AdminController::class, 'adminSignup'])->name('signup');
Route::post('/login', [AdminController::class, 'login'])->name('login');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

