<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class StudioController extends Controller
{
    public function getAllStudios()
    {
        try {
            $studios = Studio::all();
            return response()->json([
                'success' => true,
                'data' => $studios
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch studios.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getstudio(Studio $studio)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $studio
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch studio.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createstudio(Request $request)
    {
        try {
            $rules = [
                'name' => 'required',
                'description' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $studio = new Studio();
            $studio->name = $request->name;
            $studio->description = $request->description;
            $studio->roles = $request->roles;

            $studio->save();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($studio)
                ->withProperties([
                    'name' => $studio->name,
                    'id' => $studio->id
                ])
                ->log('Added studio information');
            return response()->json([
                'success' => true,
                'message' => 'studio created successfully!',
                'data' => $studio
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create service.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteStudio($id)
    {
        try {
            $studio = Studio::findOrFail($id);
            $studio->delete();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($studio)
                ->withProperties([
                    'name' => $studio->name,
                    'id' => $studio->id
                ])
                ->log('Deleted studio info');
            return response()->json([
                'success' => true,
                'message' => 'studio info deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete studio info.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateStudio($id, Request $request)
    {
        try {
            $studio = studio::findOrFail($id);

            $rules = [
                'name' => 'required',
                'description' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $studio->name = $request->name;
            $studio->description = $request->description;
            $studio->roles = $request->roles;

            $studio->save();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($studio)
                ->withProperties([
                    'name' => $studio->name,
                    'id' => $studio->id
                ])
                ->log('Updated a studio info');
            return response()->json([
                'success' => true,
                'message' => 'studio info updated successfully!',
                'data' => $studio
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update studio info',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
