<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\RequestTypeController;
use App\Services\ActivityLogger;

use App\Http\Controllers\NicmuController;
use App\Http\Controllers\MisController;
use App\Http\Controllers\ICTRAMController;
use App\Http\Controllers\ICTRAMRequestController;
// use App\Http\Controllers\UnitController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::prefix('director')->middleware(['auth', 'cache', 'approved', 'directors'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('director.dashboard');
    Route::get('/users/approve/{id}', [UserController::class, 'approve'])->name('users.approve');
    Route::get('/users/disapprove/{id}', [UserController::class, 'disapprove'])->name('users.disapprove');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::put('/edit-user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/delete-user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

});

Route::prefix('unit-head')->middleware(['auth', 'cache', 'approved', 'unit-heads'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('unit-head.dashboard');

});

Route::prefix('mict-staff')->middleware(['auth', 'cache', 'approved', 'mict-staffs'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('mict-staff.dashboard');

});


Route::prefix('staff')->middleware(['auth', 'cache', 'approved','staffs'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('staff.dashboard');

});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/account-pending', function () {
    return view('account.pending'); 
})->name('account.pending');


Route::middleware(['auth'])->group(function () {
    Route::get('/setup-profile', [UserController::class, 'setupProfileForm'])->name('user.setupProfile');
    Route::post('/setup-profile', [UserController::class, 'saveProfile'])->name('user.saveProfile');
});


Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('user.edit');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
Route::get('/mark-notification-as-read/{notification}', [NotificationController::class, 'markAsRead'])->name('mark-notification-as-read');
Route::post('/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('mark-all-as-read');
Route::get('/mark-notification-as-read/{notification}', [NotificationController::class, 'markAsRead'])->name('mark-notification-as-read');

Route::get('/tickets', [TicketController::class, 'index'])->name('tickets');
Route::get('/create/ticket', [TicketController::class, 'create'])->name('create.ticket');
Route::post('/store/ticket', [TicketController::class, 'store'])->name('store.ticket');
Route::get('/show/ticket/{id}', [TicketController::class, 'show'])->name('ticket.show');
Route::get('/edit-ticket/{id}', [TicketController::class, 'edit'])->name('edit.ticket');
Route::put('/edit-ticket/{id}', [TicketController::class, 'update'])->name('update.ticket');
Route::delete('/delete-ticket/{id}', [TicketController::class, 'destroy'])->name('destroy.ticket');
Route::post('tickets/{ticket}/update-users', [TicketController::class, 'updateUsers'])->name('tickets.updateUsers');
Route::get('/tickets/unassigned', [TicketController::class, 'unassigned'])->name('tickets.unassigned');
Route::get('/tickets/assigned', [TicketController::class, 'assignedToMe'])->name('tickets.assigned');

Route::get('/faqs', [FaqsController::class, 'index'])->name('faqs');
Route::get('/create/faq', [FaqsController::class, 'create'])->name('create.faq');
Route::post('/store/faq', [FaqsController::class, 'store'])->name('store.faq');
Route::get('/faqs/show/{id}', [FaqsController::class, 'show'])->name('faq.show');
Route::get('/edit-faq/{id}', [FaqsController::class, 'edit'])->name('edit.faq');
Route::put('/edit-faq/{id}', [FaqsController::class, 'update'])->name('update.faq');
Route::delete('/faqs/{id}', [FaqsController::class, 'destroy'])->name('destroy.faq');
Route::post('/upload-image', [FaqsController::class, 'uploadImage'])->name('upload.uploadImage'); 

Route::post('/generate-tickets-report', [ReportController::class, 'ticketsReport'])->name('generate.tickets.report');
Route::post('/generate-users-report', [ReportController::class, 'usersReport'])->name('generate.users.report');
Route::post('/generate-faqs-report', [ReportController::class, 'faqsReport'])->name('generate.faqs.report');
Route::post('/generate-faqs-report', [ReportController::class, 'faqsReport'])->name('generate.faqs.report');
Route::post('/open-report', [ReportController::class, 'openReport'])->name('open-status.report');
Route::post('/in-progress-report', [ReportController::class, 'inProgressReport'])->name('in-progress-status.report');
Route::post('/closed-report', [ReportController::class, 'closedReport'])->name('closed-status.report');
Route::post('/high-report', [ReportController::class, 'highReport'])->name('high-priority.report');
Route::post('/mid-report', [ReportController::class, 'midReport'])->name('mid-priority.report');
Route::post('/low-report', [ReportController::class, 'lowReport'])->name('low-priority.report');
Route::post('/unassigned/tickets', [ReportController::class, 'unassignedReport'])->name('unassigned.report');

Route::get('/status/open', [StatusController::class, 'open'])->name('status.open');
Route::get('/status/in-progress', [StatusController::class, 'inProgress'])->name('status.in-progress');
Route::get('/status/closed', [StatusController::class, 'closed'])->name('status.closed');

Route::get('/priority-level/high', [PriorityController::class, 'high'])->name('priority-level.high');
Route::get('/priority-level/mid', [PriorityController::class, 'mid'])->name('priority-level.mid');
Route::get('/priority-level/low', [PriorityController::class, 'low'])->name('priority-level.low');

// Route for Admin and MICT Staff only
Route::patch('tickets/{id}/status', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');
Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log');

// Route::get('/units/create', [UnitController::class, 'create'])->name('units.create');
// Route::post('/units', [UnitController::class, 'store'])->name('units.store');

Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
Route::post('/jobs/store', [JobController::class, 'store'])->name('jobs.store');

Route::get('/problem-type/create', [ProblemController::class, 'create'])->name('problemOrEquipments.create');
Route::post('/problem-type/store', [ProblemController::class, 'store'])->name('problemOrEquipments.store');

// Route::get('/api/job-types/{unitName}', [TicketController::class, 'getJobTypes']);
// Route::get('/api/equipment-types/{unitName}', [TicketController::class, 'getEquipmentTypes']);

// Adding API routes for dynamic dropdowns
Route::get('/api/job-types/{unitId}', [JobController::class, 'getJobTypesByUnit']);
Route::get('/api/equipment-types/{jobId}', [EquipmentController::class, 'getEquipmentTypesByJob']);

Route::get('/equipment/create', [EquipmentController::class, 'create'])->name('equipments.create');
Route::post('/equipment/store', [EquipmentController::class, 'store'])->name('equipments.store');

Route::get('/ICTRAM-unit/create', [ICTRAMController::class, 'create'])->name('ictram-unit.create');
Route::post('/ICTRAM-unit/store', [ICTRAMController::class, 'store'])->name('ictram-unit.store');

// API routes for dynamically fetching data based on selection
Route::get('/request-types/{id}/job-types', [RequestController::class, 'getJobTypes']);
Route::get('/job-types/{id}/equipments', [RequestController::class, 'getEquipments']);
Route::get('/equipments/{id}/problems', [RequestController::class, 'getProblems']);


// Routes for Unit
// Route::get('/units', [UnitController::class, 'index'])->name('units.index');
// Route::get('/units/create', [UnitController::class, 'create'])->name('units.create');
// Route::post('/units', [UnitController::class, 'store'])->name('units.store');
// Route::get('/units/{id}', [UnitController::class, 'show'])->name('units.show');
// Route::get('/units/{id}/edit', [UnitController::class, 'edit'])->name('units.edit');
// Route::put('/units/{id}', [UnitController::class, 'update'])->name('units.update');
// Route::delete('/units/{id}', [UnitController::class, 'destroy'])->name('units.destroy');


// Routes for NICMU
Route::get('/nicmus', [NicmuController::class, 'index'])->name('nicmus.index');
Route::get('/nicmus/create', [NicmuController::class, 'create'])->name('nicmus.create');
Route::post('/nicmus', [NicmuController::class, 'store'])->name('nicmus.store');
Route::get('/nicmus/{id}', [NicmuController::class, 'show'])->name('nicmus.show');
Route::get('/nicmus/{id}/edit', [NicmuController::class, 'edit'])->name('nicmus.edit');
Route::put('/nicmus/{id}', [NicmuController::class, 'update'])->name('nicmus.update');
Route::delete('/nicmus/{id}', [NicmuController::class, 'destroy'])->name('nicmus.destroy');

// Routes for MIS
Route::get('/mises', [MisController::class, 'index'])->name('mises.index');
Route::get('/mises/create', [MisController::class, 'create'])->name('mises.create');
Route::post('/mises', [MisController::class, 'store'])->name('mises.store');
Route::get('/mises/{id}', [MisController::class, 'show'])->name('mises.show');
Route::get('/mises/{id}/edit', [MisController::class, 'edit'])->name('mises.edit');
Route::put('/mises/{id}', [MisController::class, 'update'])->name('mises.update');
Route::delete('/mises/{id}', [MisController::class, 'destroy'])->name('mises.destroy');

// Routes for ICTRAM Director Side

Route::get('/ictram/create', [ICTRAMController::class, 'create'])->name('ictram.create');
Route::post('/ictram/store', [ICTRAMController::class, 'store'])->name('ictram.store');

Route::get('/ictrams', [ICTRAMController::class, 'index'])->name('ictrams.index');
Route::get('/ictrams/create', [ICTRAMController::class, 'create'])->name('ictrams.create');
Route::post('/ictrams/storeJobType', [ICTRAMController::class, 'storeJobType'])->name('ictrams.storeJobType');
Route::post('/ictrams/storeEquipment', [ICTRAMController::class, 'storeEquipment'])->name('ictrams.storeEquipment');
Route::post('/ictrams/storeProblem', [ICTRAMController::class, 'storeProblem'])->name('ictrams.storeProblem');
Route::get('/ictrams/{id}', [ICTRAMController::class, 'show'])->name('ictrams.show');
Route::get('/ictrams/{id}/edit', [ICTRAMController::class, 'edit'])->name('ictrams.edit');
Route::put('/ictrams/{id}', [ICTRAMController::class, 'update'])->name('ictrams.update');
Route::delete('/ictrams/{id}', [ICTRAMController::class, 'destroy'])->name('ictrams.destroy');
Route::get('/api/equipments/{jobType}', [ICTRAMController::class, 'getEquipmentsByJobType'])->name('equipments.byJobType');


// Routes for ICTRAM for Client side
Route::get('/ictram/requests', [ICTRAMRequestController::class, 'index'])->name('ictram.request.index');
Route::get('/ictram/requests/create', [ICTRAMRequestController::class, 'create'])->name('ictram.request.create');
Route::post('/ictram/requests', [ICTRAMRequestController::class, 'store'])->name('ictram.request.store');
Route::get('/ictram/requests/{id}', [ICTRAMRequestController::class, 'show'])->name('ictram.request.show');
Route::get('/ictram/requests/{id}/edit', [ICTRAMRequestController::class, 'edit'])->name('ictram.request.edit');
Route::put('/ictram/requests/{id}', [ICTRAMRequestController::class, 'update'])->name('ictram.request.update');
Route::delete('/ictram/requests/{id}', [ICTRAMRequestController::class, 'destroy'])->name('ictram.request.destroy');


Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

