<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ClubRoleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


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

// Community API Routes
Route::get('/community', [CommunityController::class, 'getAllCommunities'])->name('getAllCommunities');
Route::get('/community/{community}', [CommunityController::class, 'getCommunity'])->name('getCommunity');
Route::post('/community', [CommunityController::class, 'createCommunity'])->name('createCommunity');
Route::delete('/community/{community}', [CommunityController::class, 'deleteCommunity'])->name('deleteCommunity');
Route::put('/community/{community}', [CommunityController::class, 'updateCommunity'])->name('updateCommunity');

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
Route::get('/news', [NewsController::class, 'getAllNews'])->name('getAllNews');
Route::get('/news/{news}', [NewsController::class, 'getNews'])->name('getNews');
Route::post('/news', [NewsController::class, 'createNews'])->name('createNews');
Route::delete('/news/{news}', [NewsController::class, 'deleteNews'])->name('deleteNews');
Route::put('/news/{news}', [NewsController::class, 'updateNews'])->name('updateNews');

// Tender API Routes
Route::get('/tender', [TenderController::class, 'getAllTenders'])->name('getAllTenders');
Route::get('/tender/{tender}', [TenderController::class, 'getTender'])->name('getTender');
Route::post('/tender', [TenderController::class, 'createTender'])->name('createTender');
Route::delete('/tender/{tender}', [TenderController::class, 'deleteTender'])->name('deleteTender');
Route::put('/tender/{tender}', [TenderController::class, 'updateTender'])->name('updateTender');

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

// ClubRoles API Routes
Route::get('/croles', [ClubRoleController::class, 'getAllCRoles'])->name('getAllCRoles');
Route::get('/croles/{croles}', [ClubRoleController::class, 'getCRole'])->name('getCRole');
Route::post('/croles', [ClubRoleController::class, 'createCRoles'])->name('createCRoles');
Route::delete('/croles/{croles}', [ClubRoleController::class, 'deleteCRoles'])->name('deleteCRoles');
Route::put('/croles/{croles}', [ClubRoleController::class, 'updateCRoles'])->name('updateCRoles');

// Service API Routes
Route::get('/service', [ServiceController::class, 'getAllServices'])->name('getAllServices');
Route::get('/service/{service}', [ServiceController::class, 'getService'])->name('getService');
Route::post('/service', [ServiceController::class, 'createService'])->name('createService');
Route::delete('/service/{service}', [ServiceController::class, 'deleteService'])->name('deleteService');
Route::put('/service/{service}', [ServiceController::class, 'updateService'])->name('updateService');