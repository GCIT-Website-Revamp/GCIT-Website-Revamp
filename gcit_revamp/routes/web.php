<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Community;
use App\Models\Course;
use App\Models\Module;

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.login');
    });

    Route::get('/dashboard', function () {
        $userCount = User::count();
        $courseCount = Course::count();
        $moduleCount = Module::count();
        return view('admin.dashboard', compact('userCount','moduleCount', 'courseCount'));
    });

    Route::get('/profile', function () {
        return view('admin.profile');
    });

    Route::get('/widgets', function () {
        return view('admin.widgets');
    });

    Route::get('/users', function () {
        $users = User::orderBy('created_at', 'desc')->paginate(2);
        $community = Community::first();
        return view('admin.users',compact('users', 'community'));
    });

    Route::get('/academics', function () {
        $courses = Course::orderBy('created_at', 'desc')->paginate(2);
        $modules = Module::orderBy('created_at', 'desc')->paginate(2);
        return view('admin.academics', compact('courses', 'modules'));
    });

});

Route::get('/new', function () {
    return view('contact');
});