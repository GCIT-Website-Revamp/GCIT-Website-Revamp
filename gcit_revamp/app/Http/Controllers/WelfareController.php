<?php

namespace App\Http\Controllers;

use App\Models\Welfare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WelfareController extends Controller
{
    public function getAllWelfare()
    {
        try {
            $welfare = Welfare::all();
            return response()->json([
                'success' => true,
                'data' => $welfare
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch welfare.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getWelfare(Welfare $welfare)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $welfare
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch welfare.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createWelfare(Request $request)
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

            $welfare = new Welfare();
            $welfare->description = $request->description;
            $welfare->save();

            return response()->json([
                'success' => true,
                'message' => 'Student welfare infomation added successfully!',
                'data' => $welfare
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create student welfare information.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteWelfare($id)
    {
        try {
            $welfare = Welfare::findOrFail($id);
            $welfare->delete();

            return response()->json([
                'success' => true,
                'message' => 'Student welfare infomation deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete student welfare.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateWelfare($id, Request $request)
    {
        try {
            $welfare = Welfare::findOrFail($id);

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

            $welfare->description = $request->description;
            $welfare->save();

            return response()->json([
                'success' => true,
                'message' => 'Student welfare infomation updated successfully!',
                'data' => $welfare
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update student welfare information.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
