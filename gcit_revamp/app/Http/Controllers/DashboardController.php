<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
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

class DashboardController extends Controller
{
    public function dashboardSearch(Request $request)
    {
        $q = trim($request->query('q'));
        $type = strtolower($request->query('type')); // model name

        if (!$q || strlen($q) < 2) {
            return response()->json([
                'query' => $q,
                'type' => $type,
                'count' => 0,
                'results' => []
            ]);
        }

        /**
         * 🔗 Model Map
         * key => [ModelClass, route_prefix]
         */
        $models = [
            'user'         => [User::class, 'users'],
            'course'       => [Course::class, 'courses'],
            'module'       => [Module::class, 'modules'],
            'project'      => [Project::class, 'projects'],
            'club'         => [Club::class, 'clubs'],
            'services'     => [Services::class, 'services'],
            'team'         => [Team::class, 'teams'],
            'event'        => [Event::class, 'events'],
            'announcement' => [Announcement::class, 'announcements'],
            'admission'    => [Admission::class, 'admissions'],
            'overview'     => [Overview::class, 'overviews'],
            'ict'          => [ICT::class, 'ict'],
            'welfare'      => [Welfare::class, 'welfare'],
            'contact'      => [Contact::class, 'contacts'],
        ];

        $results = collect();

        /**
         * 🔍 If type is provided → search ONLY that model
         */
        if ($type && isset($models[$type])) {
            [$modelClass, $route] = $models[$type];

            $results = $modelClass::where('name', 'like', "%{$q}%")
                ->limit(50)
                ->get()
                ->map(fn ($item) => [
                    'id'    => $item->id,
                    'title' => $item->name,
                    'type'  => $type,
                    'url'   => url("/dashboard/{$route}/{$item->id}")
                ]);
        }

        /**
         * 🔍 If no type → search ALL models (by name only)
         */
        if (!$type) {
            foreach ($models as $modelType => [$modelClass, $route]) {
                $items = $modelClass::where('name', 'like', "%{$q}%")
                    ->limit(10)
                    ->get()
                    ->map(fn ($item) => [
                        'id'    => $item->id,
                        'title' => $item->name,
                        'type'  => $modelType,
                        'url'   => url("/dashboard/{$route}/{$item->id}")
                    ]);

                $results = $results->merge($items);
            }
        }

        return response()->json([
            'query' => $q,
            'type'  => $type ?? 'all',
            'count' => $results->count(),
            'results' => $results->values()
        ]);
    }
}