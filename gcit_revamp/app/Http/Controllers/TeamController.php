<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function getAllTeams()
    {
        try {
            $teams = Team::all();
            return response()->json([
                'success' => true,
                'data' => $teams
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch teams.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getTeam(Team $team)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $team
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch team.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createTeam(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|string',
                'title' => 'sometimes',
                'type' => 'required|string',
                'category' => 'sometimes',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'description' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $team = new Team();
            $team->name = $request->name;
            $team->type = $request->type;
            $team->category = $request->category;
            $team->title = $request->title;
            $team->description = $request->description;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('teams', $imageName, 'public');
                $team->image = $imagePath;
            }

            $team->save();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($team)
                ->withProperties([
                    'name' => $team->name,
                    'id' => $team->id
                ])
                ->log('Added a faculty details');
            return response()->json([
                'success' => true,
                'message' => 'Team added successfully!',
                'data' => $team
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create team.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteTeam($id)
    {
        try {
            $team = Team::findOrFail($id);
            $team->delete();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($team)
                ->withProperties([
                    'name' => $team->name,
                    'id' => $team->id
                ])
                ->log('Deleted a faculty detail');
            return response()->json([
                'success' => true,
                'message' => 'Team deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete team.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateTeam($id, Request $request)
    {
        try {
            $team = Team::findOrFail($id);

            $rules = [
                'name' => 'required|string',
                'type' => 'required|string',
                'title' => 'sometimes',
                'category' => 'sometimes',
                'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:5120',
                'description' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $team->name = $request->name;
            $team->type = $request->type;
            $team->category = $request->category;
            $team->title = $request->title;
            $team->description = $request->description;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('teams', $imageName, 'public');
                $team->image = $imagePath;
            }

            $team->save();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($team)
                ->withProperties([
                    'name' => $team->name,
                    'id' => $team->id
                ])
                ->log('Updated a faculty detail');
            return response()->json([
                'success' => true,
                'message' => 'Team updated successfully!',
                'data' => $team
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update team.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
