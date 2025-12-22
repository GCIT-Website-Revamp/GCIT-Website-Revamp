<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function getAllAnnouncement()
    {
        try {
            $announcements = Announcement::all();
            return response()->json([
                'success' => true,
                'data' => $announcements
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch announcements.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getAnnouncement(Announcement $announcements)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $announcements
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch announce$announcements item.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createAnnouncement(Request $request)
    {
        try {
            $rules = [
                'name' => 'required',
                'date' => 'required|date',
                'description' => 'required',
                'category' => 'required',
                'display' => 'sometimes'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $announcement = new Announcement();
            $announcement->name = $request->name;
            $announcement->date = $request->date;
            $announcement->display = $request->display;
            $announcement->category = $request->category;
            $announcement->description = $request->description;
            $announcement->save();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($announcement)
                ->withProperties([
                    'name' => $announcement->name,
                    'id' => $announcement->id
                ])
                ->log('Added a new announcement');
            return response()->json([
                'success' => true,
                'message' => 'Announcement created successfully!',
                'data' => $announcement
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create news.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteAnnouncement($id)
    {
        try {
            $announcement = Announcement::findOrFail($id);
            $announcement->delete();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($announcement)
                ->withProperties([
                    'name' => $announcement->name,
                    'id' => $announcement->id
                ])
                ->log('Deleted announcement');
            return response()->json([
                'success' => true,
                'message' => 'Announcement deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete announcement.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateAnnouncement($id, Request $request)
    {
        try {
            $announcement = Announcement::findOrFail($id);

            $rules = [
                'name' => 'required',
                'date' => 'required|date',
                'description' => 'required',
                'category' => 'required',
                'display' => 'sometimes'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $announcement->name = $request->name;
            $announcement->date = $request->date;
            $announcement->description = $request->description;
            $announcement->display = $request->display;
            $announcement->category = $request->category;
            $announcement->save();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($announcement)
                ->withProperties([
                    'name' => $announcement->name,
                    'id' => $announcement->id
                ])
                ->log('Updated announcement');
            return response()->json([
                'success' => true,
                'message' => 'Announcement updated successfully!',
                'data' => $announcement
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update announcement.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function searchAnnouncement(Request $request)
    {
        try {
            $q = trim($request->query('q'));

            if (!$q || strlen($q) < 1) {
                return response()->json([
                    'success' => true,
                    'count' => 0,
                    'data' => []
                ]);
            }

            $announcements = Announcement::where('name', 'LIKE', "%{$q}%")
                ->orWhere('description', 'LIKE', "%{$q}%")
                ->orderBy('date', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'count' => $announcements->count(),
                'data' => $announcements
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to search announcements.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {

            $path = $request->file('upload')
                ->store('ckeditor/announcements', 'public');

            return response()->json([
                'uploaded' => true,
                'url' => asset('storage/' . $path)
            ]);
        }

        return response()->json([
            'uploaded' => false,
            'error' => [
                'message' => 'No file uploaded'
            ]
        ], 400);
    }
}