<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ClubController extends Controller
{
    public function getAllClubs()
    {
        try {
            $clubs = Club::all();
            return response()->json([
                'success' => true,
                'data' => $clubs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch clubs.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getClub(Club $club)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $club
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch club.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createClub(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|string',
                'description' => 'required|string',
                'roles' => 'required|array', // must be an array
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $club = new Club();
            $club->name = $request->name;
            $club->description = $request->description;
            $club->roles = $request->roles; // stored as JSON automatically
            
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('clubs', $imageName, 'public');
                $club->logo = $imagePath;
            }

            $club->save();

            activity()
                ->causedBy(Auth::user())
                ->performedOn($club)
                ->withProperties([
                    'club_name' => $club->name,
                    'club_id' => $club->id
                ])
                ->log('Created a new club');

            return response()->json([
                'success' => true,
                'message' => 'Club created successfully!',
                'data' => $club
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create club.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateClub($id, Request $request)
    {
        try {
            $club = Club::findOrFail($id);

            $rules = [
                'name' => 'required|string',
                'description' => 'required|string',
                'roles' => 'sometimes|array',
                'logo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:5120'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $club->name = $request->name;
            $club->description = $request->description;

            if ($request->has('roles')) {
                $club->roles = $request->roles;
            }

            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('clubs', $imageName, 'public');
                $club->logo = $imagePath;
            }

            $club->save();

            activity()
                ->causedBy(Auth::user())
                ->performedOn($club)
                ->withProperties([
                    'club_name' => $club->name,
                    'club_id' => $club->id
                ])
                ->log('Updated a club');

            return response()->json([
                'success' => true,
                'message' => 'Club updated successfully!',
                'data' => $club
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update club.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteClub($id)
    {
        try {
            $club = Club::findOrFail($id);
            $club->delete();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($club)
                ->withProperties([
                    'club_name' => $club->name,
                    'club_id' => $club->id
                ])
                ->log('Deleted a club');
            return response()->json([
                'success' => true,
                'message' => 'Club deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete club.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
