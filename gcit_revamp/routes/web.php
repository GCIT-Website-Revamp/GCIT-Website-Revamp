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
        $projects =Project::orderBy('created_at', 'desc')->paginate(7);
        return view('admin.projects', compact('projects'));
    });

    Route::get('/users', function () {
        $users = User::orderBy('created_at', 'desc')->paginate(7);
        return view('admin.users',compact('users'));
    });

    Route::get('/academics', function () {
        $courses = Course::orderBy('created_at', 'desc')->paginate(5,['*'], 'courses_page');
        $modules = Module::orderBy('created_at', 'desc')->paginate(5, ['*'], 'modules_page');
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
        $events = Event::orderBy('created_at', 'desc')->paginate(4, ['*'], 'events_page');
        $announcements = Announcement::orderBy('created_at', 'desc')->paginate(4, ['*'], 'announcements_page');
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

    Route::get('/media', function () {
        $media = Media::orderBy('created_at', 'desc')->paginate(7);
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
        $logs = Activity::orderBy('created_at', 'desc')->with('causer')->paginate(15);
        return view('admin.logs', compact('logs'));
    });
});

Route::get('/', function () {
    $bsc = Course::where('type', '=', 'School of Computing')->orderBy('name', 'ASC')->get();
    $sidd = Course::where('type', '=', 'School of Interactive Design and Development')->first();
    $announcements = Announcement::orderBy('created_at', 'desc')->where('display', '=', "true")->take(5)->get();
    $events = Event::orderBy('created_at', 'desc')->where('highlight', '=', "true")->get();
    $projects = Project::orderBy('created_at', 'desc')->where('highlight', '=', "true")->get();
    return view('user.home', compact('bsc','sidd', 'announcements', 'events', 'projects'));
});

Route::get('/news&events', function () {
    $events = Event::orderBy('created_at', 'desc')->where('display', '=', "true")->get();
    return view('user.eventsTemplate', compact('events'));
});

Route::get('/announcements', function () {
    $announcements = Announcement::orderBy('created_at', 'desc')->where('display', '=', "true")->get();
    return view('user.announcementTemplate', compact('announcements'));
});

Route::get('/course', function () {
    $courses = Course::orderBy('name', 'ASC')->get();
    return view('user.courseList', compact('courses'));
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
        $latestEvents = Event::orderBy('created_at', 'desc')
            ->where('display', '=', "true")
            ->take(4)
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
        $latestAnnouncements = Announcement::orderBy('created_at', 'desc')
            ->where('display', '=', "true")
            ->take(4)
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
            ->take(4)
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
    $faculties = Team::where('type', '=', 'Academic')->get();
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