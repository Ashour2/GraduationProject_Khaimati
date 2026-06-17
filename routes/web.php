<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CampController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataEntryController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\SupporterController;
use App\Http\Controllers\JoinRequestController;
use App\Http\Controllers\AuthController;


// Public صفحات
Route::get('/', [ContactController::class, 'home'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/join', [JoinRequestController::class, 'create'])->name('join');
Route::post('/join', [JoinRequestController::class, 'store'])->name('join.store');
Route::get('/signin', [AuthController::class, 'showLogin'])->name('signin');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/signin', [AuthController::class, 'login'])->name('signin.post');

Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');


// Dashboard
Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Camps
        Route::resource('camps', CampController::class)->names('camps');
        Route::get('/camps/{camp}/representative', [RepresentativeController::class, 'showByCamp'])->name('representatives.showByCamp');
        Route::get('/camps/{camp}/representative/replace', [RepresentativeController::class, 'replaceForm'])->name('representatives.replace.form');
        Route::put('/camps/{camp}/representative/replace', [RepresentativeController::class, 'replace'])->name('representatives.replace');
        Route::put('/representatives/{representative}', [RepresentativeController::class, 'update'])->name('representatives.update');

        // Registration Requests
        Route::get('/requests', [RequestController::class, 'index'])->name('requests.index');
        Route::get('/requests/{id}', [RequestController::class, 'show'])->name('requests.show');
        Route::post('/requests/{id}/approve', [RequestController::class, 'approve'])->name('requests.approve');
        Route::post('/requests/{id}/reject', [RequestController::class, 'reject'])->name('requests.reject');

        // Supporters
        Route::get('/supporters', [SupporterController::class, 'index'])->name('supporters.index');
        Route::get('/supporters/create', [SupporterController::class, 'create'])->name('supporters.create');
        Route::post('/supporters', [SupporterController::class, 'store'])->name('supporters.store');
        Route::get('/supporters/{supporter}/edit', [SupporterController::class, 'edit'])->name('supporters.edit');
        Route::put('/supporters/{supporter}', [SupporterController::class, 'update'])->name('supporters.update');
        Route::get('/supporters/{supporter}', [SupporterController::class, 'show'])->name('supporters.show');
        Route::delete('/supporters/{supporter}', [SupporterController::class, 'destroy'])->name('supporters.destroy');

        // Users
        Route::get('/users', [DashboardController::class, 'usersIndex'])->name('users.index');
        Route::get('/users/{user}/password', [UserController::class, 'passwordForm'])->name('users.password.form');
        Route::patch('/users/{user}/password', [UserController::class, 'updatePassword'])->name('users.password.update');
        Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
        Route::get('/data-entries/create', [DataEntryController::class, 'create'])->name('data-entries.create');
        Route::post('/data-entries', [DataEntryController::class, 'store'])->name('data-entries.store');

        // Communication
        Route::get('/communications', [CommunicationController::class, 'edit'])->name('communications.edit');
        Route::put('/communications', [CommunicationController::class, 'update'])->name('communications.update');

        // Messages
        Route::get('/messages', [DashboardController::class, 'messagesIndex'])->name('messages.index');
        Route::get('/messages/{id}', [DashboardController::class, 'showMessage'])->name('dashboard.messages.show');
        Route::delete('/messages/{id}', [DashboardController::class, 'deleteMessage'])->name('dashboard.messages.delete');
    });
});


Route::view('/families', 'families')->name('families');
Route::view('/family-members', 'family-members')->name('family-members');
Route::view('/register-family', 'register-family')->name('register-family');

/*********************  */
//all of the following lines by Ashour
// Data Entry Routes

Route::middleware(['auth'])->prefix('data-entry')->name('data-entry.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DataEntry\FamilyController::class, 'index'])->name('dashboard');
    Route::get('/families', [App\Http\Controllers\DataEntry\FamilyController::class, 'index'])->name('families.index');
    Route::get('/families/create', [App\Http\Controllers\DataEntry\FamilyController::class, 'create'])->name('families.create');
    Route::post('/families', [App\Http\Controllers\DataEntry\FamilyController::class, 'store'])->name('families.store');
    Route::delete('/families/{family}', [App\Http\Controllers\DataEntry\FamilyController::class, 'destroy'])->name('families.destroy');
    Route::get('/families/{family}/members', [App\Http\Controllers\DataEntry\FamilyMemberController::class, 'index'])->name('families.members');
    Route::get('/families/{family}/members/create', [App\Http\Controllers\DataEntry\FamilyMemberController::class, 'create'])->name('families.members.create');
    Route::post('/families/{family}/members', [App\Http\Controllers\DataEntry\FamilyMemberController::class, 'store'])->name('families.members.store');
    Route::delete('/families/{family}/members/{member}', [App\Http\Controllers\DataEntry\FamilyMemberController::class, 'destroy'])->name('families.members.destroy');
    Route::get('/families/{family}/members/{member}', [App\Http\Controllers\DataEntry\FamilyMemberController::class, 'show'])->name('families.members.show');


    // عرض وتعديل العائلة
    Route::get('/families/{family}', [App\Http\Controllers\DataEntry\FamilyController::class, 'show'])->name('families.show');
    Route::get('/families/{family}/edit', [App\Http\Controllers\DataEntry\FamilyController::class, 'edit'])->name('families.edit');
    Route::put('/families/{family}', [App\Http\Controllers\DataEntry\FamilyController::class, 'update'])->name('families.update');

// تعديل الفرد
    Route::get('/families/{family}/members/{member}/edit', [App\Http\Controllers\DataEntry\FamilyMemberController::class, 'edit'])->name('families.members.edit');
    Route::put('/families/{family}/members/{member}', [App\Http\Controllers\DataEntry\FamilyMemberController::class, 'update'])->name('families.members.update');
    });


    // Representative Routes

Route::middleware(['auth'])->prefix('representative')->name('representative.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Representative\DashboardController::class, 'index'])->name('dashboard');

    // العائلات
    Route::get('/families', [App\Http\Controllers\Representative\FamilyController::class, 'index'])->name('families.index');
    Route::get('/families/{family}/members', [App\Http\Controllers\Representative\FamilyController::class, 'members'])->name('families.members');

    // توزيع المساعدات
    Route::get('/distributions', [App\Http\Controllers\Representative\DistributionController::class, 'index'])->name('distributions.index');
    Route::post('/distributions', [App\Http\Controllers\Representative\DistributionController::class, 'store'])->name('distributions.store');
    Route::get('/distributions/{distribution}/beneficiaries', [App\Http\Controllers\Representative\DistributionController::class, 'beneficiaries'])->name('distributions.beneficiaries');
    Route::patch('/distributions/{distribution}/confirm', [App\Http\Controllers\Representative\DistributionController::class, 'confirm'])->name('distributions.confirm');

    // المخزون
    Route::get('/inventory', [App\Http\Controllers\Representative\InventoryController::class, 'index'])->name('inventory.index');
    Route::post('/inventory', [App\Http\Controllers\Representative\InventoryController::class, 'store'])->name('inventory.store');
    Route::get('/inventory/aid-types', [App\Http\Controllers\Representative\InventoryController::class, 'aidTypes'])->name('inventory.aid-types');
    Route::post('/inventory/aid-types', [App\Http\Controllers\Representative\InventoryController::class, 'storeAidType'])->name('inventory.aid-types.store');

    // الداعمون
    Route::get('/supporters', [App\Http\Controllers\Representative\SupporterController::class, 'index'])->name('supporters.index');
    Route::get('/supporters/create', [App\Http\Controllers\Representative\SupporterController::class, 'create'])->name('supporters.create');
    Route::post('/supporters', [App\Http\Controllers\Representative\SupporterController::class, 'store'])->name('supporters.store');
    Route::get('/supporters/{supporter}', [App\Http\Controllers\Representative\SupporterController::class, 'show'])->name('supporters.show');
    Route::get('/supporters/{supporter}/edit', [App\Http\Controllers\Representative\SupporterController::class, 'edit'])->name('supporters.edit');
    Route::put('/supporters/{supporter}', [App\Http\Controllers\Representative\SupporterController::class, 'update'])->name('supporters.update');
    Route::delete('/supporters/{supporter}', [App\Http\Controllers\Representative\SupporterController::class, 'destroy'])->name('supporters.destroy');
    Route::post('/supporters/{supporter}/add-to-camp', [App\Http\Controllers\Representative\SupporterController::class, 'addToCamp'])->name('supporters.add-to-camp');

    // التقارير
    Route::get('/reports', [App\Http\Controllers\Representative\ReportController::class, 'index'])->name('reports.index');

    // مدخلي البيانات
    Route::get('/data-entries', [App\Http\Controllers\Representative\DataEntryController::class, 'index'])->name('data-entries.index');
    Route::post('/data-entries', [App\Http\Controllers\Representative\DataEntryController::class, 'store'])->name('data-entries.store');
    Route::patch('/data-entries/{dataEntry}/toggle', [App\Http\Controllers\Representative\DataEntryController::class, 'toggle'])->name('data-entries.toggle');
    Route::put('/data-entries/{dataEntry}', [App\Http\Controllers\Representative\DataEntryController::class, 'update'])->name('data-entries.update');
    Route::patch('/data-entries/{dataEntry}/password', [App\Http\Controllers\Representative\DataEntryController::class, 'updatePassword'])->name('data-entries.password');

    // سجل التغييرات
    Route::get('/change-logs', [App\Http\Controllers\Representative\ChangeLogController::class, 'index'])->name('change-logs.index');
    Route::get('/change-logs/{changeLog}', [App\Http\Controllers\Representative\ChangeLogController::class, 'show'])->name('change-logs.show');
});
