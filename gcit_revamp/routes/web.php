<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Course;
use App\Models\Module;
use App\Models\Project;
use App\Models\Club;
use App\Models\Services;
use App\Models\Team;
use App\Models\Event;
use App\Models\Announcement;
use App\Models\Admission;
use App\Models\Overview;
use App\Models\ICT;
use App\Models\Welfare;
use App\Models\Contact;


Route::get('/admin', function () {
    return view('admin.login');
});

Route::get('/reset-email', function () {
    return view('admin.email');
});

Route::get('/reset-password', function () {
    return view('admin.resetpassword');
});

Route::get('/verify-otp', function () {
    return view('admin.verifyotp');
});

Route::middleware(['web','auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        $userCount = User::count();
        $courseCount = Course::count();
        $moduleCount = Module::count();
        $projectCount = Project::count();
        $clubCount = Club::count();
        $serviceCount = Services::count();
        $acadTeamCount = Team::where('type', 'Academic')->count();
        $nacadTeamCount = Team::where('type', 'Non-Academic')->count();
        $teams = Team::all();
        $events = Event::latest()->take(4)->get();
        return view('admin.dashboard', compact('userCount','moduleCount', 'courseCount', 'projectCount', 'clubCount', 'teams', 'events', 'serviceCount','acadTeamCount', 'nacadTeamCount'));
    });

    Route::get('/profile', function () {
        return view('admin.profile');
    });

    Route::get('/projects', function () {
        $projects =Project::orderBy('created_at', 'desc')->paginate(7);
        return view('admin.projects', compact('projects'));
    });

    Route::get('/users', function () {
        $users = User::orderBy('created_at', 'desc')->paginate(7);
        return view('admin.users',compact('users'));
    });

    Route::get('/academics', function () {
        $courses = Course::orderBy('created_at', 'desc')->paginate(5);
        $modules = Module::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.academics', compact('courses', 'modules'));
    });

    Route::get('/clubs', function () {
        $clubs = Club::orderBy('created_at', 'desc')->paginate(7);
        return view('admin.club', compact('clubs'));
    });

    Route::get('/teams', function () {
        $teams = Team::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.teams', compact('teams'));
    });

    Route::get('/services', function () {
        $services = Services::orderBy('created_at', 'desc')->paginate(7);
        return view('admin.services', compact('services'));
    });

    Route::get('/updates', function () {
        $events = Event::orderBy('created_at', 'desc')->paginate(4);
        $announcements = Announcement::orderBy('created_at', 'desc')->paginate(4);
        return view('admin.updates', compact('events', 'announcements'));
    });

    Route::get('/admission', function () {
        $admission = Admission::orderBy('created_at', 'desc')->first();
        return view('admin.admission', compact('admission'));
    });

    Route::get('/overview', function () {
        $overview = Overview::orderBy('created_at', 'desc')->first();
        return view('admin.overview', compact('overview'));
    });

    Route::get('/ict', function () {
        $ict = ICT::orderBy('created_at', 'desc')->first();
        return view('admin.ict', compact('ict'));
    });

    Route::get('/student-welfare', function () {
        $welfare = Welfare::orderBy('created_at', 'desc')->first();
        return view('admin.welfare', compact('welfare'));
    });

    Route::get('/contact', function () {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(7);
        return view('admin.contact', compact('contacts'));
    });

    Route::get('/calendar', function () {
        return view('admin.calendar');
    });
});

Route::get('/new', function () {
    return view('contact');
});

Route::get('/', function () {
    return view('user.home');
});

Route::get('/about', function () {
    return view('user.about');
});

Route::get('/news&events', function () {
    return view('user.eventsTemplate');
});
Route::get('/announcements', function () {
    return view('user.announcementTemplate');
});
Route::get('/course', function () {
    return view('user.courseList');
});
Route::get('/post', function () {
    return view('user.postDetailsTemplate');
});
Route::get('/courseDetails', function () {
    return view('user.courseDetails');
});
Route::get('/department', function () {
    return view('user.departmentTemplate');
});