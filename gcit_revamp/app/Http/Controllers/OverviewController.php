<?php

namespace App\Http\Controllers;

use App\Models\Overview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class OverviewController extends Controller
{
    public function getAllOverviews()
    {
        try {
            $overviews = Overview::all();
            return response()->json([
                'success' => true,
                'data' => $overviews
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch overviews.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getOverview(Overview $overview)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $overview
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch overview.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createOverview(Request $request)
    {
        try {
            $rules = [
                'mission' => 'required',
                'vision' => 'required',
                'description' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $overview = new Overview();
            $overview->mission = $request->mission;
            $overview->vision = $request->vision;
            $overview->description = $request->description;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('overviews', $imageName, 'public');
                $overview->image = $imagePath;
            }

            $overview->save();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($overview)
                ->withProperties([
                    'overview_id' => $overview->id
                ])
                ->log('Created institutional overview details');
            return response()->json([
                'success' => true,
                'message' => 'Overview created successfully!',
                'data' => $overview
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create overview.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateOverview($id, Request $request)
    {
        try {
            $overview = Overview::findOrFail($id);

            $rules = [
                'mission' => 'required',
                'vision' => 'required',
                'description' => 'required',
                'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:5120',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $overview->mission = $request->mission;
            $overview->vision = $request->vision;
            $overview->description = $request->description;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('overviews', $imageName, 'public');
                $overview->image = $imagePath;
            }

            $overview->save();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($overview)
                ->withProperties([
                    'overview_id' => $overview->id
                ])
                ->log('Updated institutional overview details');
            return response()->json([
                'success' => true,
                'message' => 'Overview updated successfully!',
                'data' => $overview
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update overview.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteOverview($id)
    {
        try {
            $overview = Overview::findOrFail($id);
            $overview->delete();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($overview)
                ->withProperties([
                    'overview_id' => $overview->id
                ])
                ->log('Deleted institutional overview details');
            return response()->json([
                'success' => true,
                'message' => 'Overview deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete overview.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
