<?php

use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\ICTController;
use App\Http\Controllers\WelfareController;
use App\Http\Controllers\ContactController;


// Auth
Route::post('/login', [AuthController::class, 'login'])->middleware('web')->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('web')->name('logout');
Route::post('/updatepassword', [AuthController::class, 'updatePassword'])->middleware('web')->name('updatePassword');

// User profile & management
Route::post('/users', [UserController::class, 'createUser'])->name('createUser');
Route::get('/users', [UserController::class, 'getAllUsers'])->name('getAllUsers');
Route::get('/users/{user}', [UserController::class, 'getUser'])->name('getUser');
Route::put('/users/{user}', [UserController::class, 'updateUser'])->name('updateUser');
Route::delete('/users/{user}', [UserController::class, 'deleteUser'])->name('deleteUser');
Route::put('/users/{id}/toggle', [UserController::class, 'toggleEnabled'])->name('toggleUser');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('resetPassword');
Route::post('/verify-otp', [UserController::class, 'verifyOtp'])->name('verifyOTP');
Route::post('/send-otp-email', [UserController::class, 'sendOtpEmail'])->name('sendOTP');

// Project API Routes
Route::get('/project', [ProjectController::class, 'getAllProjects'])->name('getAllProjects');
Route::get('/project/{project}', [ProjectController::class, 'getProject'])->name('getProject');
Route::post('/project', [ProjectController::class, 'createProject'])->middleware('web')->name('createProject');
Route::delete('/project/{project}', [ProjectController::class, 'deleteProject'])->middleware('web')->name('deleteProject');
Route::put('/project/{project}', [ProjectController::class, 'updateProject'])->middleware('web')->name('updateProject');
Route::delete('/project-image/{id}', [ProjectController::class, 'deleteImage'])->middleware('web')->name('deleteImage');

// Event API Routes
Route::get('/event', [EventController::class, 'getAllEvents'])->name('getAllEvents');
Route::get('/event/{event}', [EventController::class, 'getEvent'])->name('getEvent');
Route::post('/event', [EventController::class, 'createEvent'])->middleware('web')->name('createEvent');
Route::delete('/event/{event}', [EventController::class, 'deleteEvent'])->middleware('web')->name('deleteEvent');
Route::put('/event/{event}', [EventController::class, 'updateEvent'])->middleware('web')->name('updateEvent');
Route::delete('/event-image/{id}', [EventController::class, 'deleteImage'])->middleware('web')->name('deleteEventImage');

// News API Routes
Route::get('/announcement', [AnnouncementController::class, 'getAllAnnouncement'])->name('getAllAnnouncement');
Route::get('/announcement/{announcement}', [AnnouncementController::class, 'getAnnouncement'])->name('getAnnouncement');
Route::post('/announcement', [AnnouncementController::class, 'createAnnouncement'])->middleware('web')->name('createAnnouncement');
Route::delete('/announcement/{announcement}', [AnnouncementController::class, 'deleteAnnouncement'])->middleware('web')->name('deleteAnnouncement');
Route::put('/announcement/{announcement}', [AnnouncementController::class, 'updateAnnouncement'])->middleware('web')->name('updateAnnouncement');

// Course API Routes
Route::get('/course', [CourseController::class, 'getAllCourses'])->name('getAllCourses');
Route::get('/course/{course}', [CourseController::class, 'getCourse'])->name('getCourse');
Route::post('/course', [CourseController::class, 'createCourse'])->middleware('web')->name('createCourse');
Route::delete('/course/{course}', [CourseController::class, 'deleteCourse'])->middleware('web')->name('deleteCourse');
Route::put('/course/{course}', [CourseController::class, 'updateCourse'])->middleware('web')->name('updateCourse');

// Module API Routes
Route::get('/module', [ModuleController::class, 'getAllModules'])->name('getAllModules');
Route::get('/module/{module}', [ModuleController::class, 'getModule'])->name('getModule');
Route::post('/module', [ModuleController::class, 'createModule'])->middleware('web')->name('createModule');
Route::delete('/module/{module}', [ModuleController::class, 'deleteModule'])->middleware('web')->name('deleteModule');
Route::put('/module/{module}', [ModuleController::class, 'updateModule'])->middleware('web')->name('updateModule');

// Club API Routes
Route::get('/club', [ClubController::class, 'getAllClubs'])->name('getAllClubs');
Route::get('/club/{club}', [ClubController::class, 'getClub'])->name('getClub');
Route::post('/club', [ClubController::class, 'createClub'])->middleware('web')->name('createClub');
Route::delete('/club/{club}', [ClubController::class, 'deleteClub'])->middleware('web')->name('deleteClub');
Route::put('/club/{club}', [ClubController::class, 'updateClub'])->middleware('web')->name('updateClub');

// Service API Routes
Route::get('/service', [ServiceController::class, 'getAllServices'])->name('getAllServices');
Route::get('/service/{service}', [ServiceController::class, 'getService'])->name('getService');
Route::post('/service', [ServiceController::class, 'createService'])->middleware('web')->name('createService');
Route::delete('/service/{service}', [ServiceController::class, 'deleteService'])->middleware('web')->name('deleteService');
Route::put('/service/{service}', [ServiceController::class, 'updateService'])->middleware('web')->name('updateService');

// Team API Routes
Route::get('/team', [TeamController::class, 'getAllTeams'])->name('getAllTeams');
Route::get('/team/{team}', [TeamController::class, 'getTeam'])->name('getTeam');
Route::post('/team', [TeamController::class, 'createTeam'])->middleware('web')->name('createTeam');
Route::delete('/team/{team}', [TeamController::class, 'deleteTeam'])->middleware('web')->name('deleteTeam');
Route::put('/team/{team}', [TeamController::class, 'updateTeam'])->middleware('web')->name('updateTeam');

// Overview API Routes
Route::get('/overview', [OverviewController::class, 'getAllOverviews'])->name('getAllOverviews');
Route::get('/overview/{overview}', [OverviewController::class, 'getOverview'])->name('getOverview');
Route::post('/overview', [OverviewController::class, 'createOverview'])->middleware('web')->name('createOverview');
Route::delete('/overview/{overview}', [OverviewController::class, 'deleteOverview'])->middleware('web')->name('deleteOverview');
Route::put('/overview/{overview}', [OverviewController::class, 'updateOverview'])->middleware('web')->name('updateOverview');

// Admisison API Routes
Route::get('/admission', [AdmissionController::class, 'getAllAdmissions'])->name('getAllAdmissions');
Route::get('/admission/{admission}', [AdmissionController::class, 'getAdmission'])->name('getAdmission');
Route::post('/admission', [AdmissionController::class, 'createAdmission'])->middleware('web')->name('createAdmission');
Route::delete('/admission/{admission}', [AdmissionController::class, 'deleteAdmission'])->middleware('web')->name('deleteAdmission');
Route::put('/admission/{admission}', [AdmissionController::class, 'updateAdmission'])->middleware('web')->name('updateAdmission');

// ICT API Routes
Route::get('/ict', [ICTController::class, 'getAllICT'])->name('getAllICT');
Route::get('/ict/{ict}', [ICTController::class, 'getICT'])->name('getICT');
Route::post('/ict', [ICTController::class, 'createICT'])->middleware('web')->name('createICT');
Route::delete('/ict/{ict}', [ICTController::class, 'deleteICT'])->middleware('web')->name('deleteICT');
Route::put('/ict/{ict}', [ICTController::class, 'updateICT'])->middleware('web')->name('updateICT');

// Welfare API Routes
Route::get('/welfare', [WelfareController::class, 'getAllWelfare'])->name('getAllWelfare');
Route::get('/welfare/{welfare}', [WelfareController::class, 'getWelfare'])->name('getWelfare');
Route::post('/welfare', [WelfareController::class, 'createWelfare'])->middleware('web')->name('createWelfare');
Route::delete('/welfare/{welfare}', [WelfareController::class, 'deleteWelfare'])->middleware('web')->name('deleteWelfare');
Route::put('/welfare/{welfare}', [WelfareController::class, 'updateWelfare'])->middleware('web')->name('updateWelfare');

// Contacts API Routes
Route::get('/contact', [ContactController::class, 'getAllContacts'])->name('getAllContacts');
Route::get('/contact/{contact}', [ContactController::class, 'getContact'])->name('getContact');
Route::post('/contact', [ContactController::class, 'createContact'])->name('createContact');
Route::delete('/contact/{contact}', [ContactController::class, 'deleteContact'])->name('deleteContact');
Route::put('/contact/{contact}', [ContactController::class, 'updateContact'])->middleware('web')->name('updateContact');

// Media API Routes
Route::get('/media', [MediaController::class, 'getAllMedias'])->name('getAllMedias');
Route::get('/media/{media}', [MediaController::class, 'getMedia'])->name('getMedia');
Route::post('/media', [MediaController::class, 'createMedia'])->middleware('web')->name('createMedia');
Route::delete('/media/{media}', [MediaController::class, 'deleteMedia'])->middleware('web')->name('deleteMedia');
Route::put('/media/{media}', [MediaController::class, 'updatemedia'])->middleware('web')->name('updatemedia');