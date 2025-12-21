<?php

use App\Models\Media;
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
use Spatie\Activitylog\Models\Activity;
use App\Http\Controllers\MediaController;
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
use App\Http\Controllers\SearchController;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           

Route::middleware('web')->group(function () {
    //search
    Route::get('/api/search', [SearchController::class, 'search']);
    Route::get('/api/log-search', [SearchController::class, 'searchLogs'])->name('searchLogs');

    // Auth
    Route::post('/api/login', [AuthController::class, 'login'])->name('login');
    Route::post('/api/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/api/updatepassword', [AuthController::class, 'updatePassword'])->name('updatePassword');

    // User profile & management
    Route::post('/api/users', [UserController::class, 'createUser'])->name('createUser');
    Route::get('/api/users', [UserController::class, 'getAllUsers'])->name('getAllUsers');
    Route::get('/api/users/{user}', [UserController::class, 'getUser'])->name('getUser');
    Route::put('/api/users/{user}', [UserController::class, 'updateUser'])->name('updateUser');
    Route::delete('/api/users/{user}', [UserController::class, 'deleteUser'])->name('deleteUser');
    Route::put('/api/users/{id}/toggle', [UserController::class, 'toggleEnabled'])->name('toggleUser');
    Route::post('/api/reset-password', [UserController::class, 'resetPassword'])->name('resetPassword');
    Route::post('/api/verify-otp', [UserController::class, 'verifyOtp'])->name('verifyOTP');
    Route::post('/api/send-otp-email', [UserController::class, 'sendOtpEmail'])->name('sendOTP');

    // Project API Routes
    Route::get('/api/project', [ProjectController::class, 'getAllProjects'])->name('getAllProjects');
    Route::get('/api/project/{project}', [ProjectController::class, 'getProject'])->name('getProject');
    Route::post('/api/project', [ProjectController::class, 'createProject'])->name('createProject');
    Route::delete('/api/project/{project}', [ProjectController::class, 'deleteProject'])->name('deleteProject');
    Route::put('/api/project/{project}', [ProjectController::class, 'updateProject'])->name('updateProject');
    Route::delete('/api/project-image/{id}', [ProjectController::class, 'deleteImage'])->name('deleteImage');
    Route::get('/api/project-search', [ProjectController::class, 'searchProjects'])->name('searchProjects');

    // Event API Routes
    Route::get('/api/event', [EventController::class, 'getAllEvents'])->name('getAllEvents');
    Route::get('/api/event/{event}', [EventController::class, 'getEvent'])->name('getEvent');
    Route::post('/api/event', [EventController::class, 'createEvent'])->name('createEvent');
    Route::delete('/api/event/{event}', [EventController::class, 'deleteEvent'])->name('deleteEvent');
    Route::put('/api/event/{event}', [EventController::class, 'updateEvent'])->name('updateEvent');
    Route::delete('/api/event-image/{id}', [EventController::class, 'deleteImage'])->name('deleteEventImage');
    Route::get('/api/event-search', [EventController::class, 'searchEvent'])->name('searchEvent');

    // News API Routes
    Route::get('/api/announcement', [AnnouncementController::class, 'getAllAnnouncement'])->name('getAllAnnouncement');
    Route::get('/api/announcement/{announcement}', [AnnouncementController::class, 'getAnnouncement'])->name('getAnnouncement');
    Route::post('/api/announcement', [AnnouncementController::class, 'createAnnouncement'])->name('createAnnouncement');
    Route::delete('/api/announcement/{announcement}', [AnnouncementController::class, 'deleteAnnouncement'])->name('deleteAnnouncement');
    Route::put('/api/announcement/{announcement}', [AnnouncementController::class, 'updateAnnouncement'])->name('updateAnnouncement');
    Route::get('/api/announcement-search', [AnnouncementController::class, 'searchAnnouncement'])->name('searchAnnouncement');

    // Course API Routes
    Route::get('/api/course', [CourseController::class, 'getAllCourses'])->name('getAllCourses');
    Route::get('/api/course/{course}', [CourseController::class, 'getCourse'])->name('getCourse');
    Route::post('/api/course', [CourseController::class, 'createCourse'])->name('createCourse');
    Route::delete('/api/course/{course}', [CourseController::class, 'deleteCourse'])->name('deleteCourse');
    Route::put('/api/course/{course}', [CourseController::class, 'updateCourse'])->name('updateCourse');

    // Module API Routes
    Route::get('/api/module', [ModuleController::class, 'getAllModules'])->name('getAllModules');
    Route::get('/api/module/{module}', [ModuleController::class, 'getModule'])->name('getModule');
    Route::post('/api/module', [ModuleController::class, 'createModule'])->name('createModule');
    Route::delete('/api/module/{module}', [ModuleController::class, 'deleteModule'])->name('deleteModule');
    Route::put('/api/module/{module}', [ModuleController::class, 'updateModule'])->name('updateModule');
    Route::get('/api/module-search', [ModuleController::class, 'searchModule'])->name('searchModule');

    // Club API Routes
    Route::get('/api/club', [ClubController::class, 'getAllClubs'])->name('getAllClubs');
    Route::get('/api/club/{club}', [ClubController::class, 'getClub'])->name('getClub');
    Route::post('/api/club', [ClubController::class, 'createClub'])->name('createClub');
    Route::delete('/api/club/{club}', [ClubController::class, 'deleteClub'])->name('deleteClub');
    Route::put('/api/club/{club}', [ClubController::class, 'updateClub'])->name('updateClub');

    // Service API Routes
    Route::get('/api/service', [ServiceController::class, 'getAllServices'])->name('getAllServices');
    Route::get('/api/service/{service}', [ServiceController::class, 'getService'])->name('getService');
    Route::post('/api/service', [ServiceController::class, 'createService'])->name('createService');
    Route::delete('/api/service/{service}', [ServiceController::class, 'deleteService'])->name('deleteService');
    Route::put('/api/service/{service}', [ServiceController::class, 'updateService'])->name('updateService');

    // Team API Routes
    Route::get('/api/team', [TeamController::class, 'getAllTeams'])->name('getAllTeams');
    Route::get('/api/team/{team}', [TeamController::class, 'getTeam'])->name('getTeam');
    Route::post('/api/team', [TeamController::class, 'createTeam'])->name('createTeam');
    Route::delete('/api/team/{team}', [TeamController::class, 'deleteTeam'])->name('deleteTeam');
    Route::put('/api/team/{team}', [TeamController::class, 'updateTeam'])->name('updateTeam');
    Route::get('/api/team-search', [TeamController::class, 'searchTeam'])->name('updateTeam');

    // Overview API Routes
    Route::get('/api/overview', [OverviewController::class, 'getAllOverviews'])->name('getAllOverviews');
    Route::get('/api/overview/{overview}', [OverviewController::class, 'getOverview'])->name('getOverview');
    Route::post('/api/overview', [OverviewController::class, 'createOverview'])->name('createOverview');
    Route::delete('/api/overview/{overview}', [OverviewController::class, 'deleteOverview'])->name('deleteOverview');
    Route::put('/api/overview/{overview}', [OverviewController::class, 'updateOverview'])->name('updateOverview');

    // Admisison API Routes
    Route::get('/api/admission', [AdmissionController::class, 'getAllAdmissions'])->name('getAllAdmissions');
    Route::get('/api/admission/{admission}', [AdmissionController::class, 'getAdmission'])->name('getAdmission');
    Route::post('/api/admission', [AdmissionController::class, 'createAdmission'])->name('createAdmission');
    Route::delete('/api/admission/{admission}', [AdmissionController::class, 'deleteAdmission'])->name('deleteAdmission');
    Route::put('/api/admission/{admission}', [AdmissionController::class, 'updateAdmission'])->name('updateAdmission');

    // ICT API Routes
    Route::get('/api/ict', [ICTController::class, 'getAllICT'])->name('getAllICT');
    Route::get('/api/ict/{ict}', [ICTController::class, 'getICT'])->name('getICT');
    Route::post('/api/ict', [ICTController::class, 'createICT'])->name('createICT');
    Route::delete('/api/ict/{ict}', [ICTController::class, 'deleteICT'])->name('deleteICT');
    Route::put('/api/ict/{ict}', [ICTController::class, 'updateICT'])->name('updateICT');

    // Welfare API Routes
    Route::get('/api/welfare', [WelfareController::class, 'getAllWelfare'])->name('getAllWelfare');
    Route::get('/api/welfare/{welfare}', [WelfareController::class, 'getWelfare'])->name('getWelfare');
    Route::post('/api/welfare', [WelfareController::class, 'createWelfare'])->name('createWelfare');
    Route::delete('/api/welfare/{welfare}', [WelfareController::class, 'deleteWelfare'])->name('deleteWelfare');
    Route::put('/api/welfare/{welfare}', [WelfareController::class, 'updateWelfare'])->name('updateWelfare');

    // Contacts API Routes
    Route::get('/api/contact', [ContactController::class, 'getAllContacts'])->name('getAllContacts');
    Route::get('/api/contact/{contact}', [ContactController::class, 'getContact'])->name('getContact');
    Route::post('/api/contact', [ContactController::class, 'createContact'])->name('createContact');
    Route::delete('/api/contact/{contact}', [ContactController::class, 'deleteContact'])->name('deleteContact');
    Route::put('/apicontact/{contact}', [ContactController::class, 'updateContact'])->name('updateContact');

    // Media API Routes
    Route::get('/api/media', [MediaController::class, 'getAllMedias'])->name('getAllMedias');
    Route::get('/api/media/{media}', [MediaController::class, 'getMedia'])->name('getMedia');
    Route::post('/api/media', [MediaController::class, 'createMedia'])->name('createMedia');
    Route::delete('/api/media/{media}', [MediaController::class, 'deleteMedia'])->name('deleteMedia');
    Route::put('/api/media/{media}', [MediaController::class, 'updatemedia'])->name('updatemedia');
});

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
        $acadTeamCount = Team::count();
        $nacadTeamCount = Team::where('type', 'Non-Academic')->count();
        $events = Event::count();
        $logs = Activity::with('causer')->latest()->take(12)->get();

        return view('admin.dashboard', compact('userCount','moduleCount', 'courseCount', 'projectCount', 'clubCount', 'events', 'serviceCount','acadTeamCount', 'logs'));
    });

    Route::get('/profile', function () {
        return view('admin.profile');
    });

    Route::get('/projects', function () {
        $projects =Project::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.projects', compact('projects'));
    });

    Route::get('/users', function () {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.users',compact('users'));
    });

    Route::get('/academics', function () {
        $courses = Course::orderBy('created_at', 'desc')->paginate(10,['*'], 'courses_page');
        $modules = Module::orderBy('created_at', 'desc')->paginate(25, ['*'], 'modules_page');
        return view('admin.academics', compact('courses', 'modules'));
    });

    Route::get('/clubs', function () {
        $clubs = Club::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.club', compact('clubs'));
    });

    Route::get('/teams', function () {
        $teams = Team::orderBy('created_at', 'desc')->paginate(25);
        return view('admin.teams', compact('teams'));
    });

    Route::get('/services', function () {
        $services = Services::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.services', compact('services'));
    });

    Route::get('/updates', function () {
        $events = Event::orderBy('created_at', 'desc')->paginate(15, ['*'], 'events_page');
        $announcements = Announcement::orderBy('created_at', 'desc')->paginate(15, ['*'], 'announcements_page');
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
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.contact', compact('contacts'));
    });

    Route::get('/calendar', function () {
        return view('admin.calendar');
    });

    Route::get('/media', function () {
        $media = Media::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.media_gallery', compact('media'));
    });

    Route::get('/logs', function () {
        activity()
        ->causedBy(Auth::user())
        ->withProperties([
            'ip' => request()->ip(),
            'url' => request()->fullUrl(),
        ])
        ->log('Viewed action logs');
        $logs = Activity::orderBy('created_at', 'desc')->with('causer')->paginate(50);
        return view('admin.logs', compact('logs'));
    });
});

Route::get('/', function () {
    $bsc = Course::where('type', '=', 'School of Computer Science')->orderBy('name', 'ASC')->get();
    $sidd = Course::where('type', '=', 'School of Interactive Design and Development')->first();
    $announcements = Announcement::orderBy('date', 'desc')->where('display', '=', "true")->take(5)->get();
    $events = Event::orderBy('date', 'desc')->where('highlight', '=', "true")->get();
    $projects = Project::orderBy('created_at', 'desc')->where('highlight', '=', "true")->get();
    return view('user.home', compact('bsc','sidd', 'announcements', 'events', 'projects'));
});

Route::get('/news&events', function () {
    $events = Event::orderBy('date', 'desc')->where('display', '=', "true")->get();
    return view('user.eventsTemplate', compact('events'));
});

Route::get('/announcements', function () {
    $announcements = Announcement::orderBy('date', 'desc')->where('display', '=', "true")->get();
    return view('user.announcementTemplate', compact('announcements'));
});

Route::get('/course', function () {
    $courses = Course::orderBy('name', 'ASC')->get();
    return view('user.courseList', compact('courses'));
});
Route::get('/search', function () {
    return view('user.search');
});
Route::get('/post/{type}/{id}', function ($type, $id) {
    $event = null;
    $announcement = null;
    $project = null;

    $latestEvents = null;
    $latestAnnouncements = null;
    $latestProjects = null;

    $previous = null;
    $next = null;

    // ------------------------
    // EVENTS
    // ------------------------
    if ($type === 'events') {
        $event = Event::findOrFail($id);

        // Next & Previous based on ID
        $previous = Event::where('id', '<', $event->id)->orderBy('id', 'desc')->first();
        $next = Event::where('id', '>', $event->id)->orderBy('id', 'asc')->first();

        // Latest events
        $latestEvents = Event::orderBy('date', 'desc')
            ->where('display', '=', "true")
            ->take(3)
            ->get();
    }

    // ------------------------
    // ANNOUNCEMENTS
    // ------------------------
    if ($type === 'announcement') {
        $announcement = Announcement::findOrFail($id);

        // Next & Previous based on ID
        $previous = Announcement::where('id', '<', $announcement->id)->orderBy('id', 'desc')->first();
        $next = Announcement::where('id', '>', $announcement->id)->orderBy('id', 'asc')->first();

        // Latest announcements
        $latestAnnouncements = Announcement::orderBy('date', 'desc')
            ->where('display', '=', "true")
            ->take(3)
            ->get();
    }

    // ------------------------
    // PROJECTS
    // ------------------------
    if ($type === 'project') {
        $project = Project::with('guideTeam')->findOrFail($id);

        // Next & Previous based on ID
        $previous = Project::where('id', '<', $project->id)->orderBy('id', 'desc')->first();
        $next = Project::where('id', '>', $project->id)->orderBy('id', 'asc')->first();

        // Latest projects
        $latestProjects = Project::orderBy('created_at', 'desc')
            ->where('display', '=', "true")
            ->take(3)
            ->get();
    }

    return view('user.postDetailsTemplate', compact(
        'event',
        'announcement',
        'latestAnnouncements',
        'latestEvents',
        'project',
        'latestProjects',
        'next',
        'previous',
        'type'
    ));
});


Route::get('/courseDetails/{id}', function ($id) {
    $course = Course::findOrFail($id);
    $modules = Module::whereJsonContains('course_id', $id)->get();
    $otherCourses = Course::where('id', '!=', $id)->get();
    return view('user.courseDetails', compact('course', 'modules', 'otherCourses'));
});

Route::get('/department/{type}', function ($type) {
    $courses = Course::orderBy('name', 'ASC')->get();
    $service = Services::where('name', '=', $type)->first();
    if ($service) {
        $service->roles = collect($service->roles)->map(function ($role) {
            $team = Team::find($role['team_id']);
            if ($team) {
                $role['team_name'] = $team->name;
                $role['image'] = $team->image;
            } else {
                $role['team_name'] = null;
                $role['users'] = [];
            }
            return $role;
        });
    }

    return view('user.departmentTemplate', compact('service', 'courses'));
});
Route::get('/faculty', function () {
    $faculties = Team::where('type', '=', 'Academic')->orderBy('title', 'asc')->get();
    return view('user.faculty', compact('faculties'));
});

Route::get('/about', function () {
    $overview = Overview::orderBy('created_at', 'desc')->first();
    $courses = Course::orderBy('name', 'asc')->get();
    return view('user.about', compact('overview', 'courses'));
});

Route::get('/clubs', function () {
    $clubs = Club::orderBy('name', 'asc')->get();
    return view('user.club', compact('clubs'));
});

Route::get('/clubDetails/{id}', function ($id) {
    $courses = Course::orderBy('name', 'asc')->get();
    $club = Club::where('id', '=', $id)->first();
    if ($club) {
        $club->roles = collect($club->roles)->map(function ($role) {
            $team = Team::find($role['team_id']);
            if ($team) {
                $role['team_name'] = $team->name;
                $role['image'] = $team->image;
            } else {
                $role['team_name'] = null;
                $role['users'] = [];
            }
            return $role;
        });
    }

    return view('user.clubDetails', compact('club','courses'));
});

Route::get('/resources/{type}', function ($type) {
    $resources = null;
    $courses = Course::orderBy('name', 'asc')->get();
    if ($type === 'Admission') {
        $resources = Admission::orderBy('created_at', 'desc')->first();
    }elseif($type === 'ICT'){
        $resources = ICT::orderBy('created_at', 'desc')->first();
    }elseif($type === 'Student-Welfare'){
        $resources = Welfare::orderBy('created_at', 'desc')->first();
    }
    if ($resources) {
        $resources->name = $type;
    }
    return view('user.resources', compact('resources', 'courses'));
});
Route::get('/project', function () {
    $projects = Project::orderBy('created_at', 'desc')->where('display', '=', "true")->get();
    return view('user.project', compact('projects'));
});

Route::get('/search', function () {
    return view('user.search');
})->name('search');