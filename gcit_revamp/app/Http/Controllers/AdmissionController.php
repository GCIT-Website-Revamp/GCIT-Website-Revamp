<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdmissionController extends Controller
{
    public function getAllAdmissions()
    {
        try {
            $admissions = Admission::all();
            return response()->json([
                'success' => true,
                'data' => $admissions
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch admissions.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getAdmission(Admission $admisison)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $admisison
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch admission.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createAdmission(Request $request)
    {
        try {
            $rules = [
                'description' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $admission = new Admission();
            $admission->description = $request->description;
            $admission->save();

            return response()->json([
                'success' => true,
                'message' => 'Admission created successfully!',
                'data' => $admission
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create admission.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteAdmission($id)
    {
        try {
            $admission = Admission::findOrFail($id);
            $admission->delete();

            return response()->json([
                'success' => true,
                'message' => 'Admission deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete admission.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateAdmission($id, Request $request)
    {
        try {
            $admission = Admission::findOrFail($id);

            $rules = [
                'description' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $admission->description = $request->description;
            $admission->save();

            return response()->json([
                'success' => true,
                'message' => 'Admission updated successfully!',
                'data' => $admission
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update admission.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
