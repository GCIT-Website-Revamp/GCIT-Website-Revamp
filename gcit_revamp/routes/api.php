<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VacancyController;
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


// Project API Routes
Route::get('/project', [ProjectController::class, 'getAllProjects'])->name('getAllProjects');
Route::get('/project/{project}', [ProjectController::class, 'getProject'])->name('getProject');
Route::post('/project', [ProjectController::class, 'createProject'])->name('createProject');
Route::delete('/project/{project}', [ProjectController::class, 'deleteProject'])->name('deleteProject');
Route::put('/project/{project}', [ProjectController::class, 'updateProject'])->name('updateProject');

// Event API Routes
Route::get('/event', [EventController::class, 'getAllEvents'])->name('getAllEvents');
Route::get('/event/{event}', [EventController::class, 'getEvent'])->name('getEvent');
Route::post('/event', [EventController::class, 'createEvent'])->name('createEvent');
Route::delete('/event/{event}', [EventController::class, 'deleteEvent'])->name('deleteEvent');
Route::put('/event/{event}', [EventController::class, 'updateEvent'])->name('updateEvent');

// News API Routes
Route::get('/announcement', [AnnouncementController::class, 'getAllAnnouncement'])->name('getAllAnnouncement');
Route::get('/announcement/{announcement}', [AnnouncementController::class, 'getAnnouncement'])->name('getAnnouncement');
Route::post('/announcement', [AnnouncementController::class, 'createAnnouncement'])->name('createAnnouncement');
Route::delete('/announcement/{announcement}', [AnnouncementController::class, 'deleteAnnouncement'])->name('deleteAnnouncement');
Route::put('/announcement/{announcement}', [AnnouncementController::class, 'updateAnnouncement'])->name('updateAnnouncement');

// Vacancy API Routes
Route::get('/vacancy', [VacancyController::class, 'getAllVacancies'])->name('getAllVacancies');
Route::get('/vacancy/{vacancy}', [VacancyController::class, 'getVacancy'])->name('getVacancy');
Route::post('/vacancy', [VacancyController::class, 'createVacancy'])->name('createVacancy');
Route::delete('/vacancy/{vacancy}', [VacancyController::class, 'deleteVacancy'])->name('deleteVacancy');
Route::put('/vacancy/{vacancy}', [VacancyController::class, 'updateVacancy'])->name('updateVacancy');

// Course API Routes
Route::get('/course', [CourseController::class, 'getAllCourses'])->name('getAllCourses');
Route::get('/course/{course}', [CourseController::class, 'getCourse'])->name('getCourse');
Route::post('/course', [CourseController::class, 'createCourse'])->name('createCourse');
Route::delete('/course/{course}', [CourseController::class, 'deleteCourse'])->name('deleteCourse');
Route::put('/course/{course}', [CourseController::class, 'updateCourse'])->name('updateCourse');

// Module API Routes
Route::get('/module', [ModuleController::class, 'getAllModules'])->name('getAllModules');
Route::get('/module/{module}', [ModuleController::class, 'getModule'])->name('getModule');
Route::post('/module', [ModuleController::class, 'createModule'])->name('createModule');
Route::delete('/module/{module}', [ModuleController::class, 'deleteModule'])->name('deleteModule');
Route::put('/module/{module}', [ModuleController::class, 'updateModule'])->name('updateModule');

// Club API Routes
Route::get('/club', [ClubController::class, 'getAllClubs'])->name('getAllClubs');
Route::get('/club/{club}', [ClubController::class, 'getClub'])->name('getClub');
Route::post('/club', [ClubController::class, 'createClub'])->name('createClub');
Route::delete('/club/{club}', [ClubController::class, 'deleteClub'])->name('deleteClub');
Route::put('/club/{club}', [ClubController::class, 'updateClub'])->name('updateClub');

// Service API Routes
Route::get('/service', [ServiceController::class, 'getAllServices'])->name('getAllServices');
Route::get('/service/{service}', [ServiceController::class, 'getService'])->name('getService');
Route::post('/service', [ServiceController::class, 'createService'])->name('createService');
Route::delete('/service/{service}', [ServiceController::class, 'deleteService'])->name('deleteService');
Route::put('/service/{service}', [ServiceController::class, 'updateService'])->name('updateService');

// Team API Routes
Route::get('/team', [TeamController::class, 'getAllTeams'])->name('getAllTeams');
Route::get('/team/{team}', [TeamController::class, 'getTeam'])->name('getTeam');
Route::post('/team', [TeamController::class, 'createTeam'])->name('createTeam');
Route::delete('/team/{team}', [TeamController::class, 'deleteTeam'])->name('deleteTeam');
Route::put('/team/{team}', [TeamController::class, 'updateTeam'])->name('updateTeam');

// Overview API Routes
Route::get('/overview', [OverviewController::class, 'getAllOverviews'])->name('getAllOverviews');
Route::get('/overview/{overview}', [OverviewController::class, 'getOverview'])->name('getOverview');
Route::post('/overview', [OverviewController::class, 'createOverview'])->name('createOverview');
Route::delete('/overview/{overview}', [OverviewController::class, 'deleteOverview'])->name('deleteOverview');
Route::put('/overview/{overview}', [OverviewController::class, 'updateOverview'])->name('updateOverview');

// Admisison API Routes
Route::get('/admission', [AdmissionController::class, 'getAllAdmissions'])->name('getAllAdmissions');
Route::get('/admission/{admission}', [AdmissionController::class, 'getAdmission'])->name('getAdmission');
Route::post('/admission', [AdmissionController::class, 'createAdmission'])->name('createAdmission');
Route::delete('/admission/{admission}', [AdmissionController::class, 'deleteAdmission'])->name('deleteAdmission');
Route::put('/admission/{admission}', [AdmissionController::class, 'updateAdmission'])->name('updateAdmission');

// ICT API Routes
Route::get('/ict', [ICTController::class, 'getAllICT'])->name('getAllICT');
Route::get('/ict/{ict}', [ICTController::class, 'getICT'])->name('getICT');
Route::post('/ict', [ICTController::class, 'createICT'])->name('createICT');
Route::delete('/ict/{ict}', [ICTController::class, 'deleteICT'])->name('deleteICT');
Route::put('/ict/{ict}', [ICTController::class, 'updateICT'])->name('updateICT');

// Welfare API Routes
Route::get('/welfare', [WelfareController::class, 'getAllWelfare'])->name('getAllWelfare');
Route::get('/welfare/{welfare}', [WelfareController::class, 'getWelfare'])->name('getWelfare');
Route::post('/welfare', [WelfareController::class, 'createWelfare'])->name('createWelfare');
Route::delete('/welfare/{welfare}', [WelfareController::class, 'deleteWelfare'])->name('deleteWelfare');
Route::put('/welfare/{welfare}', [WelfareController::class, 'updateWelfare'])->name('updateWelfare');

// Contacts API Routes
Route::get('/contact', [ContactController::class, 'getAllContacts'])->name('getAllContacts');
Route::get('/contact/{contact}', [ContactController::class, 'getContact'])->name('getContact');
Route::post('/contact', [ContactController::class, 'createContact'])->name('createContact');
Route::delete('/contact/{contact}', [ContactController::class, 'deleteContact'])->name('deleteContact');
Route::put('/contact/{contact}', [ContactController::class, 'updateContact'])->name('updateContact');