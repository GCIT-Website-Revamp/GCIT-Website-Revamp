<?php

namespace App\Http\Controllers;

use App\Models\Fintech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class FintechController extends Controller
{
    public function getAllFintechs()
    {
        try {
            $fintechs = Fintech::all();
            return response()->json([
                'success' => true,
                'data' => $fintechs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch fintechs.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getFintech(Fintech $fintech)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $fintech
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch fintech.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createFintech(Request $request)
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

            $fintech = new Fintech();
            $fintech->name = $request->name;
            $fintech->description = $request->description;
            $fintech->roles = $request->roles;

            $fintech->save();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($fintech)
                ->withProperties([
                    'name' => $fintech->name,
                    'id' => $fintech->id
                ])
                ->log('Added fintech information');
            return response()->json([
                'success' => true,
                'message' => 'Fintech created successfully!',
                'data' => $fintech
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create service.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteFintech($id)
    {
        try {
            $fintech = Fintech::findOrFail($id);
            $fintech->delete();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($fintech)
                ->withProperties([
                    'name' => $fintech->name,
                    'id' => $fintech->id
                ])
                ->log('Deleted fintech info');
            return response()->json([
                'success' => true,
                'message' => 'Fintech info deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete fintech info.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateFintech($id, Request $request)
    {
        try {
            $fintech = Fintech::findOrFail($id);

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

            $fintech->name = $request->name;
            $fintech->description = $request->description;
            $fintech->roles = $request->roles;

            $fintech->save();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($fintech)
                ->withProperties([
                    'name' => $fintech->name,
                    'id' => $fintech->id
                ])
                ->log('Updated a fintech info');
            return response()->json([
                'success' => true,
                'message' => 'Fintech info updated successfully!',
                'data' => $fintech
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update fintech info',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
