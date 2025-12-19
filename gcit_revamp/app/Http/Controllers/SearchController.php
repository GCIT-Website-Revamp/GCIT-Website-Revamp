<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Announcement;
use App\Models\Course;
use Illuminate\Support\Str;
class SearchController extends Controller
{
    public function search(Request $request)
    {
        $q = trim($request->query('q'));

        if (!$q || strlen($q) < 2) {
            return response()->json([
                'query' => $q,
                'count' => 0,
                'results' => []
            ]);
        }

        $results = collect();

        // 🔍 EVENTS
        $events = Event::where('name', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%")
            ->limit(50)
            ->get()
            ->map(fn ($e) => [
                'id' => $e->id,
                'title' => $e->name,
                'type' => 'event',
                'snippet' => strip_tags(Str::limit($e->description, 120)),
                'url' => url('/events/' . $e->id),
                'meta' => [
                    'date' => $e->date,
                    'category' => $e->category
                ]
            ]);

        // 🔍 ANNOUNCEMENTS
        $announcements = Announcement::where('name', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%")
            ->limit(50)
            ->get()
            ->map(fn ($a) => [
                'id' => $a->id,
                'title' => $a->name,
                'type' => 'announcement',
                'snippet' => strip_tags(Str::limit($a->description, 120)),
                'url' => url('/announcements/' . $a->id),
                'meta' => [
                    'date' => $a->date
                ]
            ]);

        // 🔍 PROJECTS
        $projects = Project::where('name', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%")
            ->limit(50)
            ->get()
            ->map(fn ($p) => [
                'id' => $p->id,
                'title' => $p->name,
                'type' => 'project',
                'snippet' => strip_tags(Str::limit($p->description, 120)),
                'url' => url('/projects/' . $p->id),
                'meta' => [
                    'category' => $p->category ?? null,
                    'year' => $p->year ?? null
                ]
            ]);

        // 🔍 COURSES
        $courses = Course::where('name', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%")
            ->limit(50)
            ->get()
            ->map(fn ($c) => [
                'id' => $c->id,
                'title' => $c->name,
                'type' => 'course',
                'snippet' => strip_tags(Str::limit($c->description, 120)),
                'url' => url('/courses/' . $c->id),
                'meta' => [
                    'program' => $c->program ?? null,
                    'level' => $c->level ?? null
                ]
            ]);

        // 🔗 Merge + basic ranking
        $results = collect()
            ->merge($events)
            ->merge($announcements)
            ->merge($projects)
            ->merge($courses)
            ->take(50)
            ->values();

        return response()->json([
            'query' => $q,
            'count' => $results->count(),
            'results' => $results
        ]);
    }
}
